<?php

namespace App\Http\Controllers;

use App\Services\OrderReportService;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $orderReportService;

    public function __construct(OrderReportService $orderReportService)
    {
        $this->orderReportService = $orderReportService;
    }

    public function index() {
        // Extracted logic to service to improve testability and separation of concerns
        try {
            $categorizedComments = $this->orderReportService->getCategorizedComments();

            return view('order_report', compact('categorizedComments'));
        } catch (\Throwable $e) {
            Log::error('Order report error: ' . $e->getMessage());

            return response()->view('order_report_error', ['error' => 'Unable to load order report.'], 500);
        }
    }
}