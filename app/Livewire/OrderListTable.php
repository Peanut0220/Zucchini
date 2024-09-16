<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Carbon;
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

final class OrderListTable extends PowerGridComponent
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
        return Order::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('order_id')
            ->add('user_id')
            ->add('payment_type')
            ->add('total')
            ->add('discount')
            ->add('tax')
            ->add('final')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'order_id')
                ->sortable()
                ->searchable(),
            Column::make('User id', 'user_id')
                ->sortable()
                ->searchable(),

            Column::make('Payment type', 'payment_type')
                ->sortable()
                ->searchable(),

            Column::make('Total', 'total')
                ->sortable()
                ->searchable(),
            Column::make('Discount', 'discount')
                ->sortable()
                ->searchable(),

            Column::make('Tax', 'tax')
                ->sortable()
                ->searchable(),

            Column::make('Final', 'final')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
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
                ->route('order.show', ['order' => $row])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
