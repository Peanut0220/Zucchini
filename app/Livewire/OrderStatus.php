<?php

namespace App\Livewire;

use Livewire\Component;

class OrderStatus extends Component
{
    public $status;

    protected $listeners = ['refreshOrderPage' => 'updateStatus'];

    public function mount($initialStatus)
    {
        $this->status = $initialStatus;
    }

    public function updateStatus($newStatus)
    {
        $this->status = $newStatus;
    }

    public function render()
    {
        return view('livewire.order-status');
    }
}
