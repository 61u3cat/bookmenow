<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    // Constructor to set the Stripe API key from config
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Initiates the Stripe checkout process for a booking.
     * Creates a PaymentIntent and passes the client secret to the frontend.
     */
    public function checkout(Booking $booking)
    {
        try {
            // Create a PaymentIntent with the booking amount (converted to cents)
            $paymentIntent = PaymentIntent::create([
                'amount' => $booking->service->price * 100, // Stripe expects amount in cents
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true, // Enables automatic detection of payment methods
                ],
                'metadata' => [ // Useful for identifying the payment later
                    'booking_id' => $booking->id,
                    'service_id' => $booking->service_id,
                    'user_id' => $booking->user_id,
                ]
            ]);

            // Pass data to the checkout view
            return view('payments.checkout', [
                'booking' => $booking,
                'clientSecret' => $paymentIntent->client_secret,
            ]);

        } catch (\Exception $e) {
            // Log error and redirect back with a message
            Log::error('Stripe payment intent creation failed', [
                'error' => $e->getMessage(),
                'booking' => $booking->id
            ]);

            return redirect()->back()->with('error', 'Unable to initiate payment. Please try again.');
        }
    }

    /**
     * Handles incoming Stripe webhook events.
     * Verifies the signature and processes payment success or failure.
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            // Verify the webhook signature to ensure it's from Stripe
            $event = \Stripe\Webhook::constructEvent(
                $request->getContent(),
                $sig_header,
                $endpoint_secret
            );
        } catch (\Exception $e) {
            // Log and return error if verification fails
            Log::error('Webhook signature verification failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 400);
        }

        // Handle different types of Stripe events
        switch ($event->type) {
            case 'payment_intent.succeeded':
                // Payment was successful
                $this->handleSuccessfulPayment($event->data->object);
                break;
            case 'payment_intent.payment_failed':
                // Payment failed
                $this->handleFailedPayment($event->data->object);
                break;
        }

        // Respond to Stripe to confirm receipt of the event
        return response()->json(['status' => 'success']);
    }

    /**
     * Processes a successful payment.
     * Creates a payment record and updates the booking status.
     */
    protected function handleSuccessfulPayment($paymentIntent)
    {
        $bookingId = $paymentIntent->metadata->booking_id;
        $booking = Booking::findOrFail($bookingId);

        // Save payment details to the database
        Payment::create([
            'booking_id' => $bookingId,
            'user_id' => $booking->user_id,
            'tenant_id' => $booking->tenant_id,
            'amount' => $paymentIntent->amount / 100, // Convert back to dollars
            'currency' => $paymentIntent->currency,
            'payment_method' => $paymentIntent->payment_method,
            'payment_id' => $paymentIntent->id,
            'status' => 'completed'
        ]);

        // Mark the booking as paid
        $booking->update(['status' => 'paid']);
    }

    /**
     * Processes a failed payment.
     * Logs the failed attempt in the payments table.
     */
    protected function handleFailedPayment($paymentIntent)
    {
        $bookingId = $paymentIntent->metadata->booking_id;

        Payment::create([
            'booking_id' => $bookingId,
            'user_id' => $paymentIntent->metadata->user_id,
            'tenant_id' => Booking::find($bookingId)->tenant_id,
            'amount' => $paymentIntent->amount / 100,
            'currency' => $paymentIntent->currency,
            'payment_method' => $paymentIntent->payment_method,
            'payment_id' => $paymentIntent->id,
            'status' => 'failed'
        ]);
    }

    /**
     * Displays the success page after payment.
     * Verifies the payment intent and shows confirmation.
     */
    public function success(Request $request)
    {
        // Get the payment intent ID from the query string
        $paymentIntentId = $request->get('payment_intent');

        if (!$paymentIntentId) {
            // Redirect if no payment intent ID is found
            return redirect()->route('customer.my-bookings')
                ->with('error', 'Payment information not found.');
        }

        try {
            // Retrieve the payment intent from Stripe
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            // Find the related booking
            $bookingId = $paymentIntent->metadata->booking_id;
            $booking = Booking::findOrFail($bookingId);

            // Show success page if payment succeeded
            if ($paymentIntent->status === 'succeeded') {
                return view('payments.success', [
                    'booking' => $booking,
                    'paymentIntent' => $paymentIntent
                ]);
            } else {
                // Redirect if payment was not successful
                return redirect()->route('customer.my-bookings')
                    ->with('error', 'Payment was not successful. Please try again.');
            }
        } catch (\Exception $e) {
            // Log and redirect on error
            Log::error('Error retrieving payment intent', [
                'error' => $e->getMessage(),
                'payment_intent_id' => $paymentIntentId
            ]);

            return redirect()->route('customer.my-bookings')
                ->with('error', 'Unable to verify payment. Please contact support.');
        }
    }
}