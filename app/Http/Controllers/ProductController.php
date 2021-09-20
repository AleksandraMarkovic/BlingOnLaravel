<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Grade;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends OsnovniController
{

    private $productsModel;
    private $typesModel;
    private $colorsModel;
    private $brandsModel;
    private $gradeModel;

    public function __construct()
    {
        parent::__construct();

        $this->productsModel = new Product();
        $this->typesModel = new Type();
        $this->colorsModel = new Color();
        $this->brandsModel = new Brand();
        $this->gradeModel = new Grade();

    }

    public function index(){
        $this->data['products'] = $this->productsModel->getAllProducts();
        $this->data['types'] = $this->typesModel->getTypes();
        $this->data['colors'] = $this->colorsModel->getColors();
        $this->data['brands'] = $this->brandsModel->getBrands();
        return view('pages.products.products', $this->data);
    }

    public function single($id){
        $this->data['product'] = $this->productsModel->getOneProduct($id);
        $this->data['sizes'] = $this->productsModel->getProductSizes($id);
        $this->data['photos'] = $this->productsModel->getProductImages($id);
        $this->data['grades'] = $this->productsModel->getProductGrades($id);
        if(session()->has('user')){
            $this->data['singleGrade'] = $this->gradeModel->getGrade($id);
        }
        return view('pages.products.single', $this->data);
    }

    public function sortFilter(Request $request){
        $types = $request->types;
        $colors = $request->colors;
        $brands = $request->brands;
        $sortValue = $request->sortValue;
        $search = $request->search;
        $productsData = $this->productsModel->filterProducts($types, $colors, $brands, $sortValue, $search);
        return response()->json($productsData);
    }


    public function create(){
        $this->data['types'] = $this->typesModel->getTypes();
        $this->data['colors'] = $this->colorsModel->getColors();
        return view('admin.create', $this->data);
    }

    public function store(StoreRequest $request){
        $name = $request->input('productName');
        $description = $request->input('productDescription');
        $color = $request->input('productColor');
        $type = $request->input('productType');
        $brand = $request->input('brandName');
        $price = $request->input('productPrice');
        $sizes = $request->input('productSize');

        $imageName = $this->productsModel->image('productImage');
        $imageName1 = $this->productsModel->image('image1');
        $imageName2 = $this->productsModel->image('image2');
        $imageName3 = $this->productsModel->image('image3');

        try{
            $selectBrand = \DB::table('brands')
                ->where('name', $brand)
                ->first();

            if($selectBrand){
                $brandId = $selectBrand->id;
            }
            else {
                $brandId = \DB::table('brands')->insertGetId([
                    'name' => $brand
                ]);
            }


            $insertProduct = \DB::table("products")->insertGetId([
                'name' => $name,
                'description' => $description,
                'main_image' => $imageName,
                'brand_id' => $brandId,
                'color_id' => $color,
                'type_id' => $type,
                'created_at' => Carbon::now()->toDateTime()
            ]);

            \DB::table('prices')->insert([
                'price' => $price,
                'date' => Carbon::now()->toDateTime(),
                'product_id' => $insertProduct
            ]);

            $this->productsModel->insertImage($imageName1, $insertProduct);
            $this->productsModel->insertImage($imageName2, $insertProduct);
            $this->productsModel->insertImage($imageName3, $insertProduct);

            $this->productsModel->sizes($sizes, $insertProduct);

            return redirect()->route('products.create')->with('success', 'Product added successfully!');
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }

    }

    public function edit($id){
        $this->data['product'] = $this->productsModel->getOneProduct($id);
        $this->data['sizes'] = $this->productsModel->getProductSizes($id);
        $this->data['types'] = $this->typesModel->getTypes();
        $this->data['colors'] = $this->colorsModel->getColors();
        return view('admin.edit', $this->data);
    }

    public function update(UpdateRequest $request, $id){
        $name = $request->input('productName');
        $description = $request->input('productDescription');
        $color = $request->input('productColor');
        $type = $request->input('productType');
        $brand = $request->input('brandName');
        $price = $request->input('productPrice');
        $sizes = $request->input('productSize');

        $imageName = $this->productsModel->image('productImage');
        $imageName1 = $this->productsModel->image('image1');
        $imageName2 = $this->productsModel->image('image2');
        $imageName3 = $this->productsModel->image('image3');

        try {
            $selectBrand = \DB::table('brands')
                ->where('name', $brand)
                ->first();

            if($selectBrand){
                $brandId = $selectBrand->id;
            }
            else {
                $brandId = \DB::table('brands')->insertGetId([
                    'name' => $brand
                ]);
            }

            \DB::table("products")->where('id', $id)
                ->update([
                    'name' => $name,
                    'description' => $description,
                    'main_image' => $imageName,
                    'brand_id' => $brandId,
                    'color_id' => $color,
                    'type_id' => $type
                ]);

            \DB::table('prices')->where('product_id', $id)
                ->update([
                    'price' => $price,
                    'date' => Carbon::now()->toDateTime()
                ]);

            $photoId1 = \DB::table('photos')->select('id')
                ->where('product_id', $id)
                ->first();

            $photoId2 = \DB::table('photos')->select('id')
                ->where('product_id', $id)
                ->offset(1)
                ->limit(1)
                ->first();

            $photoId3 = \DB::table('photos')->select('id')
                ->where('product_id', $id)
                ->offset(2)
                ->limit(1)
                ->first();

            $this->productsModel->updateImage($imageName1, $photoId1);
            $this->productsModel->updateImage($imageName2, $photoId2);
            $this->productsModel->updateImage($imageName3, $photoId3);


            \DB::table('product_size')->where('product_id', $id)->delete();
            $this->productsModel->sizes($sizes, $id);

            return redirect()->route('products.edit', $id)->with('success', 'Product updated successfully!');
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }

    }

    public function destroy($id){
        \DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products');

    }
}
