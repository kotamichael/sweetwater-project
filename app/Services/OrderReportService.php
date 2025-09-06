<?php

namespace App\Services;

class OrderReportService
{
    protected $categoryModel;
    protected $orderModel;

    public function __construct($categoryModel, $orderModel)
    {
        $this->categoryModel = $categoryModel;
        $this->orderModel = $orderModel;
    }
    
    public function getCategorizedComments(): array
{
    $categorizedComments = [];

    $categories = $this->categoryModel->all();
    foreach ($categories as $category) {
        $categorizedComments[$category->name] = $this->orderModel
            ->newQuery()
            ->categorize($category->search_term)
            ->pluck('comments');
    }

    $searchTerms = $categories->pluck('search_term')->all();
    $categorizedComments['Miscellaneous Comments'] = $this->orderModel
        ->newQuery()
        ->everythingElse($searchTerms)
        ->pluck('comments');

    return $categorizedComments;
}
}