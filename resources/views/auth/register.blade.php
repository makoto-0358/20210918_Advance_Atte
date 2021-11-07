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

                <x-input id="name" class="block mt-1 w-full bg-gray-100 border-4" type="text" placeholder="名前" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" />

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

            <div class="flex items-center justify-center mt-4">
                <table class="w-full">
                    <tr>
                        <td class="flex justify-center">
                            <x-button class="w-full flex justify-center bg-blue-700 text-base">
                                {{ __('Register') }}
                            </x-button>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-full flex justify-center mt-10 text-sm text-gray-400">
                            アカウントをお持ちの方はこちらから
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a class="flex justify-center text-sm text-blue-700" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </x-auth-card>
</x-appguest-layout>
