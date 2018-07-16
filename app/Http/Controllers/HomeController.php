<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request) {
        // if(session('employeeid')) var_dump(session('employeeid'));
        // else var_dump("walang laman");
        if($request->input('searchField')) $this->search($request->input('searchField'));
        if(session('employeeid')) {
            // session()->forget('employeeid');
            // $accessLevels = DB::select("select menu, submenu1 from accessLevels where accessid in (select accessid from access where employeeid=?)", array(session('employeeid')));
            $accessLevel = DB::select("SELECT al.MENU, a.accessid FROM access a LEFT JOIN accessLevels al ON a.ACCESSID=al.ACCESSID WHERE a.EMPLOYEEID=? ORDER BY al.POSITION", array(session('employeeid')));

            // foreach($accessLevels as $access) {
            //     $accessLevels[$access->MENU] = [];  
            // }
            foreach($accessLevel as $access) {
                $accessLevels[$access->MENU] = 
                    DB::select("SELECT submenu1, submenu2, submenu3 FROM accessLevels WHERE menu=? AND accessid IN (SELECT accessid FROM access WHERE employeeid=?)", array($access->MENU, session('employeeid')));  
            }
            // var_dump($accessLevels);
            // dd($accessLevels);
            if(isset($accessLevels)){
                session()->put('accessLevels', $accessLevels);
                return view('home/veripro');
                // return view('home/veripro')->with('accessLevels', $accessLevels);
            }
            else {
                return view('home/veripro')->with('error', 'You do not have access level');
                // return view('home/veripro')->with('error', 'You do not have access level');
            }
        }
        else return redirect('/')->with('error', 'You must login first!!');
    }

    // public function search($searchText, $fieldToSearch) {
    public function search($searchText, $fieldToSearch) {
        // dd($searchText.': SearchText', $fieldToSearch.": FieldToSearch", 'Home Controller');
        return view('home/search')->with('searchData', [$searchText, $fieldToSearch]);

    }

}
