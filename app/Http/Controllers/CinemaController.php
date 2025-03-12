<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Hall;
use App\Models\ShowTime;
use App\Models\TicketPrice;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use Illuminate\Support\Facades\Hash;
use App\Repositories\CinemaRepository;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CinemaStoreRequest;
use App\Http\Requests\CinemaUpdateRequest;

class CinemaController extends Controller
{
    protected $cinemaRepository;

    public function __construct(CinemaRepository $cinemaRepository)
    {
        $this->cinemaRepository = $cinemaRepository;
    }

    public function index()
    {
        return view('cinema.index');
    }

    // Cinema Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
           return $this->cinemaRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        $hall= Hall::latest()->get();
        $showtime = Showtime::latest()->get()->map(function ($show) {
            $show->formatted_showtime = Carbon::parse($show->showtime)->format('h:i A');
            return $show;
        });
        $ticketPrice= TicketPrice::latest()->get();
        return view('cinema.create',compact('hall','showtime','ticketPrice'));
    }
    // End Method

   //Cinema Store Method
   public function store(CinemaStoreRequest $request)
   {
    // dd($request->all());

       try {
           $this->cinemaRepository->create([
               'name' => $request->name,
               'hall_id' => $request->hall_id,
               'showtime_id' => $request->showtime_id,
               'ticketprice_id' => $request->ticketprice_id,
           ]);

           return Redirect::route('cinema.index')->with('success', 'Cinema Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $cinema = $this->cinemaRepository->find($id);
        $halls = Hall::all();
        $showtimes = Showtime::all();
        $ticketPrices = TicketPrice::all();
    
        return view('cinema.edit', compact('cinema', 'halls', 'showtimes', 'ticketPrices'));
    }
    
    // End Method

    public function update(CinemaUpdateRequest $request, $id)
    {
        try {
            // Retrieve the existing cinema data
            $cinema = $this->cinemaRepository->find($id);
    
            // Only update the fields if they are changed, otherwise, keep the old value
            $cinema->name = $request->has('name') ? $request->name : $cinema->name;
            $cinema->hall_id = $request->has('hall_id') ? $request->hall_id : $cinema->hall_id;
            $cinema->showtime_id = $request->has('showtime_id') ? $request->showtime_id : $cinema->showtime_id;
            $cinema->ticketprice_id = $request->has('ticket_price_id') ? $request->ticket_price_id : $cinema->ticketprice_id;
    
            // Save the updated cinema
            $cinema->save();
    
            return redirect()->route('cinema.index')->with('success', 'Cinema updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    


    // Delete Method
    public function destroy($id)
    {
        try {
            $this->cinemaRepository->delete($id);
            return ResponseServices::success([], 'Cinema Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
