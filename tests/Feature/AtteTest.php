<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
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

    //  /registerへ行けることの確認
    public function test_register()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    // /no_route(存在しない)へ行けない事の確認
    public function test_no_route()
    {
        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }

    // 新規ユーザー登録できる事の確認
    public function test_new_user()
    {
        $response = $this->post('/register',[
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    // 既存ユーザーがログインできる事の確認
    public function test_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    // 既存ユーザーがパスワードを間違えた場合にログインできない事の確認
    public function test_not_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'error_password',
        ]);

        $this->assertGuest();
    }

    //  /ログイン中にpostへ行けることの確認
    // public function test_post()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user);

    //     $response = $this->post('/rest/start');
    //     $response->assertRedirect(RouteServiceProvider::HOME);
    // }
    
    // 勤務中でない場合、勤務開始できることの確認。
    public function test_attendance_start()
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
        $response = $this->post('/attendance/start');
        $response->assertRedirect(route('index'));
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
        ]);
    }

        // 勤務中の場合、休憩中でなければ勤務終了できることの確認。
    public function test_attendance_end()
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
        $response = $this->post('/attendance/start');
        $response->assertRedirect(route('index'));
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
        $response = $this->post('/attendance/end');
        $response->assertRedirect(route('index'));
        $response = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => $dt2,
        ]);
    }

    // 勤務中の場合、休憩中でなければ休憩開始できることの確認。
    public function test_rest_start()
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
        $response = $this->post('/attendance/start');
        $response->assertRedirect(route('index'));
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
        $response = $this->post('/rest/start');
        $response->assertRedirect(route('index'));
        $response = $this->assertDatabaseHas('rests', [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => null,
        ]);
    }

    // 勤務中の場合、休憩中であれば休憩終了できることの確認。
    public function test_rest_end()
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
        $response = $this->post('/attendance/start');
        $response->assertRedirect(route('index'));
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
        $response = $this->post('/rest/start');
        $response->assertRedirect(route('index'));
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
        $response = $this->post('/rest/end');
        $response->assertRedirect(route('index'));
        $response = $this->assertDatabaseHas('rests', [
            'attendance_id' => $attendance->id,
            'start_time' => $dt2,
            'end_time' => $dt3,
        ]);
    }
}
