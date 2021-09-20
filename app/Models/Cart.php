<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function getCart(){


        return \DB::table('products')
            ->select('product_size.id', 'products.name', 'products.main_image', 'prices.price', 'brands.name as brand', 'sizes.size', 'carts.quantity', 'carts.id as cart_id')
            ->join('prices', 'products.id', '=', 'prices.product_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('product_size', 'products.id', '=', 'product_size.product_id')
            ->join('sizes', 'sizes.id', '=', 'product_size.size_id')
            ->join('carts', 'product_size.id', '=', 'carts.product_size_id')
            ->leftJoin('buys', 'carts.id', '=', 'buys.cart_id')
            ->where('carts.user_id', session('user')->user_id)
            ->where('carts.bought', false)
            ->get();
    }
}
