<?php

namespace App\Exports;

use App\Models\CinemaReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class WeeklyReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $startDate = Carbon::now()->startOfWeek(); // Monday
        $endDate = Carbon::now()->endOfWeek();     // Sunday

        return CinemaReport::whereBetween('created_at', [$startDate, $endDate])->get();
    }

    public function headings(): array
    {
        return [
            'Show Date', 'User Name', 'Cinema Name', 'Hall Name', 'Movie Name', 'Showtime',
            '2000', '2500', '3000', '3500', '4000', '4500', '5000', '5500', '6000', '6500',
            '7000', '7500', '8000', '8500', '9000', '9500', '10000', '10500', '12000', '16000',
            '17500', '20000', '22500', '25000', '30000', 'Total Seats', 'Total Revenue', 'EPC Status'
        ];
    }

    public function map($report): array
    {
        return [
            $report->show_date,
            optional($report->user)->name ?? 'N/A',
            optional($report->cinema)->name ?? 'N/A',
            optional($report->hall)->name ?? 'N/A',
            optional($report->movie)->name ?? 'N/A',
            optional($report->showtime)->showtime ?? 'N/A',
            $report->{"2000"} ?? 0,
            $report->{"2500"} ?? 0,
            $report->{"3000"} ?? 0,
            $report->{"3500"} ?? 0,
            $report->{"4000"} ?? 0,
            $report->{"4500"} ?? 0,
            $report->{"5000"} ?? 0,
            $report->{"5500"} ?? 0,
            $report->{"6000"} ?? 0,
            $report->{"6500"} ?? 0,
            $report->{"7000"} ?? 0,
            $report->{"7500"} ?? 0,
            $report->{"8000"} ?? 0,
            $report->{"8500"} ?? 0,
            $report->{"9000"} ?? 0,
            $report->{"9500"} ?? 0,
            $report->{"10000"} ?? 0,
            $report->{"10500"} ?? 0,
            $report->{"12000"} ?? 0,
            $report->{"16000"} ?? 0,
            $report->{"17500"} ?? 0,
            $report->{"20000"} ?? 0,
            $report->{"22500"} ?? 0,
            $report->{"25000"} ?? 0,
            $report->{"30000"} ?? 0,
            $report->total_seats ?? 0,
            $report->total_revenue ?? 0,
            optional($report->epc)->status . '%' ?? '0%',
        ];
    }
}
