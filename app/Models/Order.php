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
}
