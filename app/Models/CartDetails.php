<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetails extends Model
{
    use HasFactory;

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

    // Define the relationship with Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    // Define the relationship with Food
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'food_id');
    }

    private static function generateUniqueId()
    {
        $prefix = 'CD';
        $number = 1;

        $lastId = self::orderBy('cartDetail_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->cartDetail_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

}
