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

    public function scopeCategorize($query, $search = null)
    {
        if ($search) {
            $query->where('comments', 'like', '%' . $search . '%');
        }
    }

    # $excludedStrings = Category::pluck('name')->all();
    public function scopeEverythingElse($query, $excludedStrings = null)
    {
        if ($excludedStrings) {
            foreach ($excludedStrings as $string) {
                $query->where('comments', 'NOT LIKE', '%' . $string . '%');
            }
        }
    }
}
