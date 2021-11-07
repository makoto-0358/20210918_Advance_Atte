<x-appguest-layout>
    <x-auth-card>
        <x-slot name="logo">
            ログイン
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" />

                <x-input id="email" class="block mt-1 w-full bg-gray-100 border-4" type="email" placeholder="メールアドレス" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" />

                <x-input id="password" class="block mt-1 w-full bg-gray-100 border-4"
                                type="password"
                                placeholder="パスワード"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <table class="w-full">
                    <tr>
                        <td class="flex justify-center">
                            <x-button class="w-full flex justify-center bg-blue-700 text-base">
                                {{ __('Log in') }}
                            </x-button>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-full flex justify-center mt-10 text-sm text-gray-400">
                            アカウントをお持ちでない方はこちらから
                        </td>
                    </tr>
                    @if (Route::has('password.request'))
                    <tr>
                        <td>
                            <a class="flex justify-center text-sm text-blue-700"  href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </form>
    </x-auth-card>
</x-appguest-layout>
