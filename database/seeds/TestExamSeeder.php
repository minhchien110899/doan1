<?php

use Illuminate\Database\Seeder;
use App\TestExam;
class TestExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestExam::truncate();

        // Đề toán 
        TestExam::create([
        	'name' => 'Toán Đề 1',
            'subject_id' => 1,
        	'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);
        TestExam::create([
        	'name' => 'Toán Đề 2',
            'subject_id' => 1,
        	'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);
        TestExam::create([
        	'name' => 'Toán Đề 3',
            'subject_id' => 1,
        	'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);

        //Đề Lý
        TestExam::create([
            'name' => 'Lý Đề 1',
            'subject_id' => 2,
            'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);
        TestExam::create([
            'name' => 'Lý Đề 2',
            'subject_id' => 2,
            'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);
        TestExam::create([
            'name' => 'Lý Đề 3',
            'subject_id' => 2,
            'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);

        //Đề Hóa
        TestExam::create([
            'name' => 'Hóa Đề 1',
            'subject_id' => 3,
            'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);
        TestExam::create([
            'name' => 'Hóa Đề 2',
            'subject_id' => 3,
            'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);
        TestExam::create([
            'name' => 'Hóa Đề 3',
            'subject_id' => 3,
            'description' => 'Đề thi thử trung học phổ thông quốc gia năm 2019-2020',
        ]);

    }
}
