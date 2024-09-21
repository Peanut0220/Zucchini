<?php
//Author: Shi Lei
namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class OrderTable extends PowerGridComponent
{
    use WithExport;

    public bool $showFilters = true;
    public bool $multiSort = true;
    public int $perPage = 10;
    public array $perPageValues = [0, 5, 10, 20, 50];

    public function setUp(): array
    {
        return [
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Order::query()
            ->leftJoin('deliveries', 'orders.order_id', '=', 'deliveries.order_id')
            ->where('orders.user_id', Auth::id()) // Filter by authenticated user
            ->select('orders.order_id', 'orders.final', 'deliveries.status as delivery_status', 'orders.created_at')
            ->orderBy('orders.order_id', 'asc'); // Explicitly order by 'order_id'
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('order_id')
            ->add('final')
            ->add('delivery_status') // Delivery status
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Order ID', 'order_id')
                ->sortable()
                ->searchable(),

            Column::make('Total', 'final')
                ->sortable()
                ->searchable(),

            Column::make('Delivery Status', 'delivery_status') // Delivery status column
            ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Order $row): array
    {
        return [
            Button::add('show')
                ->slot('Show')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('cusOrderShow', ['order' => $row])
        ];
    }
}
