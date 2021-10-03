<x-applogined-layout>
    <div>
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
                <div class="p-6 border-t border-gray-200">
                    <form action="/attendance/start" method="post">
                        @csrf
                        <table>
                            <tr><td><button type="submit">勤務開始</button></td></tr>
                        </table>
                    </form>
                </div>
            <!-- </div> -->
        </div>
    </div>
</x-applogined-layout>
