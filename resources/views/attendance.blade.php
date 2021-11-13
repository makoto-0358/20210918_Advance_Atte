<x-appmember-layout>
    <!-- <div class="py-12"> -->
        <!-- <div class="w-4/5 mx-auto flex content-between"> -->
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
                <!-- <div> -->
                    <!-- <div> -->
                        <div class="flex justify-center items-center my-12">
                            <a href="/attendance/{{$beforedate}}">
                                <div class="mx-8 w-12 h-8 bg-white border-2 rounded border-solid border-blue-400 relative">
                                    <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-t-2 border-solid border-blue-400 transform origin-left -rotate-12"></div>
                                    <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-b-2 border-solid border-blue-400 transform origin-left rotate-12"></div>
                                </div>
                            </a>
                            <div class="text-2xl">{{date('Y-m-d', strtotime($date))}}</div>
                            <a href="/attendance/{{$afterdate}}">
                                <div class="mx-8 w-12 h-8 bg-white border-2 rounded border-solid border-blue-400 relative">
                                    <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-t-2 border-solid border-blue-400 transform origin-right rotate-12"></div>
                                    <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-b-2 border-solid border-blue-400 transform origin-right -rotate-12"></div>
                                </div>
                            </a>
                        </div>
                    <!-- </div> -->
                    <table class="w-4/5 mx-auto flex justify-center">
                        <tr class="flex flex-no-wrap border-t-2 border-gray-400">
                            <th class="w-56 h-12 flex justify-center items-center">名前</th>
                            <th class="w-56 h-12 flex justify-center items-center">勤務開始</th>
                            <th class="w-56 h-12 flex justify-center items-center">勤務終了</th>
                            <th class="w-56 h-12 flex justify-center items-center">休憩時間</th>
                            <th class="w-56 h-12 flex justify-center items-center">勤務時間</th>
                        </tr>
                        @foreach($items as $item)
                            <tr class="flex content-between border-t-2 border-gray-400">
                                <td class="w-56 h-12 flex justify-center items-center">{{$item->name}}</td>
                                <td class="w-56 h-12 flex justify-center items-center">{{substr($item->start_time, 11, 8)}}</td>
                                <td class="w-56 h-12 flex justify-center items-center">{{substr($item->end_time, 11, 8)}}</td>
                                <td class="w-56 h-12 flex justify-center items-center">{{$item->sum_resting_time}}</td>
                                <td class="w-56 h-12 flex justify-center items-center">{{$item->working_time}}</td>
                            </tr>
                        @endforeach
                    </table>
                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
    <div class="flex justify-center">
        {{$items->links()}}
    </div>
</x-appmember-layout>
