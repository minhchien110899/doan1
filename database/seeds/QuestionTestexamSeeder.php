<?php

use Illuminate\Database\Seeder;
use App\TestExam;
class QuestionTestexamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$testexam = TestExam::first();
    	$testexam->question()->attach([1,2,3,4,5,6,7,8,9]);
    }
}
