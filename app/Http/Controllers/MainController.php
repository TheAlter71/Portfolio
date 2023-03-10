<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\SendMailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function mail(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $my_mail = 'hello.mehedi@outlook.com';
        $user_mail = $request->email;

        Mail::to($my_mail)->send(new SendMail($request->name, $request->email, $request->subject, $request->message));
        Mail::to($user_mail)->send(new SendMailUser($request->name, $request->email, $request->subject, $request->message));

        // redirect home
        return redirect()->route('home')->with('success', 'Your message was sent successfully!');
    }
}
