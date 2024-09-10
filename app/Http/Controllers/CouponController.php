<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Fetch coupon details from .NET service
    public function getCoupon()
    {
        // .NET Coupon API URL
        $apiUrl = 'http://localhost:44311/api/coupon'; // Change 'localhost' if necessary

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL and cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // Increase timeout if needed

        // Remove SSL options if not using HTTPS
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Enable verbose output for debugging
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_STDERR, fopen(storage_path('logs/curl.log'), 'w')); // Log verbose output

        // Execute cURL request
        $response = curl_exec($ch);

        if ($response === false) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return view('custonly.coupon', ['error' => 'Error fetching coupon data: ' . $error_msg]);
        }

        curl_close($ch);

        // Check if the response is valid JSON
        $couponData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return view('custonly.coupon', ['error' => 'Invalid JSON response from coupon service.']);
        }

        // Check for coupon data structure
        if (!isset($couponData['code'])) {
            return view('custonly.coupon', ['error' => 'Invalid coupon data received.']);
        }

        return view('custonly.coupon', ['coupon' => $couponData]);
    }


}
