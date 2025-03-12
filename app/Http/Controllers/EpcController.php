<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use App\Repositories\EpcRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EpcStoreRequest;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class EpcController extends Controller
{
    protected $epcRepository;

    public function __construct(EpcRepository $epcRepository)
    {
        $this->epcRepository = $epcRepository;
    }

    public function index()
    {
        return view('epc.index');
    }

    // Epc Datable Method
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
           return $this->epcRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        return view('epc.create');
    }
    // End Method

   //Epc Store Method
   public function store(EpcStoreRequest $request)
   {
       try {
           $this->epcRepository->create([
               'status' => $request->status,
           ]);

           return Redirect::route('epc.index')->with('success', 'Epc Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $epc = $this->epcRepository->find($id);
        return view('epc.edit', compact('epc'));
    }
    // End Method

   //Epc Update Method
   public function update(EpcStoreRequest $request, $id)
   {
       try {
           $epc = $this->epcRepository->find($id);
           $this->epcRepository->update([
               'status' => $request->status,
           ], $id);

           return Redirect::route('epc.index')->with('success', 'Epc Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->epcRepository->delete($id);
            return ResponseServices::success([], 'Epc Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
