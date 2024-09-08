<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'cartDetail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['cartDetail_id','food_id', 'cart_id','quantity','subtotal'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->cartDetail_id)) {
                $model->cartDetail_id = self::generateUniqueId();
            }
        });
    }

    private static function generateUniqueId()
    {
        $prefix = 'CD';
        $lastId = self::orderBy('cartDetail_id','desc')->first();
        $number = $lastId ? (int)substr($lastId->cartDetail_id, 1) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

}
