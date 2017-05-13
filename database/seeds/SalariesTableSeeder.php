<?php

use Illuminate\Database\Seeder;

class SalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salaries')->insert(
            [
                [
                    'salary' => '0 - 5.000.000 VND'
                ],
                [
                    'salary' => '5.000.000 - 10.000.000 VND'
                ],
                [
                    'salary' => '10.000.000 - 15.000.000 VND'
                ],
                [
                    'salary' => '15.000.000 - 20.000.000 VND'
                ],
                [
                    'salary' => 'Trên 20.000.000 VND'
                ]
            ]
        );
    }
}
