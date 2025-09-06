<?php

use App\Services\OrderReportService;
use Illuminate\Foundation\Testing\RefreshDatabase;

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