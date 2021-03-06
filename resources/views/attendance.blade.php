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
    <table class="flex justify-center items-center text-center break-words md:w-4/5 md:mx-auto">
        <tr class="flex justify-center items-center border-t-2 border-gray-400 text-xs md:text-base">
            <th class="w-16 mx-1 py-4 md:w-56">名前</th>
            <th class="w-16 mx-1 py-4 md:w-56">勤務開始</th>
            <th class="w-16 mx-1 py-4 md:w-56">勤務終了</th>
            <th class="w-16 mx-1 py-4 md:w-56">休憩時間</th>
            <th class="w-16 mx-1 py-4 md:w-56">勤務時間</th>
        </tr>
        @foreach($items as $item)
            <tr class="flex items-center border-t-2 border-gray-400 text-xs md:text-base">
                <td class="w-16 mx-1 py-4 md:w-56">{{$item->name}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{substr($item->start_time, 11, 8)}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{substr($item->end_time, 11, 8)}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{$item->sum_resting_time}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{$item->working_time}}</td>
            </tr>
        @endforeach
    </table>

    <!-- ページネーション -->
    <div class="flex justify-center">
        <div class="my-12">{{$items->links()}}</div>
    </div>
</x-appmember-layout>
