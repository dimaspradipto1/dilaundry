<?php

namespace App\Http\Controllers\api;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
   function readAll()
   {
      $promos = Promo::with('shop')->get();

      return response()->json([
         'data' => $promos,
      ], 200);
   }
}
