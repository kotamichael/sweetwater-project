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
        $categorizedComments = $this->orderReportService->getCategorizedComments();
        
        return view('order_report', compact('categorizedComments'));
    }
}
