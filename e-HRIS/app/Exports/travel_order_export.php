<?php

namespace App\Exports;

use App\Models\travel_order\to_travel_orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class travel_order_export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // php artisan make:export travel_order_export --model=travel_order/to_travel_orders

    public function collection()
    {
        return to_travel_orders::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Surname',
            'Email',
            'Twitter',
        ];
    }
}
