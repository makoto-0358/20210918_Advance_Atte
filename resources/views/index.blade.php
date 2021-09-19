<x-applogined-layout>
    <div>
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/attendance/start" method="post">
                        @csrf
                        <button type="submit">勤務開始</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/attendance/end" method="post">
                        @csrf
                        <button type="submit">勤務終了</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/rest/start" method="post">
                        @csrf
                        <button type="submit">休憩開始</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/rest/end" method="post">
                        @csrf
                        <button type="submit">休憩終了</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-applogined-layout>
