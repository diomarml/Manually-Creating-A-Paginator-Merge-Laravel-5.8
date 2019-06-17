<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class MainController extends Controller
{
   public function margedManualPagination(){
    $collection = collect(['product_id' => 1, 'price' => 100]);

    $merged = $collection->merge(['price' => 200, 'discount' => false]);
    
    $items = $merged;
    $perPage = 10;
    $total = count($items);
    $pagination= new LengthAwarePaginator(
        $items->forPage(Paginator::resolveCurrentPage() , $perPage),
        $items->count(), $perPage,
        Paginator::resolveCurrentPage(),
        ['path' => Paginator::resolveCurrentPath()]
    );

    return [
        'pagination' => [
            'total'        => $pagination->total(),
            'current_page' => $pagination->currentPage(),
            'per_page'     => $pagination->perPage(),
            'last_page'    => $pagination->lastPage(),
            'from'         => $pagination->firstItem(),
            'to'           => $pagination->lastItem(),
        ],
        'toShow'=> $pagination];
         
    
   }
}
