<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $task = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        //
        $this->task =$task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::error('kai shi tong bu '.$this->task);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://m.oneniceapp.com/open/pubShow'.$this->task);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        \Log::error('tong bu shu ju '.$output);
    }
}
