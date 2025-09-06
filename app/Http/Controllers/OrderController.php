<?php

namespace App\Http\Controllers;

use App\Services\OrderReportService;

class OrderController extends Controller
{
    protected $orderReportService;

    public function __construct(OrderReportService $orderReportService)
    {
        $this->orderReportService = $orderReportService;
    }

    public function index()
    {
        // Extracted logic to service to improve testability and separation of concerns
        // TODO: Needs error handling etc.
        $categorizedComments = $this->orderReportService->getCategorizedComments();
        
        return view('order_report', compact('categorizedComments'));
    }
}
