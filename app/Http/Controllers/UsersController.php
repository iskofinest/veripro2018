<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as IP;
use Illuminate\Support\Facades\Hash;
use Browser;
use Carbon\Carbon;
use DB;

class UsersController extends Controller
{
    public function login() {
        // session()->flush();
        if(session('employeeid')) return redirect('/home');
        return view('users/login');
    }

    public function index() {
        if(session('employeeid')) return redirect('/home');
        return view('users/login');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->input('username');
        $password = Hash::make( $request->input('password'));
        $employeeLoggedIn = DB::selectOne("SELECT * FROM `employee` WHERE EMPLOYEEID=? AND PASSWORD=?", array($username, $password));
        if($employeeLoggedIn) {
           
            $currentIp = IP::ip();
            $logDate = Carbon::now();
            $browser = Browser::browserFamily();
            // $browser = $request->header('User-agent');
            $request->session()->put('employeeid', $employeeLoggedIn->EMPLOYEEID);
            $request->session()->put('departmentid', $employeeLoggedIn->DEPARTMENTID);
            $request->session()->put('divcode', $employeeLoggedIn->DIVCODE);
            (DB::table('verlogs')->insertGetId([
                'log_id' => $employeeLoggedIn->EMPLOYEEID, 
                'ip' => $currentIp,
                'date' => $logDate,
                'browser' =>  $browser
            ]));
            return redirect('/home');
        } else {
            // $request->session()->put('error', 'INVALID ID OR PASSWORD');
            $error = 'INVALID ID OR PASSWORD';
            // var_dump($error);
            // $request->session()->forget('error');
            return redirect('/')->with('error', $error);
        }
    }

    public function logout() {
        session()->flush();
        // dd($a, $b);
        return redirect('/');
    }
    public function logouts($a, $b) {
        session()->flush();
        dd($a, $b);
        return redirect('/');
    }
}
