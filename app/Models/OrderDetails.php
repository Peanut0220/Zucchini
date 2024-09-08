<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'orderDetail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['orderDetail_id','food_id', 'order_id','price','quantity','subtotal'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->orderDetail_id)) {
                $model->orderDetail_id = self::generateUniqueId();
            }
        });
    }

    private static function generateUniqueId()
    {
        $prefix = 'OD';
        $lastId = self::orderBy('orderDetail_id','desc')->first();
        $number = $lastId ? (int)substr($lastId->orderDetail_id, 1) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}

