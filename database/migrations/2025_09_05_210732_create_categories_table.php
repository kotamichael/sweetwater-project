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
            $table->string('search_term');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Candy Comments', 'search_term' => 'candy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Call-Me Comments', 'search_term' => 'call ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Referral Comments', 'search_term' => 'refer', 'created_at' => now(), 'updated_at' => now()],
            ['name'=> 'Signature Requirement Comments', 'search_term' => 'signature', 'created_at'=> now(), 'updated_at'=> now()]
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
