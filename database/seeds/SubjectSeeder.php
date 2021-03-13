<?php

use Illuminate\Database\Seeder;
use App\Subject;
class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//xóa dữ liệu trong bảng
    	// DB::table('subjects')->truncate();
    	Subject::truncate();

        Subject::create(['name' => 'Toán']);
        Subject::create(['name' => 'Lý']);
        Subject::create(['name' => 'Hóa']);

    }
}
