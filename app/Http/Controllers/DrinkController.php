<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrinkRequest;
use App\Jobs\ExportJob;
use App\Jobs\SendExportEmailJob;
use App\Jobs\StoreExportDataJob;
use App\Models\Meal;
use App\Services\CocktailApiService;
use Inertia\Inertia;

class DrinkController extends Controller
{
    public function __construct(
        private CocktailApiService $service
    ) {
    }

    public function index(DrinkRequest $request)
    {
        //named arguments - ->getBeers(c: 'Beer)
        //spread operators - ->getBeers(...$args)
        $filters = $request->validated();
        $drinks  = $this->service->getBeers(...$filters);
        $meals = Meal::all();
        // dd($drinks);
        return Inertia::render('Drinks', [
            "drinks" => $drinks,
            "meals" => $meals,
            "filters" => $filters
        ]);
    }

    public function getDrink(DrinkRequest $request)
    {
        // dd($request->all());
        $drink = $this->service->getDetailsDrinks(...$request->validated());
        // dd($drink);

        $filteredDrinks = array_map(function ($value) {
            return array_map(function ($item) {
                return collect($item)
                    ->only(['strDrink', 'strInstructions', 'strDrinkThumb', 'strIngredient1', 'strIngredient2', 'strIngredient3', 'strIngredient4'])
                    ->toArray();
            }, $value);
        }, $drink);
        // dd($filteredDrinks);

        return Inertia::render('DrinkDetails', [
            "drink" => $filteredDrinks
        ]);
    }

    public function export(DrinkRequest $request)
    {
        // Fazer uso dos Jobs quando NÃO se precisa esperar TUDO rodar para retornar uma resposta ao usuário. 
        $filename = 'bebibas-encontradas-' . now('America/Sao_Paulo')->format('Y-m-d_H:i') . '.xlsx';

        ExportJob::withChain([
            new SendExportEmailJob($filename),
            new StoreExportDataJob(auth()->user(), $filename)
        ])->dispatch($request->validated(), $filename);

        return 'relatório criado';
    }
}
