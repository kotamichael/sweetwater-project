<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('sweetwater_test')->get()->each(function ($record) {
            // Look for date patterns in the comments field (MM/DD/YY)
            if(preg_match(
                '/\d{2}\/\d{2}\/\d{2}/',
                $record->comments,
                $matches)) {
                
                $dateString = $matches[0];

                // Use strtotime() to parse the date string into a Unix timestamp
                $timestamp = strtotime($dateString);

                // Format the timestamp into a 'YYYY-MM-DD' date string
                $extractedDate = date('Y-m-d', $timestamp);

                // Update the record with the extracted date
                DB::table('sweetwater_test')
                    ->where('orderid', $record->orderid)
                    ->update(['shipdate_expected' => $extractedDate]);
            } else {
                return; // Skip if no date string found
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sweetwater_test', function (Blueprint $table) {
            //
        });
    }
};
