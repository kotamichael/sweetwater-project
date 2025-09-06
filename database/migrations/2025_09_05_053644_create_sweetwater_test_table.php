<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sweetwater_test', function (Blueprint $table) {
            $table->bigInteger('orderid')->primary();
            $table->text('comments')->nullable();
            $table->dateTime('shipdate_expected')->default('1970-01-01 00:00:00');
            // Add other columns as needed
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sweetwater_test');
    }
};
