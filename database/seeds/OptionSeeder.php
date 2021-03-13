<?php

use Illuminate\Database\Seeder;
use App\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::truncate();
        // A. 7 B.7/10 C..7/1000 D.7/100
        Option::create([
        	'name' => ['7', '7/10', '7/1000' ,'7/100'],
        	'question_id' => '1',
        	'answer' => '7/1000',
        ]);
        // A. 0,625 B. 0,0625 C.. 0,00625 D. 0,000625.
        Option::create([
        	'name' => ['0,625', '0,0625', '0,00625' ,'0,000625'],
        	'question_id' => '2',
        	'answer' => '0,00625',
        ]);

        //     A. a = 1 	B. a = 1 		C.. a = 1

						// b = 2 		b = 2 			b = 2

						// c = 5 		c = 3 			c = 4
        Option::create([
        	'name' => ['1-2-5', '1-2-3', '' ,'1-2-4'],
        	'question_id' => '3',
        	'answer' => '1-2-4',
        ]);
// A.. 36, 49, 64 B. 36, 48, 63 C. 49, 64, 79 D. 35, 49, 64
        Option::create([
        	'name' => ["36, 49, 64", "36, 48, 63", "49, 64, 79" , "35, 49, 64"],
        	'question_id' => '4',
        	'answer' => '36, 49, 64',
        ]);
     // A. 5 B. 5/10 C.. 5/100 D. 5/1000    
        Option::create([
        	'name' => ['5', '5/10', '5/100' ,'5/1000'],
        	'question_id' => '5',
        	'answer' => '5/100',
        ]);

        // A. 20% B. 40% C. 60% D. 80%
        Option::create([
        	'name' => ['20%', '40%', '60%' ,'80%'],
        	'question_id' => '6',
        	'answer' => '60%',
        ]);
        // A. 1003 B.. 1004 C. 1005 D. 1006
        Option::create([
        	'name' => ['1003', '1004', '1005' ,'1006'],
        	'question_id' => '7',
        	'answer' => '1004',
        ]);
        // A. 58,4kg B.. 5,84kg C. 0,584kg D. 0,0584kg
        Option::create([
        	'name' => ['58,4kg', '5,84kg', '0,584kg' ,'0,0584kg'],
        	'question_id' => '8',
        	'answer' => '5,84kg',
        ]);
        // A.. 45 B. 90 C. 54 D. 89
        Option::create([
        	'name' => ['45', '90', '54' ,'89'],
        	'question_id' => '9',
        	'answer' => '45',
        ]);
    }
}
