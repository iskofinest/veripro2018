<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request) {
    
        // if($request->input('searchField')) $this->search($request->input('searchField'));
        if(session('employeeid')) {
            $accessLevel = DB::select("SELECT al.MENU, a.accessid FROM access a LEFT JOIN accessLevels al ON a.ACCESSID=al.ACCESSID WHERE a.EMPLOYEEID=? ORDER BY al.POSITION", array(session('employeeid')));
            foreach($accessLevel as $access) {
                $accessLevels[$access->MENU] = 
                    DB::select("SELECT submenu1, submenu2, submenu3 FROM accessLevels WHERE menu=? AND accessid IN (SELECT accessid FROM access WHERE employeeid=?)", array($access->MENU, session('employeeid')));  
            }
            if(isset($accessLevels)){
                session()->put('accessLevels', $accessLevels);
                $applicants = $this->getAllApplicants();
                foreach($applicants as $applicant) {
                    $applicant->RANK = $this->getRank($applicant->APPLICANTNO);
                    // var_dump($applicant);
                }
                $data = [
                    'applicants'  => $applicants,
                    // 'list1' => $this->getApplicantDetails()
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
        // $applicants = DB::select('SELECT c.APPLICANTNO,c.CREWCODE,FNAME,GNAME,MNAME,c.STATUS,c.UTILITY,
        // s.DESCRIPTION AS SCHOLARTYPE,f.FASTTRACK AS FASTTRACKTYPE
        // FROM crew c
        // LEFT JOIN crewfasttrack cf ON cf.APPLICANTNO=c.APPLICANTNO
        // LEFT JOIN fasttrack f ON f.fasttrack=cf.FASTTRACKCODE
        // LEFT JOIN crewscholar cs ON cs.APPLICANTNO=c.APPLICANTNO
        // LEFT JOIN scholar s ON s.SCHOLASTICCODE=cs.SCHOLASTICCODE');
        $applicants = DB::table('crew')
            ->leftJoin('crewfasttrack', 'crewfasttrack.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('fasttrack', 'fasttrack.fasttrack', '=', 'crewfasttrack.FASTTRACKCODE')
            ->leftJoin('crewscholar', 'crewscholar.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('scholar', 'scholar.SCHOLASTICCODE', '=', 'crewscholar.SCHOLASTICCODE')
            ->select('crew.APPLICANTNO', 'crew.CREWCODE', 'crew.FNAME', 'crew.GNAME', 'crew.MNAME', 'crew.STATUS', 
            'crew.UTILITY', 'scholar.DESCRIPTION', 'fasttrack.FASTTRACK')->paginate(15);
        return $applicants;
    }

    private function getRank($applicantNo) {
        $sql = "SELECT z.DATEDISEMB,v.MANAGEMENTCODE,v.VESSEL,z.RANKCODE,r.RANK ,r.ALIAS1 FROM 
                    (
                        SELECT '1' AS VMC,RANKCODE,DATEDISEMB,VESSELCODE
                        FROM
                            (
                            SELECT RANKCODE,VESSELCODE,
                            IF(IF(DATECHANGEDISEMB IS NULL,DATEDISEMB,DATECHANGEDISEMB) > CURRENT_DATE,
                                CURRENT_DATE,IF(DATECHANGEDISEMB IS NULL,DATEDISEMB,DATECHANGEDISEMB)) AS DATEDISEMB
                            FROM crewchange where APPLICANTNO=$applicantNo AND DATEEMB < CURRENT_DATE
                            ORDER BY DATEDISEMB DESC
                            ) x
                        
                        UNION					
                                            
                        SELECT '2' AS VMC,RANKCODE,DATEDISEMB,NULL
                        FROM
                            (
                            SELECT RANKCODE,DATEDISEMB
                            FROM crewexperience where APPLICANTNO=$applicantNo
                            ORDER BY DATEDISEMB DESC
                            ) y
                    ) z
                    LEFT JOIN rank r ON r.RANKCODE=z.RANKCODE
                    LEFT JOIN vessel v ON v.VESSELCODE=z.VESSELCODE
                    ORDER BY DATEDISEMB DESC limit 1";
        $rank = DB::selectOne($sql);
        if(empty($rank->RANK)) return "";
        else return $rank->RANK;
    }

    // public function search($searchText, $fieldToSearch) {
    public function search($searchText, $fieldToSearch) {
        if(session('employeeid')) {
            $applicants = $this->searchApplicantsBy($searchText, $fieldToSearch);
            foreach($applicants as $applicant) {
                $applicant->RANK = $this->getRank($applicant->APPLICANTNO);
            }
            $data = [
                'applicants'  => $applicants,
                'searchText' => $searchText,
                'fieldToSearch' => $fieldToSearch
            ];
            return view('home/veripro')->with($data);
        } else {
            return redirect('/')->with('error', 'You must login first!!');
        }
    }

    private function searchApplicantsBy($searchText, $fieldToSearch) {
        $applicants = DB::table('crew')
            ->leftJoin('crewfasttrack', 'crewfasttrack.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('fasttrack', 'fasttrack.fasttrack', '=', 'crewfasttrack.FASTTRACKCODE')
            ->leftJoin('crewscholar', 'crewscholar.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('scholar', 'scholar.SCHOLASTICCODE', '=', 'crewscholar.SCHOLASTICCODE')
            ->where('crew.'.$fieldToSearch, 'like', '%'.$searchText.'%')
            ->select('crew.APPLICANTNO', 'crew.CREWCODE', 'crew.FNAME', 'crew.GNAME', 'crew.MNAME', 'crew.STATUS', 
            'crew.UTILITY', 'scholar.DESCRIPTION', 'fasttrack.FASTTRACK')->paginate(15);
        return $applicants;
    }

    private function getApplicantDetails($employeeNo) {

    }

}
