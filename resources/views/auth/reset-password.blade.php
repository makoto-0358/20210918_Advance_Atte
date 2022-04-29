<x-appguest-layout>
    <x-auth-card>
        <x-slot name="logo">
            パスワードの再設定
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <div class="mt-4">

                <x-input id="email" class="block mt-1 w-full bg-gray-100 border-4" type="email" placeholder="メールアドレス" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" />

                <x-input id="password" class="block mt-1 w-full bg-gray-100 border-4"
                                type="password"
                                placeholder="パスワード"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" />

                <x-input id="password_confirmation" class="block mt-1 w-full bg-gray-100 border-4"
                                type="password"
                                placeholder="確認用パスワード"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-button class="w-full flex items-center justify-center bg-blue-700 text-base">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-appguest-layout>
