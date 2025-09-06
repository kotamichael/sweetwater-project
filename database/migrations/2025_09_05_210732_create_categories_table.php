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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('search_regexp');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Candy Comments', 'search_regexp' => '(?i)candy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Call-Me Comments', 'search_regexp' => '(?i)\b(call me|call me if|no phone call|call if|call when|call tomorrow|please call|please call me|call about|feel free to call|do not call|no calls|no phone calls|have [^ ]+ call|confirmation call)\b', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Referral Comments', 'search_regexp' => '(?i)(referred|referral)', 'created_at' => now(), 'updated_at' => now()],
            ['name'=> 'Signature Requirement Comments', 'search_regexp' => '(?i)(signature)', 'created_at'=> now(), 'updated_at'=> now()]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
