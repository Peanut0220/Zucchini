<?php
//Author: Shi Lei
namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Delivery;

class OrderShow extends Component
{
    public $order; // Passed from the Blade template
    public $delivery;

    protected $listeners = ['refreshOrderPage'];

    public function mount($order)
    {
        $this->order = $order;
        $this->delivery = Delivery::where('order_id', $this->order->id)->first();
    }

    public function refreshOrderPage($deliveryStatus)
    {
        // Fetch updated delivery record and status
        $this->delivery->status = $deliveryStatus;
        $this->delivery->refresh(); // Refresh model instance
    }

    public function render()
    {
        return view('livewire.order-show', [
            'delivery' => $this->delivery,
            'order' => $this->order
        ]);
    }
}
