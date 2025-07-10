<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        {{-- role --}}
        <div class="mt-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Register as</label>
            <select name="role" id="role" required class="mt-1 block w-full rounded border-gray-300">
                <option value="customer">Customer</option>
                <option value="provider">Service Provider</option>
                {{-- <option value="admin">Admin</option> --}}
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        </div>
        <!-- Provider Fields -->
        <div id="provider-fields" style="display: none;">
            <!-- Business Name -->
            <div class="mt-4">
                <x-input-label for="business_name" :value="__('Business Name')" />
                <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="business_name" />
            </div>
            <!-- Business Details -->
            <div class="mt-4">
                <x-input-label for="business_details" :value="__('Business Details')" />
                <textarea id="business_details" class="block mt-1 w-full" name="business_details"></textarea>
            </div>
            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" />
            </div>
            <!-- Govt Registered Business No. (optional) -->
            <div class="mt-4">
                <x-input-label for="govt_no" :value="__('Govt Registered Business No. (optional)')" />
                <x-text-input id="govt_no" class="block mt-1 w-full" type="text" name="govt_no" />
            </div>
            <!-- Contact Info -->
            <div class="mt-4">
                <x-input-label for="contact" :value="__('Contact Info')" />
                <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const providerFields = document.getElementById('provider-fields');

            function toggleProviderFields() {
                if (roleSelect.value === 'provider') {
                    providerFields.style.display = 'block';
                } else {
                    providerFields.style.display = 'none';
                }
            }

            roleSelect.addEventListener('change', toggleProviderFields);
            toggleProviderFields(); // Initial check
        });
    </script>
    </form>
</x-guest-layout>
