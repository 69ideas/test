<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = config('app.debug') ? '123456' : str_random();

        $user = new \App\User();
        $user->first_name = "Root";
        $user->last_name = "administrator";
        $user->email = "root@root.my";
        $user->password = "123456";
        $user->save();


        $this->command->getOutput()->writeln('User: ' . $user->email . ' Password: ' . $pass);
    }
}
