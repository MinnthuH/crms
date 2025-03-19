<?php

namespace App\Exports;

use App\Models\SnackShopReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class SnackShopReportExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return SnackShopReport::whereDate('created_at', $this->date)
            ->with(['user', 'cinema', 'snackShop'])
            ->get()
            ->map(function ($report) {
                return [
                    'user_name' => $report->user->name ?? 'N/A',
                    'cinema_name' => $report->cinema->name ?? 'N/A',
                    'snack_shop_name' => $report->snackShop->name ?? 'N/A',
                    'date' => $report->date,
                    'opening_balance' => $report->opening_balance,
                    'sales' => $report->sales,
                    'save_amount' => $report->save_amount,
                    'total_expenses' => $report->total_expenses,
                    'transfer_amount' => $report->transfer_amount,
                    'closing_balance' => $report->closing_balance,
                    'surplus_deficits' => $report->surplus_deficits,
                    'total_surplus_deficits' => $report->total_surplus_deficits,
                    'description' => $report->description,
                ];
            });
    }



    public function headings(): array
    {
        return [
           'Staff Name',
            'ရုံအမည်',
            'မုန်ဆိုင်အမည်',
            'Date',
            'စာရင်းဖွင့် (Opening Balance)',
            'စာရင်းရရောင်းရငွေ',
            'အပ်ငွေ',
            'ယူငွေ / သုံးငွေ',
            'လွှဲငွေ',
            'မုန့်ဆိုင်ငွေလက်ကျန် (Closing Balance)',
            'ပိုငွေ / လို‌ငွေ',
            'ပိုငွေ / လို‌ငွေ လက်ကျန်စာရင်း',
            'Description',
        ];
    }
}
