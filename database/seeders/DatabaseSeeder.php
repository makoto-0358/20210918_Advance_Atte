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
        // User::factory()->count(2)->create()->each(function($user){
        //     Attendance::factory()->count(2)->make()->each(function($attendance)use($user){
        //         $user->attendances()->save($attendance);
        //     });
        // });

        // Rest::factory()->count(1)->make()->each(function($rest)use($attendance){
        //     $attendance->rests()->save($rest);
        // });

        // User::factory()->count(2)->create();

        // $user = User::factory()->create();
        // $attendance = Attendance::factory()->count(2)->for($user)->create();
        // $rest = Rest::factory()->count(2)->for($attendance)->create();

        // $rests = Rest::factory()->count(2)->for($attendance)->create();

        User::factory()->count(2)->create()->each(function($user){
            Attendance::factory()->count(2)->make()->each(function($attendance)use($user){
                $user->attendances()->save($attendance);
                Rest::factory()->count(1)->make()->each(function($rest)use($attendance){
                    $attendance->rests()->save($rest);
                });
            });
        });

        // User::factory()->count(2)->create()->each(function($user){
        //     Attendance::factory()->count(2)->make()->each(function($attendance)use($user){
        //         $user->attendances()->save($attendance);
        //     });
        // })->each(function($attendance){
        //     Rest::factory()->count(2)->make()->each(function($rest)use($attendance){
        //         $attendance->rests()->save($rest);
        //     });
        // });


    }
}
