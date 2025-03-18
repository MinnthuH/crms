<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use App\Repositories\SnackShopRepository;
use App\Models\SnackShop;
use App\Http\Requests\SnackShopStoreRequest;
use App\Http\Requests\SnackShopUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class SnackShopController extends Controller
{
    protected $snackShopRepository;

    public function __construct(SnackShopRepository $snackShopRepository)
    {
        $this->snackShopRepository = $snackShopRepository;
    }

    public function index()
    {
        return view('snack-shop.index');
    }

    // User Datable Method
    public function databale(Request $request)
    {
        if ($request->ajax()) {
           return $this->snackShopRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        $cinemas = Cinema::latest()->get();
        return view('snack-shop.create', compact('cinemas'));
    }
    // End Method

   //User Store Method
   public function store(SnackShopStoreRequest $request)
   {
       try {
           $this->snackShopRepository->create([
               'name' => $request->name,
               'cinema_id' => $request->cinema_id,
           ]);

           return Redirect::route('snack-shop.index')->with('success', 'Snack Shop Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $cinemas = Cinema::latest()->get();
        $snackShop = $this->snackShopRepository->find($id);
        return view('snack-shop.edit', compact('snackShop', 'cinemas'));
    }
    // End Method

   //User Update Method
   public function update(SnackShopUpdateRequest $request, $id)
   {
       try {
           $snackShop = $this->snackShopRepository->find($id);
   
           $this->snackShopRepository->update([
               'name' => $request->name ?? $snackShop->name,
               'cinema_id' => $request->cinema_id ?? $snackShop->cinema_id,
           ], $id);
   
           return Redirect::route('snack-shop.index')->with('success', 'Snack Shop Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } 
   // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->snackShopRepository->delete($id);
            return ResponseServices::success([], 'Snack Shop Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
