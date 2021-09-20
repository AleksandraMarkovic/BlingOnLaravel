<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RateProductController extends Controller
{
    public function rate(Request $request){
        $rating = $request->get('rating');
        $product_id = $request->get('product_id');
        if(session()->has('user')){
            $user_id = session('user')->user_id;
        }

        try {
            $insert = \DB::table('grades')->insert([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'grade' => $rating
            ]);

            if($insert){
                return 'Thank you for rating our products!';
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }

    }
}
