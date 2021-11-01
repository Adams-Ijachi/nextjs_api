<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Product,
    ProductCategory
};


class ProductsController extends Controller
{
    //

    public function index()
    {
        $products = Product::with('productCategory')->get();
        $categories = ProductCategory::all();
        return response()->json([
            'products' => $products,
            'categories' => $categories
        ],200);
    }

    // getAllProduct
}
