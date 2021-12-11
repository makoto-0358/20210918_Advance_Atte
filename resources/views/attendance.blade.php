<x-appmember-layout>
    <!-- 日付関係 -->
    <div class="flex justify-center items-center my-12">

        <!-- 前の日への矢印 -->
        <a href="/attendance/{{$beforedate}}">
            <div class="mx-8 w-12 h-8 bg-white border-2 rounded border-solid border-blue-400 relative">
                <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-t-2 border-solid border-blue-400 transform origin-left -rotate-12"></div>
                <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-b-2 border-solid border-blue-400 transform origin-left rotate-12"></div>
            </div>
        </a>

        <!-- 表示中の日付 -->
        <div class="text-2xl">{{date('Y-m-d', strtotime($date))}}</div>

        <!-- 次の日への矢印 -->
        <a href="/attendance/{{$afterdate}}">
            <div class="mx-8 w-12 h-8 bg-white border-2 rounded border-solid border-blue-400 relative">
                <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-t-2 border-solid border-blue-400 transform origin-right rotate-12"></div>
                <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-b-2 border-solid border-blue-400 transform origin-right -rotate-12"></div>
            </div>
        </a>
    </div>

    <!-- 打刻結果表示 -->
    <table class="flex justify-center items-center md:w-4/5 md:mx-auto">
        <tr class="flex items-center border-t-2 border-gray-400">
            <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">名前</th>
            <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">勤務開始</th>
            <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">勤務終了</th>
            <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">休憩時間</th>
            <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">勤務時間</th>
        </tr>
        @foreach($items as $item)
            <tr class="flex content-between border-t-2 border-gray-400">
                <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">{{$item->name}}</td>
                <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">{{substr($item->start_time, 11, 8)}}</td>
                <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">{{substr($item->end_time, 11, 8)}}</td>
                <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">{{$item->sum_resting_time}}</td>
                <th class="w-16 py-4 mx-1 flex justify-center items-center text-xs md:w-56 md:text-base">{{$item->working_time}}</td>
            </tr>
        @endforeach
    </table>

    <!-- ページネーション -->
    <div class="flex justify-center">
        {{$items->links()}}
    </div>
</x-appmember-layout>
