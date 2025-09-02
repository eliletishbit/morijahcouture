<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPaymentMethodController extends Controller
{
    //
    public function index(){
        return view('pages.backend.paymentmethods.index');
    }

    public function store(){

    }

    public function destroy($id){

    }
}
