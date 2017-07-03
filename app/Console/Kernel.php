<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Tokens as TokensEloquent;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->call(function(){//每30分鐘，將閒置超過30分鐘的token刪除，並登出
            $now=date("Y-m-d H:i:s",strtotime("-30 minute"));
            $tokens=TokensEloquent::where('types',0)->where('updated_at','<',$now)->get();
            foreach($tokens as $token){
                $token->delete();
            }
       })->everyThirtyMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
