<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert(
            [
        		[
                        'name' => 'All'
        		],
        		[
                        'name' => 'Intern'
        		],
                    [
                        'name' => 'Junior'
        		],
        		[
                        'name' => 'Developer'
        		],
                    [
                        'name' => 'Senior'
        		],
                    [
                        'name' => 'Project Manager'
        		],
                    [
                        'name' => 'Bridge Engineer'
        		],
                    [
                        'name' => 'Tester'
        		]    
            ]
    	);
    }
}
