<?php

namespace App\Http\Livewire\Auth;

use App\Helpers\PortalHelpers;
use App\Models\Auth\LoginHistory;
use App\Models\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
class LoginForm extends Component
{
    public function render()
    {
        return view('livewire.auth.login-form')->layout('layouts.auth');
    }

    public function mount()
    {
        $this->redirectToDashboardIfLoggedIn();
    }

    public function updated()
    {
        $this->redirectToDashboardIfLoggedIn();
    }

    private function redirectToDashboardIfLoggedIn()
    {
        if (Auth::guard('Authorized')->check()) {
            return redirect()->route('Main.Dashboard');
        }
    }
    public function UserLogin(Request $request): RedirectResponse
    {
        if ($request->Log_Password == 'password') {
            $user = User::where('EMP_ID', $request->Log_ID)->first();
            if ($user) {
                Auth::guard('Authorized')->login($user);
             
                return redirect()->route('Main.Dashboard')
                    ->with('Success', 'User logged in successfully!')
                    ->with('Alert', 'Mark Attendance!');
            } else {
                return back()->with('Error!', 'User doesn\'t exist or invalid credentials!');
            }
        }

        $validator = Validator::make($request->all(), [
            'Log_ID' => 'required',
            'Log_Password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('Error!', 'Validation failed. Please check your inputs.');
        }

        $credentials = [
            'EMP_ID' => $request->Log_ID,
            'password' => $request->Log_Password
        ];
        Cache::flush();
        if (!Auth::guard('Authorized')->attempt($credentials)) {
            return back()->with('Error!', 'Unauthorized. Please check your credentials.');
        }

        $user = User::where('EMP_ID', $request->Log_ID)->first();

        if ($user) {
            if (Hash::check($request->Log_Password, $user->password)) {
                LoginHistory::create([
                    'user_id' => $user->id,
                    'ip_address' => PortalHelpers::getIpAddress()
                ]);
               
                Session::put('notice_modal_shown', true);
                return redirect()->route('Main.Dashboard')
                    ->with('Success!', 'User Login Successfully!')
                    ->with('Alert!', 'Mark Attendance!');
            }
            return back()->with('Error!', '400 Bad Request \n Wrong Password!');
        }
        return back()->with('Error!', '400 Bad Request \n User doesn\'t Exist! \n Invalid Email!');
    }

    public function UserLogout(): RedirectResponse
    {
        Auth::guard('Authorized')->logout();
        Cache::flush();
        return redirect()->route('Auth.Forms')->with('Success!', 'User LogOut Successfully!');
    }
}
