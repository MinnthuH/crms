<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use App\Repositories\HallRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\HallStoreRequest;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;

class HallController extends Controller
{
    protected $hallRepository;

    public function __construct(HallRepository $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    public function index()
    {
        return view('hall.index');
    }

    // Hall Datable Method
    public function databale(Request $request)
    {
        if ($request->ajax()) {
           return $this->hallRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        return view('hall.create');
    }
    // End Method

   //Hall Store Method
   public function store(HallStoreRequest $request)
   {
       try {
           $this->hallRepository->create([
               'name' => $request->name,
           ]);

           return Redirect::route('hall.index')->with('success', 'Hall Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $hall = $this->hallRepository->find($id);
        return view('hall.edit', compact('hall'));
    }
    // End Method

   //Hall Update Method
   public function update(HallStoreRequest $request, $id)
   {
       try {
           $hall = $this->hallRepository->find($id);
           $this->hallRepository->update([
               'name' => $request->name,
           ], $id);

           return Redirect::route('hall.index')->with('success', 'Hall Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->hallRepository->delete($id);
            return ResponseServices::success([], 'Hall Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
