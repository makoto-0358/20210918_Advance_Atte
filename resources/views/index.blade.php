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
    <!-- @if(session('message'))
        <div class="w-full text-center bg-green-200 bg-opacity-75 absolute top-0 transition-all　duration-1000 transform translate-y-64">
            {{session('message')}}
        </div>
    @endif -->

    <div class="py-12 flex flex-wrap mx-40 text-2xl">
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center"> -->
                    <!-- <table class="flex item-center justify-center"> -->
                        @isset($attendance)
                            <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                                <div class="font-bold text-gray-400">勤務開始</div>
                            </div>
                        @else
                        <form action="/attendance/start" method="post">
                            @csrf
                            <label>
                                <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer">
                                    <button class="font-bold" type="submit">勤務開始</button>
                                </div>
                            </label>
                        </form>
                        @endisset
                    <!-- </table> -->
                <!-- </div> -->
            </div>
        </div>
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center"> -->
                    <!-- <table class="flex item-center justify-center"> -->
                        @isset($attendance)
                            @empty($rest)
                            <form action="/attendance/end" method="post">
                                @csrf
                                <label>
                                    <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer">
                                        <button class="font-bold" type="submit">勤務終了</button>
                                    </div>
                                </label>
                            </form>
                            @else
                            <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                                <div class="font-bold text-gray-400">勤務終了</div>
                            </div>
                            @endempty
                        @else
                        <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                            <div class="font-bold text-gray-400">勤務終了</div>
                        </div>
                        @endisset
                    <!-- </table> -->
                <!-- </div> -->
            </div>
        </div>
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center"> -->
                    <!-- <table class="flex item-center justify-center"> -->
                        @isset($attendance)
                            @empty($rest)
                            <form action="/rest/start" method="post">
                                @csrf
                                <label>
                                    <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer">
                                        <button class="font-bold" type="submit">休憩開始</button>
                                    </div>
                                </label>
                            </form>
                            @else
                            <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                                <div class="font-bold text-gray-400">休憩開始</div>
                            </div>
                            @endempty
                        @else
                        <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                            <div class="font-bold text-gray-400">休憩開始</div>
                        </div>
                        @endisset
                    <!-- </table> -->
                <!-- </div> -->
            </div>
        </div>
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center"> -->
                    <!-- <table class="flex item-center justify-center"> -->
                        @isset($attendance)
                            @isset($rest)
                            <form action="/rest/end" method="post">
                                @csrf
                                <label>
                                    <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer">
                                        <button class="font-bold" type="submit">休憩終了</button>
                                    </div>
                                </label>
                            </form>
                            @else
                            <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                                <div class="font-bold text-gray-400">休憩終了</div>
                            </div>
                            @endisset
                        @else
                        <div class="py-20 px-50 bg-white border-b border-gray-200 flex item-center justify-center">
                            <div class="font-bold text-gray-400">休憩終了</div>
                        </div>
                        @endisset
                    <!-- </table> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</x-appmember-layout>
