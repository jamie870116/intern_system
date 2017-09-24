<?php

namespace App\Console;

use App\Interviews;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Course;
use App\Stu_course;
use App\Station_Letter;
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
            $course=Course::all();
            foreach ($course as $c){
                if(Carbon::now()>$c->courseEnd){
                    $stu_course=Stu_course::where('courseId', $c->courseId)->get();
                    foreach ($stu_course as $stu_c){
                        if($stu_c->assessmentStatu==0){
                            $stu_c->assessmentStatus=1;
                            $stu_c->save();
                            $company=Stu_course::find($stu_c->SCid)->user_com()->first();
                            $student=Stu_course::find($stu_c->SCid)->user_stu()->first();
                            $st_letter=new Station_Letter();
                            $st_letter->lStatus=14;
                            $st_letter->lTitle='成績考核通知';
                            $st_letter->lRecipient=$company->account;
                            $st_letter->lRecipientNmae=$company->u_name;
                            $st_letter->lContent='已經可以對'.$student->u_name.'進行成績考核，請至學生管理頁面操作\n';
                            $st_letter->lNotes='';
                            $st_letter->save();
                        }

                    }
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