<?php

use Illuminate\Support\Facades\Log;
use App\Services\OrderReportService;

it('returns error view and logs error on exception', function () {
    // Mock the service to throw an exception
    $mock = Mockery::mock(OrderReportService::class);
    $mock->shouldReceive('getCategorizedComments')->andThrow(new Exception('Service error'));
    $this->app->instance(OrderReportService::class, $mock);

    // Spy on the Log facade
    Log::spy();

    $response = $this->get('/');

    $response->assertStatus(500);
    $response->assertSee('Unable to load order report');

    Log::shouldHaveReceived('error')
        ->withArgs(fn($message) => str_contains($message, 'Order report error: Service error'))
        ->atLeast()->once();
});