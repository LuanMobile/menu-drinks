<?php

namespace App\Exports;

use App\Http\Requests\DrinkRequest;
use App\Services\CocktailApiService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DrinkExport implements FromCollection, WithHeadings
{
    public function __construct(
        private array $reportData
    ) {
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->reportData);
    }

    public function headings(): array
    {
        return array_keys($this->collection()->first());
    }
}
