<x-applogined-layout>
    <div>
        {{ Auth::user()->name }}さんお疲れ様です！
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
                    <form action="/attendance/start" method="post">
                        @csrf
                        <table>
                        @isset($attendance)
                            <tr><td><button type="submit">勤務開始できない</button></td></tr>
                        @else
                            <tr><td><button type="submit">勤務開始できる</button></td></tr>
                        @endisset
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/attendance/end" method="post">
                        @csrf
                        <table>
                        @isset($attendance)
                            @empty($rest)
                                <tr><td><button type="submit">勤務終了できる</button></td></tr>
                            @endempty
                        @else
                            <tr><td><button type="submit">勤務終了できない</button></td></tr>
                        @endisset
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/rest/start" method="post">
                        @csrf
                        <table>
                        @isset($attendance)
                            @empty($rest)
                                <tr><td><button type="submit">休憩開始できる</button></td></tr>
                            @endisset
                        @else
                            <tr><td><button type="submit">休憩開始できない</button></td></tr>
                        @endisset
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/rest/end" method="post">
                        @csrf
                        <table>
                        @isset($attendance)
                            @isset($rest)
                                <tr><td><button type="submit">休憩終了できる</button></td></tr>
                            @endisset
                        @else
                            <tr><td><button type="submit">休憩終了できない</button></td></tr>
                        @endisset
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-applogined-layout>
