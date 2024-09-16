<?php
//Author: Shi Lei
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable =['category_id','name'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->category_id)) {
                $model->category_id = self::generateUniqueId();
            }
        });
    }

    public function foods()
    {
        return $this->hasMany(Food::class, 'food_id', 'food_id');
    }

    private static function generateUniqueId()
    {
        $prefix = 'CG';
        $number = 1;

        $lastId = self::orderBy('category_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->category_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
