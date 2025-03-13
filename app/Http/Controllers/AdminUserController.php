<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cinema;
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
        $cinemas = Cinema::latest()->get();
        return view('admin-user.create', compact('cinemas'));
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
               'cinema_id' => $request->cinema_id,
           ]);

           return Redirect::route('admin-user.index')->with('success', 'User Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $cinemas = Cinema::latest()->get();
        $admin_user = $this->adminUserRepository->find($id);
        return view('admin-user.edit', compact('admin_user', 'cinemas'));
    }
    // End Method

   //Admin Update Method
   public function update(AdminUserUpdateRequest $request, $id)
   {
       try {
           $admin_user = $this->adminUserRepository->find($id);
           $this->adminUserRepository->update([
            'name' => $request->name ?? $admin_user->name,
            'email' => $request->email ?? $admin_user->email,
            'password' => $request->password ? Hash::make($request->password) : $admin_user->password,
            'cinema_id' => $request->cinema_id ?? $admin_user->cinema_id,
            'role' => $request->role ?? $admin_user->role,
            'status' => $request->status ?? $admin_user->status,
           ], $id);

           return Redirect::route('admin-user.index')->with('success', 'User Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->adminUserRepository->delete($id);
            return ResponseServices::success([], ' User Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
