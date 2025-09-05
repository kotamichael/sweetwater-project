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
        foreach (Category::all() as $category) {
            $categoryName = $category->name;
            $categorizedComments[$categoryName] = Order::categorize($category->search_term)->pluck('comments');
        };
        $categorizedComments["Miscellaneous Comments"] = Order::everythingElse(Category::pluck('search_term')->all())->pluck('comments');

        return view(view: 'order_report', data: compact('categorizedComments'));
    }
}
