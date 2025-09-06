<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;

class OrderReportService {
    protected $categoryModel;
    protected $orderModel;

    public function __construct($categoryModel, $orderModel) {
        $this->categoryModel = $categoryModel;
        $this->orderModel = $orderModel;
    }
    
    public function getCategorizedComments(): array {
        try {
            $categorizedComments = [];

            $categories = $this->categoryModel->all();
            foreach ($categories as $category) {
                $categorizedComments[$category->name] = $this->orderModel
                    ->newQuery()
                    ->categorize($category->search_regexp)
                    ->pluck('comments');
            }

            $searchRegexps = $categories->pluck('search_regexp')->all();
            $categorizedComments['Miscellaneous Comments'] = $this->orderModel
                ->newQuery()
                ->everythingElse($searchRegexps)
                ->pluck('comments');

            return $categorizedComments;
        } catch (\Throwable $e) {
            Log::error('Error in getCategorizedComments: ' . $e->getMessage());
            return [];
        }
    }
}