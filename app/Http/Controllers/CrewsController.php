<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CrewsController extends Controller
{
    
    public function show201($applicantNo) {
        if(session('employeeid')) {
            $crewDetails = $this->findCrewByApplicantNo($applicantNo);
            $personalweight = $crewDetails->WEIGHT;
            $personalheight = $crewDetails->HEIGHT;
            $personaldmbweight = $crewDetails->DMBWEIGHT;
            $datetimenow=date("Y-m-d H:i:s");
            $data = [
                'crewDetails'  => $crewDetails,
                'crewName' => $crewDetails->FNAME.', '.$crewDetails->GNAME.' '.$crewDetails->MNAME,
                'address' => $this->getAddress($crewDetails),
                'school' => $this->getSchool($crewDetails),
                'recomendedBy' => $this->getRecomendedBy($crewDetails),
                'course' =>  $this->getCourse($crewDetails),
                'embBmi' => $this->getBmi($personalweight, $personalheight),
                'dmbBmi' => $this->getBmi($personaldmbweight, $personalheight),
                'age' => floor((strtotime($datetimenow) - strtotime($crewDetails->BIRTHDATE)) / (86400*365.25)),
                'gender' => ($crewDetails->GENDER == 'M') ?'MALE' : 'FEMALE',
                'civilStatus' => $this->getCivilStatus($crewDetails->CIVILSTATUS),
                'crewstatus' =>  $this->getCrewStatus($crewDetails)
            ];
            return view('crews/crew')->with($data);
        } else return redirect('/')->with('error', 'You must login first!!');
    }

    public function findCrewByApplicantNo($applicantNo) {
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
            ->leftJoin('vessel', function ($join) {
                $join->on('vessel.VESSELCODE', '=', 'crewchange.VESSELCODE');
            })
            ->where('crew.APPLICANTNO', $applicantNo)
            ->select('crew.APPLICANTNO', 'crew.CREWCODE', 'crew.FNAME', 'crew.GNAME', 'crew.MNAME', 'rank.RANK', 'crew.ADDRESS', 
                'crew.MUNICIPALITY', 'crew.CITY', 'crew.ZIPCODE', 'crew.TELNO', 'crew.CEL4', 'crew.EMAIL', 'crew.BIRTHDATE', 
                'crew.BIRTHPLACE', 'crew.GENDER', 'crew.CIVILSTATUS', 'crew.RELIGION', 'crew.SSS', 'crew.TIN', 'crew.PHILHEALTH', 
                'crew.PAGIBIG', 'crew.DMBWEIGHT', 'crew.WEIGHT', 'crew.HEIGHT', 'crew.NEXTOFKIN', 'crew.STATUS', 'crew.CIVILSTATUS', 
                'crew.RECOMMENDEDBY AS crewRecomended', 
                'crewchange.DATEEMB', 'crewchange.ARRMNLDATE', 'crewchange.CONFIRMDEPDATE',
                'crewdocstatus.DOCCODE', 
                'creweducation.SCHOOLOTHERS', 'creweducation.COURSEID', 'creweducation.COURSEOTHERS', 'creweducation.SCHOOLID',
                'applicant.RECOMMENDEDBY AS applicantRecomended',
                'addrtown.TOWN', 
                'addrprovince.PROVINCE', 'addrprovince.PROVCODE', 
                'addrtown.TOWNCODE', 
                'addrbarangay.BRGYCODE', 
                'maritimecourses.ALIAS', 'maritimeschool.SCHOOL',
                'vessel.VESSEL'
            ) ->first();
            return $crewDetails;
    }
    
    private function getAddress($crewDetails) {
        if (empty($crewDetails->PROVCODE) && empty($crewDetails->TOWNCODE)) 
            $address = $crewDetails->ADDRESS.' '.$crewDetails->MUNICIPALITY.', '.$crewDetails->CITY.' '.$crewDetails->ZIPCODE;
        else 
            $address = $crewDetails->ADDRESS.' '.$crewDetails->TOWN.' '.$crewDetails->PROVINCE.' '.$crewDetails->ZIPCODE;
        return $address;
    }

    private function getSchool($crewDetails) {
        if(empty($crewDetails->SCHOOLID)) $school = $crewDetails->SCHOOLOTHERS;
        else $school = $crewDetails->SCHOOL;
        return $school;
    }

    private function getRecomendedBy($crewDetails) {
        if(empty($crewDetails->crewRecomended)) $recomendedBy = $crewDetails->applicantRecomended;
        else $recomendedBy = $crewDetails->crewRecomended;
        return $recomendedBy;
    }

    private function getCourse($crewDetails) {
        if(empty($crewDetails->COURSEID)) $course = $crewDetails->COURSEOTHERS;
        else $course = $crewDetails->ALIAS;
        return $course;
    }

    private function getCivilStatus($status) {
        switch ($status) {
			case "S":
					$civilStatus = "SINGLE";
				break;
			case "M":
					$civilStatus = "MARRIED";
				break;
			case "W":
					$civilStatus = "WIDOW";
				break;
			case "P":
					$civilStatus = "SEPARATED";
				break;
        }
        return $civilStatus;
    }

    private function getBmi($weight, $height) {
        if($weight != ''){
            $bmi123 = $weight / (($height/100) * ($height/100));
            $bmi1 = round($bmi123, 0);
          if($bmi1 == '' || $weight == '') $bmi = '';
          else if($bmi1 >= '0' && $bmi1 <= '18'){ 
                 $bmi = 'Underweight '.'('.$bmi1.')';
          } else if ($bmi1 >= '19' && $bmi1 <= '24'){
                 $bmi = 'Normal '.'('.$bmi1.')'; 
          } else if ($bmi1 >= '25' && $bmi1 <= '29'){
                 $bmi = 'Overweight '.'('.$bmi1.')';   
          } else if ($bmi1 >= '30' && $bmi1 <= '34'){
                 $bmi = 'Obesity I '.'('.$bmi1.')';   
          } else if ($bmi1 >= '35' && $bmi1 <= '39'){
                 $bmi = 'Obesity II '.'('.$bmi1.')';
          } else if ($bmi1 >= '40'){
                 $bmi = 'Obesity III '.'('.$bmi1.')';  
        }} else $bmi = '';
        return $bmi;
    }

    private function getCrewStatus($crewDetails) {

        if(empty($crewDetails->ARRMNLDATE)) {
            $crewStatus = "ON BOARD";
        } else {
            $crewStatus = "STAND BY";
        }

        return $crewStatus;
    }

}
