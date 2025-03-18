<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\AdminUser;
use App\Models\SnackShop;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\SnackShopUserRepository;
use App\Http\Requests\SnackShopUserStoreRequest;
use App\Http\Requests\SnackShopUserUpdateRequest;

class SnackShopUserController extends Controller
{
    protected $snackShopUserRepository;

    public function __construct(SnackShopUserRepository $snackShopUserRepository)
    {
        $this->snackShopUserRepository = $snackShopUserRepository;
    }

    public function index()
    {
        return view('snack-shop-user.index');
    }

    // User Datable Method
    public function databale(Request $request)
    {
        if ($request->ajax()) {
           return $this->snackShopUserRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        $snackShops = SnackShop::latest()->get();
        $users = AdminUser::latest()->get();
        return view('snack-shop-user.create', compact('snackShops', 'users'));
    }
    // End Method

   //User Store Method
   public function store(SnackShopUserStoreRequest $request)
   {
       try {
           $this->snackShopUserRepository->create([
               'user_id' => $request->user_id,
               'snack_shop_id' => $request->snack_shop_id,
           ]);

           return Redirect::route('snack-shop-user.index')->with('success', 'Snack Shop User Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $snackShops = SnackShop::latest()->get();
        $users = AdminUser::latest()->get();
        $snackShopUser = $this->snackShopUserRepository->find($id);
        return view('snack-shop-user.edit', compact('snackShopUser', 'snackShops', 'users'));
    }
    // End Method

   //User Update Method
   public function update(SnackShopUserUpdateRequest $request, $id)
   {
       try {
           $snackShopUser = $this->snackShopUserRepository->find($id);
   
           $this->snackShopUserRepository->update([
               'user_id' => $request->user_id ?? $snackShopUser->user_id,
               'snack_shop_id' => $request->snack_shop_id ?? $snackShopUser->snack_shop_id,
           ], $id);
   
           return Redirect::route('snack-shop-user.index')->with('success', 'Snack Shop User Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->snackShopUserRepository->delete($id);
            return ResponseServices::success([], 'Snack Shop User Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
