<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\AdminUserRepository;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;

class AdminUserController extends Controller
{
    protected $adminUserRepository;

    public function __construct(AdminUserRepository $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }

    public function index()
    {
        return view('admin-user.index');
    }

    // Admin User Datable Method
    public function databale(Request $request)
    {
        if ($request->ajax()) {
           return $this->adminUserRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        return view('admin-user.create');
    }
    // End Method

   //Admin Store Method
   public function store(AdminUserStoreRequest $request)
   {
       try {
           $this->adminUserRepository->create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
           ]);

           return Redirect::route('admin-user.index')->with('success', 'Admin Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $admin_user = $this->adminUserRepository->find($id);
        return view('admin-user.edit', compact('admin_user'));
    }
    // End Method

   //Admin Update Method
   public function update(AdminUserUpdateRequest $request, $id)
   {
       try {
           $admin_user = $this->adminUserRepository->find($id);
           $this->adminUserRepository->update([
               'name' => $request->name,
               'email' => $request->email,
               'password' => $request->password ? Hash::make($request->password) : $admin_user->password,
           ], $id);

           return Redirect::route('admin-user.index')->with('success', 'Admin Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->adminUserRepository->delete($id);
            return ResponseServices::success([], 'Admin User Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
