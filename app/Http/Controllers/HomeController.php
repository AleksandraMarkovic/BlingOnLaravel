<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends OsnovniController
{
    private $productsModel;

    public function index(){
        $this->productsModel = new Product();
        $this->data['products'] = $this->productsModel->getTopProducts(3);
        return view('pages.main.home', $this->data);
    }
}
