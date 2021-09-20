<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends OsnovniController
{
    public function index(){
        return view('pages.main.loginRegister', $this->data);
    }

    public function login(LoginRequest $request){
        $email = $request->input('email');
        $password = md5($request->input('password'));

        try {
            $user = \DB::table('users')
                ->select('id as user_id', 'name as user_name', 'role_id')
                ->where('email', $email)
                ->where('password', $password)
                ->first();

            if($user) {
                $request->session()->put('user', $user);
                \DB::table('admin')->insert([
                    'user_id' => session('user')->user_id,
                    'name' => session('user')->user_name,
                    'action' => 'Login',
                    'date' => Carbon::now()->toDate()
                 ]);
                return 'Successfully logged in!';

            }
            else {
                return response(['error'=>true,'errorMsg'=>"Please check your data and try again."],400);
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function logout(Request $request){
        \DB::table('admin')->insert([
            'user_id' => session('user')->user_id,
            'name' => session('user')->user_name,
            'action' => 'Logout',
            'date' => Carbon::now()->toDate()
        ]);
        $request->session()->pull("user");
        return redirect()->route("home");
    }
}
