<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert(
            [
        		[
                        'name' => 'admin',
                        'email' => 'admin@gmail.com',
                        'password' => bcrypt('admin'),
                        'status' => 1,
                        'role' => '1',
        		]
            ]
    	);
    }
}
