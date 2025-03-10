<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ResponseServices;

use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ShowtimeStoreRequest;
use App\Repositories\TicketPriceRepository;
use App\Http\Requests\TicketPriceStoreRequest;
use App\Http\Requests\TicketPriceUpdateRequest;


class TicketPriceController extends Controller
{
    protected $ticketPriceRepository;

    public function __construct(TicketPriceRepository $ticketPriceRepository)
    {
        $this->ticketPriceRepository = $ticketPriceRepository;
    }

    public function index()
    {
        return view('ticket-price.index');
    }

    // Ticket Price Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
           return $this->ticketPriceRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        return view('ticket-price.create');
    }
    // End Method

   //Ticket Price Store Method
   public function store(TicketPriceStoreRequest $request)
   {
       try {
           $this->ticketPriceRepository->create([
               'price' => $request->price,
           ]);

           return Redirect::route('ticket-price.index')->with('success', 'Ticket Price Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $ticketPrice = $this->ticketPriceRepository->find($id);
        return view('ticket-price.edit', compact('ticketPrice'));
    }
    // End Method

   //Ticket Price Update Method
   public function update(TicketPriceUpdateRequest $request, $id)
   {
       try {
           $ticketPrice = $this->ticketPriceRepository->find($id);
           $this->ticketPriceRepository->update([
               'price' => $request->price,
           ], $id);

           return Redirect::route('ticket-price.index')->with('success', 'Ticket Price Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->ticketPriceRepository->delete($id);
            return ResponseServices::success([], 'Ticket Price Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
