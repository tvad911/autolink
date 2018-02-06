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
            'email'      => 'anhduongphuong@gmail.com',
            'password'   => Hash::make('anhphong'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'group_id'   => 1,
            'status'     => 1
		);

        // Uncomment the below to run the seeder
        DB::table('acl_users')->insert($users);

        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('acl_users')->insert([
                    'username'   => $faker->name,
                    'name'       => $faker->name,
                    'password'   => Hash::make('anhphong'),
                    'email'      => $faker->email,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'status'     => $faker->numberBetween(0,1),
                    'group_id'   => $faker->numberBetween(2,3)
            ]);
        }
    }
}
