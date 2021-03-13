<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            UserSeeder::class,
            SubjectSeeder::class,
            chapterSeeder::class,
            QuestionSeeder::class,
            OptionSeeder::class,
            TestExamSeeder::class,
            QuestionTestexamSeeder::class,
        ]);
    }
}
