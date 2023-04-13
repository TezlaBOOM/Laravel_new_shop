<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use Exception;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome',[
            'products'=> Product::paginate(10),
            'categories'=> ProductCategory::all(),
        ]);
    }
}