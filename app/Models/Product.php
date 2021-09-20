<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    /*  ------------ UPITI ZA PRIKAZ --------------- */

    public function getTopProducts($number){
        return \DB::table('products')->select('products.id','name', 'main_image', 'prices.price', DB::raw('round(AVG(grades.grade), 1) as grade'))
            ->join('prices', 'products.id', '=', 'prices.product_id')
            ->leftJoin('grades', 'products.id', '=', 'grades.product_id')
            ->orderBy('products.created_at', 'desc')
            ->groupBy('products.id','name', 'main_image', 'prices.price')
            ->limit($number)
            ->get();
    }

    public function getAllProducts(){
        return \DB::table('products')->select('products.id', 'products.name', 'main_image', 'prices.price', DB::raw('round(AVG(grades.grade), 1) as grade'))
            ->join('prices', 'products.id', '=', 'prices.product_id')
            ->leftJoin('grades', 'products.id', '=', 'grades.product_id')
            ->groupBy('products.id', 'name', 'main_image', 'prices.price')
            ->paginate(6);
    }

    public function filterProducts($types, $colors, $brands, $sortValue, $search){
        $query = \DB::table('products');

        $query = $query->join('prices', 'products.id', '=', 'prices.product_id');
        $query = $query->join('types', 'products.type_id', '=', 'types.id');
        $query = $query->join('brands', 'products.brand_id', '=', 'brands.id');
        $query = $query->join('colors', 'products.color_id', '=', 'colors.id');
        $query = $query->leftJoin('grades', 'products.id', '=', 'grades.product_id');

        if(is_array($types)) {
            $query = $query->whereIn('products.type_id', $types);
        }

        if(is_array($brands)) {
            $query = $query->whereIn('products.brand_id', $brands);
        }

        if(is_array($colors)) {
            $query = $query->whereIn('products.color_id', $colors);
        }

        if($search) {
            $query = $query->where("products.name", "like", "%". $search ."%")
                ->orWhere("brands.name", "like", "%". $search ."%")
                ->orWhere("types.type", "like", "%". $search ."%");
        }

        if($sortValue) {
            if($sortValue == 'lowToHigh') {
                $query = $query->orderBy("prices.price");
            }

            if($sortValue == 'highToLow'){
                $query = $query->orderByDesc("prices.price");
            }

            if($sortValue == 'highestRating'){
                $query = $query->orderByDesc("grades.grade");
            }
        }

        $query = $query->select('products.id', 'products.name as name', 'main_image', 'prices.price', DB::raw('round(AVG(grades.grade), 1) as grade'));
        $query = $query->groupBy('products.id', 'products.name', 'main_image', 'prices.price');
        $query = $query->paginate(6);

        return $query;
    }

    public function getOneProduct($id){
        return \DB::table('products')->select('products.*', 'prices.price', 'brands.name as brand', 'types.id as type_id', 'types.type', 'colors.id as color_id', 'colors.name as color')
            ->join('prices', 'products.id', '=', 'prices.product_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->join('colors', 'products.color_id', '=', 'colors.id')
            ->where('products.id', $id)
            ->first();
    }

    public function getProductSizes($id){
        return \DB::table('product_size')->select('sizes.*', 'product_size.quantity')
            ->join('sizes', 'product_size.size_id', '=', 'sizes.id')
            ->where('product_id', $id)
            ->where('product_size.quantity', '>', 0)
            ->get();
    }

    public function getProductImages($id){
        return \DB::table('photos')->select('image', 'alt')
            ->join('products', 'products.id', '=', 'photos.product_id')
            ->where('product_id', $id)
            ->get();
    }


    public function getProductGrades($id){
        return \DB::table('grades')->select(DB::raw('round(AVG(grade), 1) as grade'))
            ->join('products', 'products.id', '=', 'grades.product_id')
            ->where('product_id', $id)
            ->get();
    }


    /* --------------- KRAJ --------------- */


    public static function image($key){
        move_uploaded_file($_FILES[$key]['tmp_name'], public_path().'/assets/images/'.time() . $_FILES[$key]['name']);
        return time() . $_FILES[$key]['name'];
    }

    public static function insertImage($image, $id){
        \DB::table('photos')->insert([
            'image' => $image,
            'product_id' => $id
        ]);
    }

    public static function updateImage($image, $id){
        \DB::table('photos')->where('id', $id->id)
            ->update([
                'image' => $image
            ]);
    }

    public function sizes($sizes, $id){
        $sizeIds = [];
        for ($i = 0; $i < count(explode(",", $sizes)); $i ++) {
            $sizeIds[] = \DB::table('sizes')->insertGetId([
                'size' => explode(",", $sizes)[$i]
            ]);
        }

        for($i = 0; $i < count($sizeIds); $i++) {
            \DB::table('product_size')->insert([
                'product_id' => $id,
                'size_id' => $sizeIds[$i],
                'quantity' => 10
            ]);
        }
    }
}
