<?php

namespace App\Exports;

use App\Models\CinemaReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class CinemaReportExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return CinemaReport::whereDate('created_at', $this->date)
            ->with(['user', 'cinema', 'hall', 'movie', 'showtime', 'epc'])
            ->get()
            ->map(function ($report) {
                return [
                    'show_date'    => $report->show_date ?? 'N/A',
                    'user_name'    => optional($report->user)->name ?? 'N/A',
                    'cinema_name'  => optional($report->cinema)->name ?? 'N/A',
                    'hall_name'    => optional($report->hall)->name ?? 'N/A',
                    'movie_name'   => optional($report->movie)->name ?? 'N/A',
                    'showtime'     => optional($report->showtime)->showtime ?? 'N/A',
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
                    'total_seats'  => (int) ($report->total_seats ?? 0),
                    'total_revenue' => (int) ($report->total_revenue ?? 0),
                    'epc_status'   => optional($report->epc)->status . '%' ?? '0%',
                ];
            });
    }



    public function headings(): array
    {
        return [
            'Show Date',
            'User Name',
            'Cinema Name',
            'Hall Name',
            'Movie Name',
            'Showtime',
            '2000 တန်း',
            '2500 တန်း',
            '3000 တန်း',
            '3500 တန်း',
            '4000 တန်း',
            '4500 တန်း',
            '5000 တန်း',
            '5500 တန်း',
            '6000 တန်း',
            '6500 တန်း',
            '7000 တန်း',
            '7500 တန်း',
            '8000 တန်း',
            '8500 တန်း',
            '9000 တန်း',
            '9500 တန်း',
            '10000 တန်း',
            '10500 တန်း',
            '12000 တန်း',
            '16000 တန်း',
            '17500 တန်း',
            '20000 တန်း',
            '22500 တန်း',
            '25000 တန်း',
            '30000 တန်း',
            'Total Seats',
            'Total Revenue',
            'EPC Status',
        ];
    }
}
