<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorizedComments = {};
        foreach (Category::all() as $category) {
            $categoryName = $category->name;
            $categorizedComments[$categoryName] = Order::categorize($categoryName)->get();
        }
        return view("'orders.index'", compact('categorizedComments'));
    }
}
