<?php
//Author: Shi Lei
namespace App\Livewire;

use App\Models\Delivery;
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

final class DeliveryTable extends PowerGridComponent
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
        return Delivery::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('delivery_id')
            ->add('status')
            ->add('order_id')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'delivery_id'),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Order Id', 'order_id')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Updated at', 'updated_at')
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

    public function actions(Delivery $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('delivery.edit', ['delivery' => $row->delivery_id])
        ];
    }
}
