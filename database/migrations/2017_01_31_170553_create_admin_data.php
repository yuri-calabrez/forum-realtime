<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(6)
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('users')
            ->where('email', 'admin@user.com')
            ->delete();
    }
}
