<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CartController extends OsnovniController
{

    private $cartModel;
    private $boughtModel;

    public function index(){
        return view('pages.main.cart', $this->data);
    }

    public function addToCart(Request $request){
        $product_id = $request->get('id');
        $size_id = $request->get('size');
        $quantity = $request->get('quantity');
        if(session()->has('user')){
            $user_id = session('user')->user_id;
        }

        try {
            $product_size_id = \DB::table('product_size')
                ->select('id', 'quantity')
                ->where('product_id', $product_id)
                ->where('size_id', $size_id)
                ->first();

            if($product_size_id){
                if($quantity > $product_size_id->quantity){
                    return "Not enough in stock!";
                }

                $select = \DB::table('carts')
                    ->where('product_size_id', $product_size_id->id)
                    ->where('user_id', $user_id)
                    ->first();
                if($select){
                    return 'Already in cart.';
                }
                else {
                    $insert = \DB::table('carts')->insert([
                        'product_size_id' => $product_size_id->id,
                        'user_id' => $user_id,
                        'quantity' => $quantity,
                        'bought' => false
                    ]);
                    if($insert){
                        \DB::table('admin')->insert([
                            'user_id' => session('user')->user_id,
                            'product_id' => $product_id,
                            'name' => session('user')->user_name,
                            'action' => 'Added to cart',
                            'date' => Carbon::now()->toDate()
                        ]);
                        return 'Successfully added to cart!';
                    }
                }

            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function showCart(){
        $this->cartModel = new Cart();
        $products = $this->cartModel->getCart();
        return response()->json($products);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        if(session()->has('user')){
            $user_id = session('user')->user_id;
        }

        $delete = \DB::table('carts')
            ->where('product_size_id', $id)
            ->where('user_id', $user_id)
            ->delete();

        if($delete){
            $this->cartModel = new Cart();
            $products = $this->cartModel->getCart();
            return response()->json($products);
        }
    }

    public function buy(Request $request){
        $insert = \DB::table('buys')->insert([
            'cart_id' => $request->get('id'),
            'date' => Carbon::now()->toDateTime()
        ]);

        if($insert){
            $quantity = \DB::table('product_size')
                ->select('quantity')
                ->where('id', $request->get('product_size_id'))
                ->first();

            $quantityCart = \DB::table('carts')
                ->select('quantity')
                ->where('id', $request->get('id'))
                ->first();

            \DB::table('product_size')->where('id', $request->get('product_size_id'))
                ->update([
                    'quantity' => $quantity->quantity - $quantityCart->quantity
                ]);

            \DB::table('carts')->where('id', $request->get('id'))
                ->update([
                    'bought' => true
                ]);

            $this->cartModel = new Cart();
            $products = $this->cartModel->getCart();
            return response()->json($products);
        }

    }

    public function bought(){
        $this->boughtModel = new Buy();
        $products = $this->boughtModel->getBought();
        return response()->json($products);
    }
}
