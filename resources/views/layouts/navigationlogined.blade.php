<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-center md:justify-between py-0 flex-col md:flex-row">
            <!-- Atte -->
            <div class="flex items-center justify-center text-3xl font-bold">Atte</div>

            <!-- Links -->
            <div class="flex-shrink-0 flex items-center justify-center">
                <a class="m-2 font-bold md:m-6" href="{{route('index')}}">ホーム</a>
                <a class="m-2 font-bold md:m-6" href="{{route('attendance')}}">日付一覧</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="m-2 font-bold md:m-6" href="route('logout')"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
