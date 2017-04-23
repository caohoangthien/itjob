<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                [
                    'account_id' => '1',
                    'name' => 'admin',
                    'avatar' => 'images/avatars/admin.png',
                ]
            ]
        );
    }
}
