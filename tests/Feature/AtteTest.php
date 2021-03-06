<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use Carbon\Carbon;


class AtteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     use RefreshDatabase;

    //  アクセスのテスト

    public function test_認証済みユーザーはログイン中にホーム画面へgetでアクセスできる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_認証済みユーザーがログイン中にホーム画面へgetでアクセスするとindexが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $response = $this->get('/');

        $response->assertViewIs('index');
    }

    public function test_認証済みユーザーはログイン中に日付一覧画面へアクセスできる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->get('/attendance');

        $response->assertStatus(200);
    }

    public function test_認証済みユーザーがログイン中に日付一覧画面へアクセスするとattendanceが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->get('/attendance');

        $response->assertViewIs('attendance');
    }

    public function test_認証済みユーザーはログイン中に勤怠一覧画面へアクセスできる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->get('/userattendance');

        $response->assertStatus(200);
    }

    public function test_認証済みユーザーがログイン中に勤怠一覧画面へアクセスするとuserattendanceが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->get('/userattendance');

        $response->assertViewIs('userattendance');
    }

    public function test_認証済みユーザーがログイン中にattendance_startへポストするとindexが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->post('/attendance/start');

        $response->assertRedirect(route('index'));
    }

    public function test_認証済みユーザーがログイン中にattendance_endへポストするとindexが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->post('/attendance/end');

        $response->assertRedirect(route('index'));
    }

    public function test_認証済みユーザーがログイン中にrest_startへポストするとindexが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->post('/rest/start');

        $response->assertRedirect(route('index'));
    }

    public function test_認証済みユーザーはログイン中にrest_endへポストするとindexが表示される()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->post('/rest/end');

        $response->assertRedirect(route('index'));
    }

    public function test_認証済みユーザーのログイン中でも存在しない画面へアクセスできない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->get('/no_route');

        $response->assertStatus(404);
    }


    // データベースのテスト

    public function test_勤務中でない場合、勤務開始できる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $attendance = '';
        $dt1 = now()->addHour();
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt1,
        ];
        Attendance::create($attendance);
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
        ]);
    }

    public function test_勤務中の場合、休憩中でなければ勤務終了できる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $attendance = '';
        $dt1 = now()->addHour();
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,

        ];
        Attendance::create($attendance);
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ]);

        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $rest = '';
        $dt2 = now()->addHours(2);
        $form['end_time'] = $dt2;
        unset($form["_token"]);
        $attendance->update($form);
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => $dt2,
        ]);
    }

    public function test_勤務中の場合、休憩中でなければ休憩開始できる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $attendance = '';
        $dt1 = now()->addHour();
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ];
        Attendance::create($attendance);
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ]);

        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $dt2 = now()->addHours(2);
        $rest = '';
        $rest = [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => null,
        ];
        Rest::create($rest);
        $response = $this->assertDatabaseHas('rests', [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => null,
        ]);
    }

    public function test_勤務中の場合、休憩中であれば休憩終了できる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $attendance = '';
        $dt1 = now()->addHour();
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ];
        Attendance::create($attendance);
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ]);

        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $dt2 = now()->addHours(2);
        $rest = '';
        $rest = [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => null,
        ];
        Rest::create($rest);
        $response = $this->assertDatabaseHas('rests', [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => null,
        ]);

        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
        $dt3 = now()->addHours(3);
        $form['end_time'] = $dt3;
        unset($form["_token"]);
        $rest->update($form);
        $response = $this->assertDatabaseHas('rests', [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => $dt3,
        ]);
    }
}
