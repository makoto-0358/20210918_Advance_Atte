<x-appmember-layout>
    <div class="py-10 flex justify-center text-2xl font-bold">
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>
    <div class="flex justify-center">
        @isset($attendance)
        勤務中です。
            @isset($rest)
            休憩中です。
            @else
            休憩中ではありません。
            @endisset
        @else
        勤務中ではありません。
        @endisset
    </div>
    @if(session('message'))
        <div>
            {{session('message')}}
        </div>
    @endif

    <div class="py-12 flex flex-wrap mx-40 text-2xl">
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-20 px-50 bg-white border-b border-gray-200">
                    <table class="flex item-center justify-center">
                        @isset($attendance)
                            <tr><td class="font-bold text-gray-400">勤務開始</td></tr>
                        @else
                        <form action="/attendance/start" method="post">
                            @csrf
                            <tr><td><button class="font-bold" type="submit">勤務開始</button></td></tr>
                        </form>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-20 px-50 bg-white border-b border-gray-200">
                    <table class="flex item-center justify-center">
                        @isset($attendance)
                            @empty($rest)
                            <form action="/attendance/end" method="post">
                                @csrf
                                <tr><td><button class="font-bold" type="submit">勤務終了</button></td></tr>
                            </form>
                            @else
                            <tr><td class="font-bold text-gray-400">勤務終了</td></tr>
                            @endempty
                        @else
                        <tr><td class="font-bold text-gray-400">勤務終了</td></tr>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-20 px-50 bg-white border-b border-gray-200">
                    <table class="flex item-center justify-center">
                        @isset($attendance)
                            @empty($rest)
                            <form action="/rest/start" method="post">
                                @csrf
                                <tr><td><button class="font-bold" type="submit">休憩開始</button></td></tr>
                            </form>
                            @else
                            <tr><td class="font-bold text-gray-400">休憩開始</td></tr>
                            @endempty
                        @else
                        <tr><td class="font-bold text-gray-400">休憩開始</td></tr>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-20 px-50 bg-white border-b border-gray-200">
                    <table class="flex item-center justify-center">
                        @isset($attendance)
                            @isset($rest)
                            <form action="/rest/end" method="post">
                                @csrf
                                <tr><td><button class="font-bold" type="submit">休憩終了</button></td></tr>
                            </form>
                            @else
                            <tr><td class="font-bold text-gray-400">休憩終了</td></tr>
                            @endisset
                        @else
                        <tr><td class="font-bold text-gray-400">休憩終了</td></tr>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-appmember-layout>
