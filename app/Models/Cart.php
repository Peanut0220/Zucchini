<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'cart_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =['cart_id','total','user_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->cart_id)) {
                $model->cart_id = self::generateUniqueId();
            }
        });
    }

    // Define the relationship with CartDetails
    public function cartDetails()
    {
        return $this->hasMany(CartDetails::class, 'cart_id', 'cart_id');
    }

    private static function generateUniqueId()
    {
        $prefix = 'C';
        $lastId = self::orderBy('cart_id','desc')->first();
        $number = $lastId ? (int)substr($lastId->cart_id, 1) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
