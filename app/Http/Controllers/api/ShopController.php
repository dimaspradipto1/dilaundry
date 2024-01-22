<?php

namespace App\Http\Controllers\api;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    function readAll()
    {
        $shops = Shop::all();

        return response()->json([
            'data' => $shops,
        ], 200);
    }

    function readRecomendationLimit()
    {
            $shops = Shop::orderBy('rate', 'desc')
                ->limit(5)
                ->get();

            if(count($shops) > 0){
                return response()->json([
                    'data' =>$shops,
                ], 200);
            }else{
                return response()->json([
                    'message' => 'No data found',
                ], 404);
            }
    }

    function searchByCity($name)
    {
            $shops = Shop::orderBy('city','like', '%' .$name. '%')
                ->orderBy('name')
                ->get();

            if(count($shops) > 0){
                return response()->json([
                    'data' =>$shops,
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            }
    }
}
