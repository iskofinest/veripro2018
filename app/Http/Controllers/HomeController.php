<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request) {
    
        if(session('employeeid')) {
            // $accessLevel = DB::select("SELECT al.MENU, a.accessid FROM access a LEFT JOIN accessLevels al ON a.ACCESSID=al.ACCESSID WHERE a.EMPLOYEEID=? ORDER BY al.POSITION", array(session('employeeid')));
            $accessLevel = DB::table('access')
                    ->leftJoin('accessLevels', 'access.ACCESSID', '=', 'accessLevels.ACCESSID')
                    ->where('access.EMPLOYEEID', session('employeeid'))
                    ->orderby('accessLevels.POSITION')->get();
            foreach($accessLevel as $access) {
                $accessLevels[$access->MENU] = 
                    DB::select("SELECT submenu1, submenu2, submenu3 FROM accessLevels WHERE menu=? AND accessid IN (SELECT accessid FROM access WHERE employeeid=?)", array($access->MENU, session('employeeid')));  
                // $accessLevels[$access->MENU] = DB::table('accessLevels')
                //     ->where('accessLevels.menu', $access->MENU)
                //     ->wherein(DB::select("SELECT accessid FROM access WHERE employeeid=?", array(session('employeeid'))))
                //     ->get();
            }
            if(isset($accessLevels)){
                session()->put('accessLevels', $accessLevels);
                $applicants = $this->getAllApplicants();
                $data = [
                    'applicants'  => $applicants,
                ];
                return view('home/veripro')->with('applicants', $applicants);
            }
            else {
                session()->flush();
                return redirect('/')->with('error', 'You do not have access level');
            }
        }
        else return redirect('/')->with('error', 'You must login first!!');
    }

    // home function for retrieving all applicants
    private function getAllApplicants() {
        $applicants = DB::table('crew')
            ->leftJoin('crewfasttrack', 'crewfasttrack.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('fasttrack', 'fasttrack.fasttrack', '=', 'crewfasttrack.FASTTRACKCODE')
            ->leftJoin('crewscholar', 'crewscholar.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('scholar', 'scholar.SCHOLASTICCODE', '=', 'crewscholar.SCHOLASTICCODE')
            ->leftJoin('crewchange', function ($join) {
                $join->on('crewchange.APPLICANTNO', '=', 'crew.APPLICANTNO')
                    ->where('crewchange.DATEEMB', DB::raw("(select max(crewchange.DATEEMB) from crewchange where crewchange.APPLICANTNO = crew.APPLICANTNO )"))
                    ->groupby('crewchange.APPLICANTNO');
            })
            ->leftJoin('rank', 'rank.RANKCODE', '=', 'crewchange.RANKCODE')
            ->leftJoin('vessel', function ($join) {
                $join->on('vessel.VESSELCODE', '=', 'crewchange.VESSELCODE')
                    ->whereNull('crewchange.ARRMNLDATE')
                    ->whereNull('crewchange.DATEDISEMB')
                    ->whereNull('crewchange.DEPMNLDATE');
            })
            ->select('crew.APPLICANTNO', 'crew.CREWCODE', 'crew.FNAME', 'crew.GNAME', 'crew.MNAME', 'crew.STATUS', 
            'crew.UTILITY', 'scholar.DESCRIPTION', 'fasttrack.FASTTRACK', 'rank.RANK', 'vessel.VESSEL')->paginate(15);
        return $applicants;
    }

    public function search(Request $request) {
        if(session('employeeid')) {
            $searchText1 = $request->searchText1;
            $fieldToSearch1 = $request->fieldToSearch1;
            $searchText2 = $request->searchText2;
            $fieldToSearch2 = $request->fieldToSearch2;
            if($searchText1 == "null") $searchText1 = "";
            if($searchText2 == "null") $searchText2 = "";
            $applicants = $this->searchApplicantsBy($searchText1, $fieldToSearch1, $searchText2, $fieldToSearch2);
            $data = [
                'applicants'  => $applicants,
                'searchText1' => $searchText1,
                'fieldToSearch1' => $fieldToSearch1,
                'searchText2' => $searchText2,
                'fieldToSearch2' => $fieldToSearch2,
            ];
            return view('home/veripro')->with($data);
        } else {
            return redirect('/')->with('error', 'You must login first!!');
        }
    }

    private function searchApplicantsBy($searchText1, $fieldToSearch1, $searchText2, $fieldToSearch2) {

        $applicants = DB::table('crew')
            ->leftJoin('crewfasttrack', 'crewfasttrack.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('fasttrack', 'fasttrack.fasttrack', '=', 'crewfasttrack.FASTTRACKCODE')
            ->leftJoin('crewscholar', 'crewscholar.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('scholar', 'scholar.SCHOLASTICCODE', '=', 'crewscholar.SCHOLASTICCODE')
            ->leftJoin('crewchange', function ($join) {
                $join->on('crewchange.APPLICANTNO', '=', 'crew.APPLICANTNO')
                    ->where('crewchange.DATEEMB', DB::raw("(select max(crewchange.DATEEMB) from crewchange where crewchange.APPLICANTNO = crew.APPLICANTNO )"))
                    ->groupby('crewchange.APPLICANTNO');
            })
            ->leftJoin('rank', 'rank.RANKCODE', '=', 'crewchange.RANKCODE')
            ->leftJoin('vessel', function ($join) {
                $join->on('vessel.VESSELCODE', '=', 'crewchange.VESSELCODE')
                    ->whereNull('crewchange.ARRMNLDATE')
                    ->whereNull('crewchange.DISEMBREASONCODE')
                    ->whereNull('crewchange.DEPMNLDATE');
            })
            ->where([
                    [$fieldToSearch1, 'like', '%'.$searchText1.'%'],
                    [$fieldToSearch2, 'like', '%'.$searchText2.'%'],
                ])
            ->select('crew.APPLICANTNO', 'crew.CREWCODE', 'crew.FNAME', 'crew.GNAME', 'crew.MNAME', 'crew.STATUS', 
            'crew.UTILITY', 'scholar.DESCRIPTION', 'fasttrack.FASTTRACK', 'rank.RANK', 'vessel.VESSEL')->paginate(15);
        return $applicants;
    }

    private function getApplicantDetails($employeeNo) {

    }

}
