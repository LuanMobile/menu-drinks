<?php

namespace App\Jobs;

use App\Exports\DrinkExport;
use Illuminate\Bus\Queueable;
use App\Services\CocktailApiService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected array $data,
        protected String $filename,
        protected CocktailApiService $service = new CocktailApiService
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $drinks = $this->service->getBeers(...$this->data);

        Excel::store(new DrinkExport($drinks), $this->filename, 's3');
    }
}
