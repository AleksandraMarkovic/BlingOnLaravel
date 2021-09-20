<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends OsnovniController
{
    public function index(){
        return view('pages.main.contact', $this->data);
    }

    public function sendEmail(Request $request){
        $this -> validate($request, [
           'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        );

        Mail::to('markovic749@gmail.com')->send(new SendEmail($data));
        return "Thank you for contacting us.";
    }
}
