<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CocktailApiService
{   ///list.php?c=list = tipos de drinks
    public function getCategories()
    {
        return Http::cocktailapi()->get('/list.php?c=list')
            ->throw()
            ->json();
    }

    public function getBeers(
        ?string $c = null,
    ) {
        return Http::cocktailapi()->get('/filter.php', ['c' => $c]) // uma lista filtrada de drinks baseado no tipo de drink
            ->throw()
            ->json();
    }

    // i = ingredients
    public function getDetailsDrinks(
        ?string $i = null,
    ) {                                   /* ?i=15346 */
        return Http::cocktailapi()->get('/lookup.php', ['i' => $i]) // detalhes do drink
            ->throw()
            ->json();
    }
}
