<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
    return view('user.index');
   }

   public function contactAdd(ContactUsRequest $request){
    Contact::create($request->validated());
    return redirect()->back()->with('status','your message has been sent successfully!');

   }
}
