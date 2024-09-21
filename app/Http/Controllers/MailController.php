<?php
//Author: Shi lei
namespace App\Http\Controllers;

use App\Mail\Receipt;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendMail(Order $order)
    {
        $user = User::where('user_id', Auth::id())->first();
        Mail::to($user->email)->send(new Receipt($order));
    }
}
