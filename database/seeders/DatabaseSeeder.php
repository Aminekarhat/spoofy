<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\hr;
use App\Models\intern;
use App\Models\off;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(11)->create();

        for ($i=1; $i < 4; $i++) { 
            $user = User::find($i);
            hr::create(['name' => $user->name, 'user_id' => $user->id]);
        }
        //for ($i=2; $i < 7; $i++) { 
        //    $user = User::find($i);
        //    int::create(['name' => $user->name, 'user_id' => $user->id]);
        //}
        for ($i=5; $i < 10; $i++) { 
            $user = User::find($i);
            $hr = Hr::all()->random();
            intern::create(['hr_id' => $hr->id, 'user_id' => $user->id]);
        }
        for ($i=1; $i < 5; $i++) { 
            $intern = intern::find($i);
            $user = User::find($intern->user_id);
            off::create(['intern_id' => $intern->id, 'day' => 'kek']);
        }


    }
}
