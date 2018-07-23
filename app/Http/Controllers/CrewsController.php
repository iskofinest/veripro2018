<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CrewsController extends Controller
{
    
    public function show201($applicantNo) {
        if(session('employeeid')) {

            // $crewDetails = DB::selectOne("SELECT * FROM `crew` WHERE APPLICANTNO=?", array($applicantNo));
            $crewDetails = DB::table('crew')
            ->leftJoin('addrtown', function ($join) {
                $join->on('addrtown.TOWNCODE', '=', 'crew.APPLICANTNO')
                    ->where('addrtown.PROVCODE','crew.PROVINCECODE');
            })
            ->leftJoin('addrbarangay', function ($join) {
                $join->on('addrbarangay.TOWNCODE', '=', 'crew.TOWNCODE')
                    ->where('addrbarangay.PROVCODE','crew.PROVINCECODE');
            })
            ->leftJoin('applicant', 'applicant.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('addrprovince', 'addrprovince.PROVCODE', '=', 'crew.PROVINCECODE')
            ->leftJoin('crewchange', function ($join) {
                $join->on('crewchange.APPLICANTNO', '=', 'crew.APPLICANTNO')
                    ->where('crewchange.DATEEMB', DB::raw("(select max(crewchange.DATEEMB) from crewchange where crewchange.APPLICANTNO = crew.APPLICANTNO )"))
                    ->groupby('crewchange.APPLICANTNO');
            })
            ->leftJoin('rank', 'rank.RANKCODE', '=', 'crewchange.RANKCODE')
            ->leftJoin('creweducation', 'creweducation.APPLICANTNO', '=', 'crew.APPLICANTNO')
            ->leftJoin('maritimeschool', 'maritimeschool.SCHOOLID', '=', 'creweducation.SCHOOLID')
            ->leftJoin('maritimecourses', 'maritimecourses.COURSEID', '=', 'creweducation.COURSEID')
            ->leftJoin('crewdocstatus', function ($join) {
                $join->on('crewdocstatus.APPLICANTNO', '=', 'crew.APPLICANTNO')
                    ->whereIn('crewdocstatus.DOCCODE', array('J1', 'J5'));
            })
            ->where('crew.APPLICANTNO', $applicantNo)
            ->select('crew.APPLICANTNO', 'crew.CREWCODE', 'crew.FNAME', 'crew.GNAME', 'crew.MNAME', 'rank.RANK', 'crew.ADDRESS', 
                'crew.MUNICIPALITY', 'crew.CITY', 'crew.ZIPCODE', 'crew.TELNO', 'crew.CEL4', 'crew.EMAIL', 'creweducation.SCHOOLOTHERS',
                'maritimeschool.SCHOOL', 'creweducation.COURSEOTHERS', 'maritimecourses.ALIAS', 'crew.RECOMMENDEDBY AS crewRecomended', 
                'applicant.RECOMMENDEDBY AS applicantRecomended', 'crewdocstatus.DOCCODE', 'crew.BIRTHDATE', 'crew.BIRTHPLACE', 
                'crew.GENDER',
                'crew.CIVILSTATUS', 'crew.RELIGION', 'crew.SSS', 'crew.TIN', 'crew.PHILHEALTH', 'crew.PAGIBIG',
                'crew.DMBWEIGHT', 'crew.WEIGHT', 'crew.NEXTOFKIN', 'addrtown.TOWN', 'addrprovince.PROVINCE', 
                'addrprovince.PROVCODE', 'addrtown.TOWNCODE', 'addrbarangay.BRGYCODE', 'creweducation.SCHOOLID',
                'crew.NEXTOFKIN'
            ) ->first();

            if (empty($crewDetails->PROVCODE) && empty($crewDetails->TOWNCODE)) 
                $address = $crewDetails->ADDRESS.' '.$crewDetails->MUNICIPALITY.', '.$crewDetails->CITY.' '.$crewDetails->ZIPCODE;
             else 
                $address = $crewDetails->ADDRESS.' '.$crewDetails->TOWN.' '.$crewDetails->PROVINCE.' '.$crewDetails->ZIPCODE;
            

            if(empty($crewDetails->SCHOOLID)) $school = $crewDetails->SCHOOLOTHERS;
             else $school = $crewDetails->SCHOOL;
            
            if(empty($crewDetails->crewRecomended)) $recomendedBy = $crewDetails->applicantRecomended;
            else $recomendedBy = $crewDetails->crewRecomended;

            $data = [
                'crewDetails'  => $crewDetails,
                'crewName' => $crewDetails->FNAME.', '.$crewDetails->GNAME.' '.$crewDetails->MNAME,
                'address' => $address,
                'school' => $school,
                'recomendedBy' => $recomendedBy
            ];
            

            // var_dump($crewDetails);
            return view('crews/crew')->with($data);

            
        } else return redirect('/')->with('error', 'You must login first!!');
    }
    
    

}
