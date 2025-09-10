<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $logins = Login::paginate(15);
        $loginsEqipment = Login::with('equipment')->get();
        return view('login.index',[
            'logins' => $logins,
        ]);
    }
}
