<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderReportService {
    protected $categoryModel;
    protected $orderModel;

    public function __construct($categoryModel, $orderModel) {
        $this->categoryModel = $categoryModel;
        $this->orderModel = $orderModel;
    }
    
    public function getCategorizedComments(): array {
        try {
            // Cache categories for 60 minutes could overwrite etc. if categories change in the future
            $categories = cache()->remember('categories.ordered', 60, function () {
                return $this->categoryModel->orderBy('id')->get();
            });

            // Case-statement builder: adds column 'category' based on regex patterns
            $caseSql = '';
            foreach ($categories as $category) {
                $caseSql .= "WHEN comments REGEXP " . $this->orderModel->getConnection()->getPdo()->quote($category->search_regexp)
                    . " THEN " . $this->orderModel->getConnection()->getPdo()->quote($category->name) . " ";
            }
            $caseSql = "CASE $caseSql ELSE 'Miscellaneous Comments' END as category";

            $results = $this->orderModel
                ->newQuery()
                ->select(['comments', DB::raw($caseSql)])
                ->get();

            $categoryNames = $categories->pluck('name')->toArray();

            // Initialize the result array for each category
            $categorized = [];
            foreach ($categoryNames as $catName) {
                $categorized[$catName] = [];
            }

            // Sort comments to their categories: catch left-over in miscellaneous
            $misc = [];
            foreach ($results as $row) {
                if (in_array($row->category, $categoryNames)) {
                    $categorized[$row->category][] = $row->comments;
                } else {
                    $misc[] = $row->comments;
                }
            }

            // Add miscellaneous comments last if present
            if (!empty($misc)) {
                $categorized['Miscellaneous Comments'] = $misc;
            }

            return $categorized;
        } catch (\Throwable $e) {
            Log::error('Error in getCategorizedComments: ' . $e->getMessage());
            return [];
        }
    }
}