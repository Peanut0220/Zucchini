<?php
//Author: Shi Lei
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banks extends Model
{
    use HasFactory;

    protected $fillable =['card_number','expiration_date','cvv'];
}
