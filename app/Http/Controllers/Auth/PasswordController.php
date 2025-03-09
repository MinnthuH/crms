<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use PhpParser\Node\Stmt\TryCatch;

class PasswordController extends Controller
{
   
    public function edit(Request $request): View
    {
        return view('profile.change-password', [
            'user' => $request->user(),
        ]);
    }


    public function update(ChangePasswordRequest $request)
    {

        try {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);
    
            return back()->with('success', 'Password Changed Successfully');
        } catch (Exception $e) {
           return back()->with('error',$e->getMessage());
        }
       
    }
}
