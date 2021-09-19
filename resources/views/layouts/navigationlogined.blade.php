<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Atte -->
                <div class="flex-shrink-0 flex items-center">
                    <p>Atte</p>
                </div>
            </div>

            <div class="flex">
                <!-- Links -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{route('index')}}">ホーム</a>
                    <a href="{{route('attendance')}}">日付一覧</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
