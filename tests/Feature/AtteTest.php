<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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

    // /no_routeへ行けない事の確認
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
    // 既存ユーザーがログインできない事の確認
    public function test_not_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'error_password',
        ]);

        $this->assertGuest();
    }
}
