<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['order_id', 'user_id','final','total','tax','discount'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->order_id)) {
                $model->order_id = self::generateUniqueId();
            }
        });
    }

    private static function generateUniqueId()
    {
        $prefix = 'OR';
        $lastId = self::orderBy('order_id', 'desc')->first();
        $number = $lastId ? (int)substr($lastId->order_id, 1) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
