<?php
//Author: Chong Jian
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->user_id)) {
                $model->user_id = self::generateUniqueId();
            }
        });
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id', 'user_id');
    }

    public function couponUsages()
    {
        return $this->hasMany(CouponUsage::class, 'user_id', 'user_id');
    }


    private static function generateUniqueId()
    {
        $prefix = 'U';
        $number = 1;

        $lastId = self::orderBy('user_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->user_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
