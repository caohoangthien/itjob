<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert(
            [
        		[
                        'name' => 'IOS'
        		],
                    [
                        'name' => 'PHP'
        		],
        		[
                        'name' => 'Java'
        		],
                    [
                        'name' => '.Net'
        		],
                    [
                        'name' => 'NodeJs'
        		],
                    [
                        'name' => 'Ruby'
        		],
                    [
                        'name' => 'HTML,CSS,JAVASCRIPT'
        		],
                    [
                        'name' => 'Network'
        		],
                    [
                        'name' => 'Hardware'
                ]     
            ]
    	);
    }
}
