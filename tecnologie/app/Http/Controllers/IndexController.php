<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index(){
        $productsAll = Product::inRandomOrder()->where('feature_item',1)->paginate(8);
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        return view('index')->with(compact('productsAll','categories'));
    }
}
