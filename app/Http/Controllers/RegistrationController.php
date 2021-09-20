<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{

    public function register(UserRequest $request){

        try
        {
            $name = $request->get('name');
            $last_name = $request->get('last_name');
            $address = $request->get('address');
            $email = $request->get('email');
            $password = md5($request->get('password'));
            $active = $request->get('active');
            $role_id = $request->get('role_id');

            $selectEmail = \DB::table('users')
                ->where('email', $email)
                ->first();

            if($selectEmail){
                return response(['error'=>true,'errorMsg'=>"Email already exists!"],400);
            }

            $insert = \DB::table('users')->insertGetId([
                'name' => $name,
                'last_name' => $last_name,
                'address' => $address,
                'email' => $email,
                'password' => $password,
                'active' => $active,
                'role_id' => $role_id
            ]);

            if($insert){
                $user = \DB::table('users')->select('id as user_id', 'name as user_name')
                    ->where('id', $insert)
                    ->first();

                \DB::table('admin')->insert([
                    'user_id' => $user->user_id,
                    'name' => $user->user_name,
                    'action' => 'Registration',
                    'date' => Carbon::now()->toDate()
                ]);
                return "Successfully registered! You can login now :)";
            }
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
        }

    }
}
