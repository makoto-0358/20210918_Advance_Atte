<x-appmember-layout>
    <div>
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>
    <div>
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        @isset($attendance)
                            <tr><td>勤務開始できない</td></tr>
                        @else
                        <form action="/attendance/start" method="post">
                            @csrf
                            <tr><td><button type="submit">勤務開始できる</button></td></tr>
                        </form>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        @isset($attendance)
                            @empty($rest)
                            <form action="/attendance/end" method="post">
                                @csrf
                                <tr><td><button type="submit">勤務終了できる</button></td></tr>
                            </form>
                            @else
                            <tr><td>勤務終了できない</td></tr>
                            @endempty
                        @else
                        <tr><td>勤務終了できない</td></tr>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        @isset($attendance)
                            @empty($rest)
                            <form action="/rest/start" method="post">
                                @csrf
                                <tr><td><button type="submit">休憩開始できる</button></td></tr>
                            </form>
                            @else
                            <tr><td>休憩開始できない</td></tr>
                            @endempty
                        @else
                        <tr><td>休憩開始できない</td></tr>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        @isset($attendance)
                            @isset($rest)
                            <form action="/rest/end" method="post">
                                @csrf
                                <tr><td><button type="submit">休憩終了できる</button></td></tr>
                            </form>
                            @else
                            <tr><td>休憩終了できない</td></tr>
                            @endisset
                        @else
                        <tr><td>休憩終了できない</td></tr>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-appmember-layout>
