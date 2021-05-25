<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class SendMailWhenExpiredTimeEqualOneDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mailPersonalize';

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
        $usersNeedAlert = DB::select('select * FROM personalizes p join users u on p.user_id = u.id where p.expired_time - NOW() <= 86400 and p.expired_time - NOW() > 0 and p.done = 0');
        foreach($usersNeedAlert as $i => $user):

        endforeach;    
        return 0;
    }
}
