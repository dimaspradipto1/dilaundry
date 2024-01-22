<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    function readAll()
    {
        $laundries = Laundry::with('user', 'shop')->get();

        return response()->json([
            'data' => $laundries,
        ], 200);
    }

    function whereUserId($id)
    {
            $laundries = Laundry::orderBy('city','=', $id)
                ->with('user', 'shop')
                ->orderBy('created_at', 'desc')
                ->get();

            if(count($laundries) > 0){
                return response()->json([
                    'data' =>$laundries,
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Not found',
                    'data' =>$laundries,
                ], 404);
            }
    }

    function claim(Request $request)
    {
        $laundry = Laundry::where([
            ['id'=> $request->id],
            ['claim', '=', $request->claim_code],
        ])->first();

        if(!$laundry){
            return response()->json([
                'message' => 'Claim code not found',
            ], 404);
        }

        if($laundry->user_id != 0){
            return response()->json([
                'message' => 'laundry has been claimed',
            ], 400);
        }

        $laundry->user_id = $request->user_id;
        $updated = $laundry->save();

        if($updated){
            return response()->json([
                'data' =>$updated,
            ], 201);
        }else{
            return response()->json([
                'message' => 'can not be updated',
                'data' =>$updated,
            ], 500);
        }
    }
}
