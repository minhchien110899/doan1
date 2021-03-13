<?php

use Illuminate\Database\Seeder;
use App\Question;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::truncate();

        Question::create(['content' => 'Chữ số 7 trong số thập phân 2006,007 có giá trị là', 'chapter_id' => 1]);
        // A. 7 B.7/10 C..7/1000 D.7/100
        Question::create(['content' => 'Phân số 1/160 viết dưới dạng số thập phân là', 'chapter_id' => 1]);
        // A. 0,625 B. 0,0625 C.. 0,00625 D. 0,000625.
        Question::create(['content' => 'Thay các chữ a, b, c bằng các chữ số khác nhau và khác 0 sao cho: 0,abc = 1/(a + b + c)', 'chapter_id' => 1]);
	    		//     A. a = 1 	B. a = 1 		C.. a = 1

						// b = 2 		b = 2 			b = 2

						// c = 5 		c = 3 			c = 4
        Question::create(['content' => 'Cho dãy số: 1; 4; 9; 16; 25; ...; ...; ...;
3 số cần viết tiếp vào dãy số trên là:', 'chapter_id' => 2]);
        // A.. 36, 49, 64 B. 36, 48, 63 C. 49, 64, 79 D. 35, 49, 64
        Question::create(['content' => 'Chữ số 5 trong số thập phân 62,359 có giá trị là bao nhiêu?', 'chapter_id' => 2]);
        // A. 5 B. 5/10 C.. 5/100 D. 5/1000
        Question::create(['content' => 'Trong hộp có 40 viên bi, trong đó có 24 viên bi xanh. Tỉ số phần trăm của số bi xanh và số bi trong hộp là bao nhiêu?', 'chapter_id' => 2]);
        // A. 20% B. 40% C. 60% D. 80%
        Question::create(['content' => '(2007 – 2005) + (2003 – 2001) +...+ (7 – 5) + (3 – 1)', 'chapter_id' => 2]);
        // A. 1003 B.. 1004 C. 1005 D. 1006

        Question::create(['content' => ' 5840g bằng bao nhiêu kg?', 'chapter_id' => 3]);
        // A. 58,4kg B.. 5,84kg C. 0,584kg D. 0,0584kg
        Question::create(['content' => 'Có 10 người bước vào phòng họp. Tất cả đều bất tay lẫn nhau. Số cái bắt tay sẽ là:', 'chapter_id' => 3]);
        // A.. 45 B. 90 C. 54 D. 89

    }
}
