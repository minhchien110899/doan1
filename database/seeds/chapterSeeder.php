<?php

use Illuminate\Database\Seeder;
use App\Chapter;
use App\Subject;

class chapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chapter::truncate();
        $subjects = Subject::all(); 
        foreach($subjects as $key =>$subject):
        	for($i = 1; $i <= 4; $i++):
        		Chapter::create([
        			'name' => 'Chương '.$i,
        			'subject_id' => $subject->id,
        			'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        		]);
        	endfor;	
        endforeach;	
    }
}
