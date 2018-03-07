<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(UsersTableSeeder::class);
//        $threads = factory('App\Thread', 50)->create();
//        $threads->each(
//            function($thread){
//                factory('App\Reply', 10)->create(['thread_id'=>$thread->id]);
//            }
//        );
        $this->call(LaratrustSeeder::class);
        factory('App\User', 20)->create()->each(
            function ($user) {
                $user->attachRole(Role::where('name','user')->first());
                factory('App\Thread', 5)->create(['user_id'=>$user->id])->each(
                    function($thread){
                        factory('App\Reply', 10)->create(['thread_id'=>$thread->id]);
                    }
                );
            }
        );

    }
}
