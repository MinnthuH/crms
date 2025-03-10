<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ResponseServices;

use App\Http\Requests\ShowtimeStoreRequest;
use App\Repositories\ShowtimeRepository;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;


class ShowtimeController extends Controller
{
    protected $showtimeRepository;

    public function __construct(ShowtimeRepository $showtimeRepository)
    {
        $this->showtimeRepository = $showtimeRepository;
    }

    public function index()
    {
        return view('showtime.index');
    }

    // Showtime Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
           return $this->showtimeRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        return view('showtime.create');
    }
    // End Method

   //Showtime Store Method
   public function store(ShowtimeStoreRequest $request)
   {
       try {
           $this->showtimeRepository->create([
               'showtime' => $request->showtime,
           ]);

           return Redirect::route('showtime.index')->with('success', 'Showtime Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $showtime = $this->showtimeRepository->find($id);
        return view('showtime.edit', compact('showtime'));
    }
    // End Method

   //Showtime Update Method
   public function update(ShowtimeStoreRequest $request, $id)
   {
       try {
           $showtime = $this->showtimeRepository->find($id);
           $this->showtimeRepository->update([
               'showtime' => $request->showtime,
           ], $id);

           return Redirect::route('showtime.index')->with('success', 'Showtime Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->showtimeRepository->delete($id);
            return ResponseServices::success([], 'Showtime Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
