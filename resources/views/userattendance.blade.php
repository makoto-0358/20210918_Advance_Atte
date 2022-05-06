<x-appmember-layout>

    <!-- ログイン中のユーザー名表示 -->
    <div class="px-4 py-12 text-center text-2xl break-words md:w-4/5 md:mx-auto">{{ Auth::user()->name }}さんの勤怠一覧</div>

    <!-- 打刻結果表示 -->
    <table class="flex justify-center items-center text-center break-words md:w-4/5 md:mx-auto">
        <tr class="flex justify-center items-center border-t-2 border-gray-400 text-xs md:text-base">
        <!-- <tr class="flex items-center border-t-2 border-gray-400"> -->
            <!-- <th class="w-10 py-4 mx-auto flex justify-center items-center text-xs md:w-56 md:text-base">名前</th> -->
            <th class="w-16 mx-1 py-4 md:w-56">勤務開始日</th>
            <th class="w-16 mx-1 py-4 md:w-56">勤務開始</th>
            <th class="w-16 mx-1 py-4 md:w-56">勤務終了</th>
            <th class="w-16 mx-1 py-4 md:w-56">休憩時間</th>
            <th class="w-16 mx-1 py-4 md:w-56">勤務時間</th>
        </tr>
        @foreach($items as $item)
            <tr class="flex items-center border-t-2 border-gray-400 text-xs md:text-base">
            <!-- <tr class="flex items-center border-t-2 border-gray-400"> -->
                <!-- <td class="w-10 py-4 mx-auto flex justify-center items-center text-xs overflow-auto md:w-56 md:text-base">{{$item->name}}</td> -->
                <td class="w-16 mx-1 py-4 md:w-56">{{substr($item->start_time, 0, 10)}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{substr($item->start_time, 11, 8)}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{substr($item->end_time, 11, 8)}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{$item->sum_resting_time}}</td>
                <td class="w-16 mx-1 py-4 md:w-56">{{$item->working_time}}</td>
            </tr>
        @endforeach
    </table>

    <!-- ページネーション -->
    <!-- <div class="my-12 flex justify-center items-center"> -->
    <!-- <div class="flex justify-center items-center"> -->
    <!-- <div class="my-auto flex justify-center items-center"> -->
    <!-- <div class="my-auto flex justify-center"> -->
        <!-- {{$items->links()}} -->
    <!-- </div> -->
    <div class="flex justify-center">
        <div class="my-12">{{$items->links()}}</div>
    </div>
</x-appmember-layout>
