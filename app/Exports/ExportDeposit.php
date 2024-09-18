<?php

namespace App\Exports;

use App\Models\Deposit;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDeposit implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $deposits = DB::table('rentals')
            ->join('customers', 'rentals.customer_id', '=', 'customers.id')
            ->join('deposits', 'rentals.depo_id', '=', 'deposits.id')
            ->select(
                'customers.name as customer_name',
                'customers.acc_num',
                'customers.acc_num_name',
                'customers.bank',
                'deposits.amount',
                'deposits.return_amount',
            )
            ->get();
        return $deposits;
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Account Number',
            'Account Owner',
            'Bank',
            'Deposit',
            'Return Amount',
        ];
    }
}
