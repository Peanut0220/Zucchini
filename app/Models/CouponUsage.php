<?php
//Author: Chong Jian
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;

    protected $fillable =['coupon_id','user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

}
