<?php
//Author: Shi Lei
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasFactory;

    protected $primaryKey = 'delivery_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =['delivery_id','address','status','rider','order_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->delivery_id)) {
                $model->delivery_id = self::generateUniqueId();
            }
        });
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }


    private static function generateUniqueId()
    {
        $prefix = 'D';
        $number = 1;

        $lastId = self::orderBy('delivery_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->delivery_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
