<?php

namespace App\Jobs;

use Exception;
use App\Mail\ExportEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendExportEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected String $filename,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to("luan@test.com")
            ->send(new ExportEmail($this->filename));
    }

    public function failed(Exception $exception)
    {
        // Lógica de tratamento de falha
        Log::error('Job falhou: ' . $exception->getMessage());
    }
}
