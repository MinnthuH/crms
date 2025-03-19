<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Epc;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\ShowTime;
use App\Models\SnackShop;
use App\Models\TicketPrice;

use App\Models\CinemaReport;
use Illuminate\Http\Request;
use App\Models\SnackShopUser;
use App\Services\ResponseServices;
use App\Exports\CinemaReportExport;
use App\Exports\WeeklyReportExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SnackShopReportExport;
use Illuminate\Support\Facades\Redirect;
use App\Exports\WeeklySnackShopReportExport;
use App\Repositories\CinemaReportRepository;
use App\Http\Requests\CinemaReportStoreRequest;
use App\Repositories\SnackShopReportRepository;
use App\Http\Requests\CinemaReportUpdateRequest;
use App\Http\Requests\SnackShopReportStoreRequest;
use App\Http\Requests\SnackShopReportUpdateRequest;

class SnackShopReportController extends Controller
{
    protected $snackShopReportRepository;

    public function __construct(SnackShopReportRepository $snackShopReportRepository)
    {
        $this->snackShopReportRepository = $snackShopReportRepository;
    }

    public function index()
    {

        return view('snack-shop-report.index');
    }

    // Cinema Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->snackShopReportRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        $user_id = Auth::user()->id;
        $cinema_id = Auth::user()->cinema_id;
        $cinema = Cinema::find($cinema_id);
        $snack_shop_id = SnackShop::where('cinema_id', $cinema_id)->value('id');  

        return view('snack-shop-report.create', compact('cinema_id', 'snack_shop_id', 'user_id', 'cinema'));
    }
    // End Method

    // Store Method
    public function store(SnackShopReportStoreRequest $request)
    {
        try {

            $this->snackShopReportRepository->create([
                'user_id' => $request->user_id,
                'cinema_id' => $request->cinema_id,
                'snack_shop_id' => $request->snack_shop_id,
                'date' => $request->date,
                'opening_balance' => $request->opening_balance,
                'sales' => $request->sales,
                'save_amount' => $request->save_amount,
                'total_expenses' => $request->total_expenses,
                'transfer_amount' => $request->transfer_amount,
                'closing_balance' => $request->closing_balance,
                'surplus_deficits' => $request->surplus_deficits,
                'total_surplus_deficits' => $request->total_surplus_deficits,
                'description' => $request->description,
            ]);

            return Redirect::route('snack-shop-report.index')->with('success', 'Snack Shop Report Created Successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // End Method


    // Edit Method
    public function edit($id)
    {
        $snackShopReport = $this->snackShopReportRepository->find($id);
        $user_id = Auth::user()->id;
        $cinema_id = Auth::user()->cinema_id;
        $cinema = Cinema::find($cinema_id);
        $snack_shop_id = SnackShop::where('cinema_id', $cinema_id)->value('id');

        return view('snack-shop-report.edit', compact('cinema_id', 'snack_shop_id', 'user_id', 'cinema', 'snackShopReport'));
    }

    // End Method

    // Update Method
    public function update(SnackShopReportUpdateRequest $request, $id)
    {
        try {
            $cinemaReport = $this->snackShopReportRepository->find($id);

            // Prepare the data for updating
            $data = [
                'user_id' =>  $request->user_id ?? $cinemaReport->user_id,
                'cinema_id' => $request->cinema_id ?? $cinemaReport->cinema_id,
                'snack_shop_id' => $request->snack_shop_id ?? $cinemaReport->snack_shop_id,
                'date' => $request->date ?? $cinemaReport->date,
                'opening_balance' => $request->opening_balance ?? $cinemaReport->opening_balance,
                'sales' => $request->sales ?? $cinemaReport->sales,
                'save_amount' => $request->save_amount ?? $cinemaReport->save_amount,
                'total_expenses' => $request->total_expenses ?? $cinemaReport->total_expenses,
                'transfer_amount' => $request->transfer_amount ?? $cinemaReport->transfer_amount,
                'closing_balance' => $request->closing_balance ?? $cinemaReport->closing_balance,
                'surplus_deficits' => $request->surplus_deficits ?? $cinemaReport->surplus_deficits,
                'total_surplus_deficits' => $request->total_surplus_deficits ?? $cinemaReport->total_surplus_deficits,
                'description' => $request->description ?? $cinemaReport->description,
            ];

            $this->snackShopReportRepository->update($data, $id);

            return redirect()->route('snack-shop-report.index')->with('success', 'Snack Shop Report updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // End Method

    // Show Method
    public function show($id)
    {
        $snackShopReport = $this->snackShopReportRepository->find($id);
        return view('snack-shop-report.show', compact('snackShopReport'));
    }

    // End Method


    // Delete Method
    public function destroy($id)
    {
        try {
            $this->snackShopReportRepository->delete($id);
            return ResponseServices::success([], 'Snack Shop Report Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method

    // Download Method
    public function downloadDailyReport(Request $request)
    {
        $date = $request->query('date', Carbon::today()->toDateString()); // Defaults to today if no date is provided
        return Excel::download(new SnackShopReportExport($date), "snack_shop_report_{$date}.xlsx");
    }

    // Export Weekly Method
    public function exportWeekly()
    {
        return Excel::download(new WeeklySnackShopReportExport, 'weekly-snack-shop-report.xlsx');
    }
    // End Method
}
