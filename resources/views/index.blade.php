<x-appmember-layout>
    <div class="py-10 flex justify-center text-2xl font-bold">
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>
    
    <!-- 現在の状況 -->
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

    <!-- ボタンを押した動作に対するフラッシュメッセージ -->
    <!-- @if(session('message'))
        <div class="w-full text-center bg-green-200 bg-opacity-75 absolute top-0 transition-all duration-1000 transform translate-y-64">
            {{session('message')}}
        </div>
    @endif -->

    <!-- 各種ボタン -->
    <div class="py-12 flex flex-wrap text-2xl md:py-12 md:mx-40">
        <!-- 勤務開始ボタン -->
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm">
                @isset($attendance)
                    <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                        <div class="font-bold text-gray-400">勤務開始</div>
                    </div>
                @else
                <form action="/attendance/start" method="post">
                    @csrf
                    <label>
                        <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer md:py-20">
                            <button class="font-bold" type="submit">勤務開始</button>
                        </div>
                    </label>
                </form>
                @endisset
            </div>
        </div>

        <!-- 勤務終了ボタン -->
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm">
                @isset($attendance)
                    @empty($rest)
                    <form action="/attendance/end" method="post">
                        @csrf
                        <label>
                            <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer cursor-default md:py-20">
                                <button class="font-bold" type="submit">勤務終了</button>
                            </div>
                        </label>
                    </form>
                    @else
                    <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                        <div class="font-bold text-gray-400">勤務終了</div>
                    </div>
                    @endempty
                @else
                <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                    <div class="font-bold text-gray-400">勤務終了</div>
                </div>
                @endisset
            </div>
        </div>

        <!-- 休憩開始ボタン -->
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm">
                @isset($attendance)
                    @empty($rest)
                    <form action="/rest/start" method="post">
                        @csrf
                        <label>
                            <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer md:py-20">
                                <button class="font-bold" type="submit">休憩開始</button>
                            </div>
                        </label>
                    </form>
                    @else
                    <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                        <div class="font-bold text-gray-400">休憩開始</div>
                    </div>
                    @endempty
                @else
                <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                    <div class="font-bold text-gray-400">休憩開始</div>
                </div>
                @endisset
            </div>
        </div>

        <!-- 休憩終了ボタン -->
        <div class="w-5/12 mx-auto my-6">
            <div class="bg-white overflow-hidden shadow-sm">
                @isset($attendance)
                    @isset($rest)
                    <form action="/rest/end" method="post">
                        @csrf
                        <label>
                            <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-pointer md:py-20">
                                <button class="font-bold" type="submit">休憩終了</button>
                            </div>
                        </label>
                    </form>
                    @else
                    <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                        <div class="font-bold text-gray-400">休憩終了</div>
                    </div>
                    @endisset
                @else
                <div class="py-3 px-auto bg-white border-b border-gray-200 flex item-center justify-center cursor-default md:py-20">
                    <div class="font-bold text-gray-400">休憩終了</div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</x-appmember-layout>
