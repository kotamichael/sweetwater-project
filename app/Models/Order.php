<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'sweetwater_test';
    protected $fillable = [];
    protected $primaryKey = 'orderid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    // Categorizes comments based on category search regexp: stored in categories table
    public function scopeCategorize($query, $regexp = null){
        if ($regexp && is_string($regexp)) {
            return $query->whereRaw('comments REGEXP ?', [$regexp]);
        }
        return $query;
    }

    // Gets everything else nto matching the regexps in categories
    public function scopeEverythingElse($query, $excludedRegexps = null){
        if ($excludedRegexps && is_array($excludedRegexps)) {
            foreach ($excludedRegexps as $regexp) {
                $query->whereRaw('NOT (comments REGEXP ?)', [$regexp]);
            }
        }
        return $query;
    }
}
