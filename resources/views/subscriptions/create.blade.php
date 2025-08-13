<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscribe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Choose Your Plan</h3>

                    <form action="{{ route('subscription.store') }}" method="POST" id="subscribe-form">
                        @csrf

                        <div class="mt-4">
                            <x-input-label for="plan" :value="__('Select Plan')" />
                            <select id="plan" name="plan" class="block mt-1 w-full" required autofocus>
                                <option value="price_1Pj210000000000000">Basic ($10/month)</option>
                                <option value="price_1Pj210000000000001">Premium ($20/month)</option>
                            </select>
                            <x-input-error :messages="$errors->get('plan')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="card-holder-name" :value="__('Card Holder Name')" />
                            <x-text-input id="card-holder-name" class="block mt-1 w-full" type="text" name="card_holder_name" required autofocus />
                            <x-input-error :messages="$errors->get('card_holder_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="card-element" :value="__('Credit or debit card')" />
                            <div id="card-element" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></div>
                            <div id="card-errors" role="alert" class="text-red-500 text-sm mt-2"></div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button id="card-button" data-secret="{{ $intent->client_secret }}">
                                {{ __('Subscribe') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ $stripeKey }}');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            const form = document.getElementById('subscribe-form');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                cardButton.disabled = true;

                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    const errorDisplay = document.getElementById('card-errors');
                    errorDisplay.textContent = error.message;
                    cardButton.disabled = false;
                } else {
                    let token = document.createElement('input');
                    token.setAttribute('type', 'hidden');
                    token.setAttribute('name', 'payment_method');
                    token.setAttribute('value', setupIntent.payment_method);
                    form.appendChild(token);
                    form.submit();
                }
            });
        </script>
    @endpush
</x-app-layout>
