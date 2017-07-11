<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;


class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data=$data;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data=$this->data;
        Mail::send('mail.send', $data, function($message) use($data)
        {
            $message->to($data['mail'], $data['code'])->subject('會員驗證信');
        });

    }
}
