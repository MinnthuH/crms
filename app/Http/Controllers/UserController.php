<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Services\ResponseServices;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('user.index');
    }

    // User Datable Method
    public function databale(Request $request)
    {
        if ($request->ajax()) {
           return $this->userRepository->datatable($request);
        }
    }
    // End Method

    // Create Method
    public function create()
    {
        $cinemas = Cinema::latest()->get();
        return view('user.create', compact('cinemas'));
    }
    // End Method

   //User Store Method
   public function store(UserStoreRequest $request)
   {
       try {
           $this->userRepository->create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'cinema_id' => $request->cinema_id,
           ]);

           return Redirect::route('user.index')->with('success', 'User Create Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } // End Method

    // Edit Method
    public function edit($id)
    {
        $cinemas = Cinema::latest()->get();
        $user = $this->userRepository->find($id);
        return view('user.edit', compact('user', 'cinemas'));
    }
    // End Method

   //User Update Method
   public function update(UserUpdateRequest $request, $id)
   {
       try {
           $user = $this->userRepository->find($id);
   
           $this->userRepository->update([
               'name' => $request->name ?? $user->name,
               'email' => $request->email ?? $user->email,
               'password' => $request->password ? Hash::make($request->password) : $user->password,
               'cinema_id' => $request->cinema_id ?? $user->cinema_id,
               'status' => $request->status ?? $user->status,
           ], $id);
   
           return Redirect::route('user.index')->with('success', 'User Updated Successfully');
       } catch (Exception $e) {
           return back()->with('error', $e->getMessage());
       }
   } 
   

    // Delete Method
    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return ResponseServices::success([], 'User Deleted Successfully');
        } catch (Exception $e) {
            return ResponseServices::fail($e->getMessage());
        }
    }
    // End Method
}
