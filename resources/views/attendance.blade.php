<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div>
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
