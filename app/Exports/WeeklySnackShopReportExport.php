<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\SnackShopReport;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class WeeklySnackShopReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $startDate = Carbon::now()->startOfWeek(); // Monday
        $endDate = Carbon::now()->endOfWeek();     // Sunday

        return SnackShopReport::whereBetween('created_at', [$startDate, $endDate])->get();
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

    public function map($report): array
    {
        return [
            'user_name' => $report->user->name ?? 'N/A',
                    'cinema_name' => $report->cinema->name ?? 'N/A',
                    'snack_shop_name' => $report->snackShop->name ?? 'N/A',
                    'date' => $report->date,
                    'opening_balance' => $report->opening_balance ?? 0,
                    'sales' => $report->sales ?? 0,
                    'save_amount' => $report->save_amount ?? 0,
                    'total_expenses' => $report->total_expenses ?? 0,
                    'transfer_amount' => $report->transfer_amount ?? 0,
                    'closing_balance' => $report->closing_balance ?? 0,
                    'surplus_deficits' => $report->surplus_deficits ?? 0,
                    'total_surplus_deficits' => $report->total_surplus_deficits ?? 0,
                    'description' => $report->description ?? 'N/A',
        ];
    }
}
