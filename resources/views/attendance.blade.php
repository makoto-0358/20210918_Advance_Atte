<x-appmember-layout>
    <!-- <div class="py-12"> -->
        <!-- <div class="w-4/5 mx-auto flex content-between"> -->
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
                <!-- <div> -->
                    <table class="w-4/5 mx-auto flex justify-center">
                        <tr class="flex justify-center items-center my-12">
                            <td>
                                <a href="/attendance/{{$beforedate}}">
                                    <div class="mx-8 w-12 h-8 bg-white border-2 rounded border-solid border-blue-400 relatve">
                                        <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-t-2 border-solid border-blue-400 transform origin-left -rotate-12"></div>
                                        <div class="absolute mt-3 ml-2 w-6 h-0 box-border border-b-2 border-solid border-blue-400 transform origin-left rotate-12"></div>
                                    </div>
                                </a>
                            </td>
                            <td class="text-2xl">{{date('Y-m-d', strtotime($date))}}</td>
                            <td>
                                <a href="/attendance/{{$afterdate}}">
                                    <div class="mx-8 w-12 h-8 bg-white border-2 rounded border-solid border-blue-400 flex items-center">
                                        <div class="ml-3 w-4 h-4 border-t-2 border-r-2 border-solid border-blue-400 transform rotate-45"></div>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr class="flex content-between border-t-2 border-gray-400">
                            <th class="mx-20 my-5">名前</th>
                            <th class="mx-20 my-5">勤務開始</th>
                            <th class="mx-20 my-5">勤務終了</th>
                            <th class="mx-20 my-5">休憩時間</th>
                            <th class="mx-20 my-5">勤務時間</th>
                        </tr>
                        @foreach($items as $item)
                            <tr class="flex content-between border-t-2 border-gray-400">
                                <td class="mx-20 my-5">{{$item->name}}</td>
                                <td class="mx-20 my-5">{{substr($item->start_time, 11, 8)}}</td>
                                <td class="mx-20 my-5">{{substr($item->end_time, 11, 8)}}</td>
                                <td class="mx-20 my-5">{{$item->sum_resting_time}}</td>
                                <td class="mx-20 my-5">{{$item->working_time}}</td>
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
