<x-appmember-layout>

    <!-- 打刻結果表示 -->
    <table class="my-32 flex justify-center items-center md:w-4/5 md:mx-auto">
        <tr class="w-screen flex items-center border-t-2 border-gray-400 md:w-full">
            <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">名前</th>
            <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">勤務開始日</th>
            <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">勤務開始</th>
            <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">勤務終了</th>
            <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">休憩時間</th>
            <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">勤務時間</th>
        </tr>
        @foreach($items as $item)
            <tr class="w-screen flex content-between border-t-2 border-gray-400 md:w-full">
                <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">{{$item->name}}</td>
                <th class="w-10 py-4 mx-auto justify-center items-center text-xs md:w-56 md:text-base">{{substr($item->start_time, 0, 10)}}</td>
                <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">{{substr($item->start_time, 11, 8)}}</td>
                <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">{{substr($item->end_time, 11, 8)}}</td>
                <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">{{$item->sum_resting_time}}</td>
                <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">{{$item->working_time}}</td>
            </tr>
        @endforeach
    </table>

    <!-- ページネーション -->
    <div class="flex justify-center">
        {{$items->links()}}
    </div>
</x-appmember-layout>
