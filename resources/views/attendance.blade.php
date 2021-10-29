<x-appmember-layout>
    <div>
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
                <div class="p-6 border-t border-gray-200">
                    <table>
                        <tr>
                            <a href="/attendance/{{$beforedate}}">前の日</a>
                            <td>{{date('Y-m-d', strtotime($date))}}</td>
                            <a href="/attendance/{{$afterdate}}">次の日</a>
                        </tr>
                        <tr>
                            <th>名前</th>
                            <th>勤務開始</th>
                            <th>勤務終了</th>
                            <th>休憩時間</th>
                            <th>勤務時間</th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{substr($item->start_time, 11, 8)}}</td>
                                <td>{{substr($item->end_time, 11, 8)}}</td>
                                <td>{{$item->sum_resting_time}}</td>
                                <td>{{$item->working_time}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            <!-- </div> -->
        </div>
    </div>
{{$items->links()}}
</x-appmember-layout>
