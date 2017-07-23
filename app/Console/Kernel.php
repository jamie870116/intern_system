<?php

namespace App\Console;

use App\Interviews;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Match as MatchEloquent;


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
//        $schedule->command('queue:work')->everyMinute();

        $schedule->call(function(){

            $match=MatchEloquent::where('mstatus',3)->get();

            foreach ($match as $m){
                $in=Interviews::where('mid',$m->mid)->first();
               $twoDayLater= $in->intime->subDays(2);
                $now=Carbon::now();
                if($now>$twoDayLater){
                   $m->mstatus=5;
                   $m->save();
                }
            }
        })->everyMinute();
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
