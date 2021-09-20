<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    public function getBought(){
        return \DB::table('products')->select('products.name', 'products.main_image', 'prices.price', 'sizes.size', 'brands.name as brand')
            ->join('prices', 'products.id', '=', 'prices.product_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('product_size', 'products.id', '=', 'product_size.product_id')
            ->join('sizes', 'sizes.id', '=', 'product_size.size_id')
            ->join('carts', 'product_size.id', '=', 'carts.product_size_id')
            ->join('buys', 'carts.id', '=', 'buys.cart_id')
            ->where('carts.user_id', session('user')->user_id)
            ->where('carts.bought', true)
            ->orderByDesc('buys.date')
            ->limit(3)
            ->get();
    }
}
