<?php

use App\User;
use App\Subject;
use App\Solution;
use App\Task;

use Illuminate\Database\Seeder;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        // Delete previous data in tables
        User::truncate();
        Subject::truncate();
        Task::truncate();
        Solution::truncate();
        DB::table('subject_user')->delete();

        // Create fake teacher and student
        DB::table('users')->insert([
            'name' => 'Fikcionális Béla',
            'email' => 'tanar@iskola.hu',
            'password' => Hash::make('tanar'),
            'teacher' => true,
        ]);

        $this->command->info('User created. You can login as tanar@iskola.hu with the password \'tanar\'.');

        DB::table('users')->insert([
            'name' => 'Stréber Kitti',
            'email' => 'diak@iskola.hu',
            'password' => Hash::make('diak'),
            'teacher' => false,
        ]);

        $this->command->info('User created. You can login as diak@iskola.hu with the password \'diak\'.');

        DB::table('users')->insert([
            'name' => 'Okos Petra',
            'email' => 'diak2@iskola.hu',
            'password' => Hash::make('diak'),
            'teacher' => false,
        ]);

        $this->command->info('User created. You can login as diak2@iskola.hu with the password \'diak\'.');

        // Create subjects for the fake teacher
        Subject::create([
            'name' => 'Szerveroldali webprogramozás',
            'description' => 'Learning management szoftver készítése Laravel-ben',
            'code' => 'IK-SZW001',
            'kredit' => 4,
            'user_id' => 1,
            'public' => true
        ]);

        $this->command->info('Subject created for tanar@iskola.hu as \'Szerveroldali webprogramozás\'. Subject is public.');

        Subject::create([
            'name' => 'Kliensoldali webprogramozás',
            'description' => 'Stratego játék implementálása React segítségével',
            'code' => 'IK-KLW001',
            'kredit' => 4,
            'user_id' => 1,
            'public' => true
        ]);

        $this->command->info('Subject created for tanar@iskola.hu as \'Kliensoldali webprogramozás\'. Subject is public.');

        Subject::create([
            'name' => 'Fullstack webprogramozás',
            'description' => 'Hamarosan',
            'code' => 'IK-FLW001',
            'kredit' => 5,
            'user_id' => 1,
            'public' => false // This subject is not publicated yet
        ]);

        $this->command->info('Subject created for tanar@iskola.hu as \'Fullstack webprogramozás\'. Subject is not public.');

        // Subscribe the fake student to the first subject
        User::find(2)->subjects()->attach(Subject::find(1));

        $this->command->info('Student diak@iskola.hu subscribed to Subject \'Szerveroldali webprogramozás\'.');

    }
}
