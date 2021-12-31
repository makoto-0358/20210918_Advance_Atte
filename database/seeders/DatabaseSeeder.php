<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->create()->each(function($user){
            Attendance::factory()->count(2)->make()->each(function($attendance)use($user){
                $user->attendances()->save($attendance);
                Rest::factory()->count(1)->make()->each(function($rest)use($attendance){
                    $attendance->rests()->save($rest);
                });
            });
        });
    }
}
