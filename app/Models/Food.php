<?php
//Author: Chong Jian
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;
    // Set the primary key to 'food_id' and indicate it's not an auto-incrementing integer
    protected $primaryKey = 'food_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['food_id', 'name', 'description', 'category_id', 'price', 'image_path'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->food_id)) {
                $model->food_id = self::generateUniqueId();
            }
        });
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetails::class, 'food_id', 'food_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'food_id', 'food_id');
    }


    private static function generateUniqueId()
    {
        $prefix = 'F';
        $number = 1;

        $lastId = self::orderBy('food_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->food_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
