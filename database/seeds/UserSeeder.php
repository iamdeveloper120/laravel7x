<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i=0; $i<10; $i++) {
            $role = $i == 0 ? 'admin' : 'user';
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@email.com',
                'role' => $role,
                'password' => bcrypt('password'),
                'remember_token' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
