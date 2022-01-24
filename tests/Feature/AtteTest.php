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
    
    // 勤務中でない場合、勤務開始できることの確認。
    public function test_attendance_start()
    {
        $user = User::factory()->create();
        $responce = $this->actingAs($user);
        $attendance = '';
        $attendance = [
            'user_id' => $user->id,
            'start_time' => now(),
        ];
        $responce = $this->post('/attendance/start', $attendance);

        $responce = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => now(),
        ]);
    }

    // 勤務中の場合、勤務開始できないことの確認。
    public function test_attendance_notstart()
    {
        $user = User::factory()->create();
        $responce = $this->actingAs($user);

        $attendance = '';

        $dt = now();
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt,
            'end_time' => null,

        ];
        $responce = $this->post('/attendance/start', $attendance);
        $responce = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt,
            'end_time' => null,
        ]);

        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $dt->addHours(2);
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt,
        ];
        $responce = $this->post('/attendance/start', $attendance);
        $responce = $this->assertDatabaseMissing('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt,
        ]);
    }

        // 勤務中の場合、休憩中でなければ勤務終了できることの確認。
    public function test_attendance_end()
    {
        $user = User::factory()->create();
        $responce = $this->actingAs($user);

        $attendance = '';
        
        $dt1 = now();
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,

        ];
        $responce = $this->post('/attendance/start', $attendance);
        $responce = $this->assertDatabaseHas('attendances', [
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
        $responce = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => $dt2,
        ]);
    }

    // 勤務中の場合、休憩中でなければ休憩開始できることの確認。
    public function test_rest_start()
    {
        $user = User::factory()->create();
        $responce = $this->actingAs($user);

        $attenance = '';
        // $dt1 = now();
        // $time = Attendance::factory()->faker->dateTimeBetween($startTime='-1hour', $endDate='+1hour');
        // $dt1 = $time->format('Y-m-d H:i:s');
        $dt1 = Attendance::factory()->start_time;
        dd($user);
        // $attendance = Attendance::factory()->create();
        // dd($time);
        // dd($user);
        // dd($attendance);
        // $dt1 = $time['start_time'];
        // dd($dt1);
        $attendance = [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ];
        $responce = $this->post('/attendance/start', $attendance);
        $responce = $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'start_time' => $dt1,
            'end_time' => null,
        ]);
        
        // $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        // $dt2 = now()->addHours(2);
        // $rest = '';
        // $rest = [
        //     'attendance_id' => $attendance->id,
        //     'start_time' => $dt2,
        //     'end_time' => null,
        // ];
        // // dd($rest['start_time']);
        // Rest::create($rest);
        // // $responce = $this->post('/rest/start', $rest);
        // dd($rest['start_time']);
        // $responce = $this->assertDatabaseHas('rests', [
        //     'attendance_id' => $attendance->id,
        //     'start_time' => $dt2,
        //     'end_time' => null,
        // ]);
    }
}
