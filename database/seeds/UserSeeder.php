<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        for ($i=0; $i < 10; $i++) { 
            $name = 'diak'.$i;
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name.'@iskola.hu',
                'password' => Hash::make($name),
                'teacher' => false,
                ]);
        }

        for ($i=0; $i < 10; $i++) { 
            $name = 'tanar'.$i;
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name.'@iskola.hu',
                'password' => Hash::make($name),
                'teacher' => true,
                ]);
        }
    }

}
