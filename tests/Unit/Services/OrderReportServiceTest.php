<?php

use App\Services\OrderReportService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

it('can instantiate the service', function () {
    $categoryMock = Mockery::mock();
    $categoryMock->shouldReceive('all')->andReturn(collect());

    $orderMock = Mockery::mock();
    $orderMock->shouldReceive('categorize')->andReturn(collect());
    $orderMock->shouldReceive('everythingElse')->andReturn(collect());

    $service = new OrderReportService($categoryMock, $orderMock);
    expect($service)->toBeInstanceOf(OrderReportService::class);
});

it('returns empty array and logs error on exception', function () {
    $categoryMock = Mockery::mock();
    $categoryMock->shouldReceive('all')->andThrow(new Exception('DB error'));

    $orderMock = Mockery::mock();

    // Fake the Log facade
    Illuminate\Support\Facades\Log::shouldReceive('error')
        ->once()
        ->withArgs(function ($message) {
            return str_contains($message, 'Error in getCategorizedComments: DB error');
        });

    $service = new \App\Services\OrderReportService($categoryMock, $orderMock);
    $result = $service->getCategorizedComments();

    expect($result)->toBeArray();
    expect($result)->toBeEmpty();
});