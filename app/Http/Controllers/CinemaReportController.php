<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Epc;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\ShowTime;
use App\Models\TicketPrice;

use App\Models\CinemaReport;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\CinemaReportRepository;
use App\Http\Requests\CinemaReportStoreRequest;
use App\Http\Requests\CinemaReportUpdateRequest;

class CinemaReportController extends Controller
{
    protected $cinemaReportRepository;

    public function __construct(CinemaReportRepository $cinemaReportRepository)
    {
        $this->cinemaReportRepository = $cinemaReportRepository;
    }

    public function index()
    {

        // $cinemaReports = CinemaReport::all();
        // dd($cinemaReports->toArray());
        return view('cinema-report.index');
    }

    // Cinema Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->cinemaReportRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        $user_id = Auth::user()->id;
        $cinema_id = Auth::user()->cinema_id;
        $cinema = Cinema::find($cinema_id);
        $movies = Movie::latest()->get();
        $epcs = Epc::latest()->get();

        $showtime_ids = json_decode($cinema->showtime_ids, true);
        $showtimes = ShowTime::whereIn('id', $showtime_ids)->get();

        $ticketprice_ids = json_decode($cinema->ticketprice_ids, true);
        $ticketprices = TicketPrice::whereIn('id', $ticketprice_ids)->get();

        $prices = $ticketprices->pluck('price');


        $hall_ids = json_decode($cinema->hall_ids, true);
        $halls = Hall::whereIn('id', $hall_ids)->get();

        // dd($cinema->hall_ids);
        return view('cinema-report.create', compact('cinema', 'movies', 'epcs', 'user_id', 'halls', 'showtimes', 'ticketprices', 'prices'));
    }
    // End Method

    //Cinema Store Method
    public function store(CinemaReportStoreRequest $request)
    {
        try {
            // Prepare the data for creation
            $data = [
                'user_id' => $request->user_id,
                'cinema_id' => $request->cinema_id,
                'hall_id' => $request->hall_id,
                'movie_id' => $request->movie_id,
                'show_date' => $request->date,
                'showtime_id' => $request->showtime_id,
                'total_seats' => $request->total_seats,
                'total_revenue' => $request->total_revenue,
                'epc_id' => $request->epc_id,
            ];
    
            // Check if 'prices' are provided and add them to the data array
            if ($request->has('prices')) {
                foreach ($request->prices as $price => $value) {
                    // Ensure the column exists in the fillable array of the model
                    if (in_array($price, (new CinemaReport)->getFillable())) {
                        $data[$price] = $value;
                    }
                }
            }
    
            // Store the cinema report with all the dynamic prices using the repository
            $this->cinemaReportRepository->create($data);
    
            return Redirect::route('cinema-report.index')->with('success', 'Cinema Report Created Successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    // End Method



    // Edit Method
    public function edit($id)
    {
        $cinemaReport = $this->cinemaReportRepository->find($id);
        $user_id = Auth::user()->id;
        $cinema_id = Auth::user()->cinema_id;
        $cinema = Cinema::find($cinema_id);
        $movies = Movie::latest()->get();
        $epcs = Epc::latest()->get();

        $showtime_ids = json_decode($cinema->showtime_ids, true);
        $showtimes = ShowTime::whereIn('id', $showtime_ids)->get();

        $ticketprice_ids = json_decode($cinema->ticketprice_ids, true);
        $ticketprices = TicketPrice::whereIn('id', $ticketprice_ids)->get();

        $prices = $ticketprices->pluck('price');


        $hall_ids = json_decode($cinema->hall_ids, true);
        $halls = Hall::whereIn('id', $hall_ids)->get();


        return view('cinema-report.edit', compact('cinema', 'halls', 'showtimes', 'epcs', 'movies', 'ticketprices', 'prices', 'cinemaReport'));
    }

    // End Method

    public function update(CinemaReportUpdateRequest $request, $id)
    {
        try {
            $cinemaReport = $this->cinemaReportRepository->find($id);
    
            $data = [
                'user_id' =>  $request->user_id ?? $cinemaReport->user_id,
                'cinema_id' => $request->cinema_id ?? $cinemaReport->cinema_id,
                'hall_id' => $request->hall_id ?? $cinemaReport->hall_id,
                'movie_id' => $request->movie_id ?? $cinemaReport->movie_id,
                'show_date' => $request->date ?? $cinemaReport->show_date,
                'showtime_id' => $request->showtime_id ?? $cinemaReport->showtime_id,
                'total_seats' => $request->total_seats ?? $cinemaReport->total_seats,
                'total_revenue' => $request->total_revenue ?? $cinemaReport->total_revenue,
                'epc_id' => $request->epc_id ?? $cinemaReport->epc_id,
            ];
    
            // Check if 'prices' are provided and add them to the data array
            if ($request->has('prices') && is_array($request->prices)) {
                foreach ($request->prices as $price => $value) {
                    // Ensure the column exists in the fillable array of the model
                    if (in_array($price, (new CinemaReport)->getFillable())) {
                        $data[$price] = $value;
                    }
                }
            }
    
            // Update the cinema report with the provided data, including prices
            $this->cinemaReportRepository->update($data, $id);
    
            return redirect()->route('cinema-report.index')->with('success', 'Cinema updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    



    // Delete Method
    public function destroy($id)
    {
        try {
            $this->cinemaReportRepository->delete($id);
            return ResponseServices::success([], 'Cinema Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
