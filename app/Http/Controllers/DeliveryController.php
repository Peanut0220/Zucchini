<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adminonly.delivery.index',['deliveries'=>Delivery::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminonly.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        return view('adminonly.delivery.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        return view('adminonly.delivery.edit', compact('delivery'));
    }


    public function update(StoreDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->all());

        return redirect()->route('delivery.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        //
    }

    public function cusShow(Delivery $delivery){
        return view('custonly.delivery.cusShow', compact('delivery'));
    }

    public function getDeliveries()
    {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL certificate verification
        ])->get('https://localhost:44351/api/delivery');
        if ($response->successful()) {
            return view('custonly.checkout', ['deliveries' => $response->json()]);
        } else {
            return response('Error fetching coupons', 500);
        }
    }

    public function getDelivery($id)
    {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL certificate verification
        ])->get('https://localhost:44351/api/delivery/'.$id);
        if ($response->successful()) {
            return view('custonly.coupon', ['coupon' => $response->json()]);
        } else {
            return response('Coupon not found', 404);
        }
    }
}
