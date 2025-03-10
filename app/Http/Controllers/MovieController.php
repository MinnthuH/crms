<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use App\Repositories\HallRepository;
use Illuminate\Support\Facades\Hash;
use App\Repositories\MovieRepository;
use App\Http\Requests\MovieStoreRequest;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MovieUpdateRequest;

class MovieController extends Controller
{
    protected $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index()
    {
        return view('movie.index');
    }

    // Movie Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
           return $this->movieRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        return view('movie.create');
    }
    // End Method

   //Movie Store Method
   public function store(MovieStoreRequest $request)
   {
       try {
           $this->movieRepository->create([
               'name' => $request->name,
           ]);

           return Redirect::route('movie.index')->with('success', 'Movie Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $movie = $this->movieRepository->find($id);
        return view('movie.edit', compact('movie'));
    }
    // End Method

   //Movie Update Method
   public function update(MovieUpdateRequest $request, $id)
   {
       try {
           $movie = $this->movieRepository->find($id);
           $this->movieRepository->update([
               'name' => $request->name,
           ], $id);

           return Redirect::route('movie.index')->with('success', 'Movie Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->movieRepository->delete($id);
            return ResponseServices::success([], 'Movie Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
