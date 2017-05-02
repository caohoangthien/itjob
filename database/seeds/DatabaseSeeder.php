<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(SalariesTableSeeder::class);
    }
}
