<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = array(
            'username'   => 'administrator',
            'name'       => 'Ánh Dương™',
            'email'      => 'demo@gmail.com',
            'password'   => Hash::make('123456'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'group_id'   => 1,
            'status'     => 1
		);

        // Uncomment the below to run the seeder
        DB::table('acl_users')->insert($users);
    }
}
