<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="issue-form custom-card p-6 sm:rounded-lg">
            <div class="w-full mx-auto mt-4">
                <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 text-start">Name</label>
                <input id="name" type="name" name="name" :value="old('name')" required
                class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white"
                placeholder="name"
                ></input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

            </div>

            <div class="w-full mx-auto mt-4">
                <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 text-start">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required
                class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white"
                placeholder="email"
                ></input>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <div class="w-full mx-auto mt-4">
                <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 text-start">Password</label>
                <input id="password" type="password" name="password" :value="old('password')" required
                class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white"
                placeholder="password"
                ></input>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>

            <div class="w-full mx-auto mt-4">
                <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 text-start">Confirm Password</label>
                <input id="password_confirmation" type="password_confirmation" name="password_confirmation" :value="old('password_confirmation')" required
                class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white"
                placeholder="password confirmation"
                ></input>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-200" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
