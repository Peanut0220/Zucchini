<?php
//Author: Chong Jian
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CouponController extends Controller
{
    public function getCoupons()
    {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL certificate verification
        ])->get('https://localhost:44332/api/coupon');
        if ($response->successful()) {
            return view('custonly.coupon', ['coupons' => $response->json()]);
        } else {
            return response('Error fetching coupons', 500);
        }
    }

    public function getCoupon($id)
    {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL certificate verification
        ])->get('https://localhost:44332/api/coupon/'.$id);
        if ($response->successful()) {
            return view('custonly.coupon', ['coupon' => $response->json()]);
        } else {
            return response('Coupon not found', 404);
        }
    }
}
