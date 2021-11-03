<x-appguest-layout>
    <x-auth-card>
        <x-slot name="logo">
            会員登録
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" />

                <x-input id="name" class="block mt-1 w-full" type="text" placeholder="名前" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" />

                <x-input id="email" class="block mt-1 w-full" type="email" placeholder="メールアドレス" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                placeholder="パスワード"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                placeholder="確認用パスワード"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <p>アカウントをお持ちの方はこちらから</p>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-appguest-layout>
