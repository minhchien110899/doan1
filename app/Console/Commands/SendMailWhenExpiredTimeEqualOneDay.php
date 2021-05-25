<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Subject;
use App\User;

class SendMailWhenExpiredTimeEqualOneDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mailpersonalize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail to user forget to do personalize elearning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $personalizes = DB::select('select * FROM personalizes where day(expired_time) - day(NOW()) <= 1 and day(expired_time) - day(NOW()) > 0 and done = 0');
        foreach($personalizes as $i => $personalize):
            $user = User::find($personalize->user_id);
            $subject = Subject::find($personalize->subject_id);
            $time = $personalize->expired_time; 
            Mail::to($user->email)->send(new \App\Mail\SendPersonalize($subject->name, $time));
        endforeach;    
        return 0;
    }
}
