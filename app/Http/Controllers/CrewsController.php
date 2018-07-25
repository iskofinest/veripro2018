<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CrewsController extends Controller
{
    private $crewDetails;
    public function show201($applicantNo) {
        if(session('employeeid')) {
            $crewDetails = $this->findCrewByApplicantNo($applicantNo);
            $personalweight = (empty($crewDetails->WEIGHT) ) ? 0 : $crewDetails->WEIGHT;
            $personalheight = $crewDetails->HEIGHT;
            $personaldmbweight = (empty($crewDetails->DMBWEIGHT) ) ? 0 : $crewDetails->DMBWEIGHT;
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
                'crewstatus' =>  $this->getCrewStatus($crewDetails),
                'datedisemb' => ($crewDetails->DATECHANGEDISEMB == '') ? $crewDetails->DATEDISEMB:$crewDetails->DATECHANGEDISEMB
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
                'crewchange.DATEEMB', 'crewchange.DATECHANGEDISEMB', 'crewchange.DATEDISEMB', 'crewchange.CONFIRMDEPDATE', 
                'crewchange.ARRMNLDATE',
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
        try {
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
          }
          catch (Exception $e) {
              return 'NA';
              return $e->getMessage();
          }
        return $bmi;
    }

    private function getCrewStatus($crewDetails) {

        $datetimenow=date("Y-m-d H:i:s");
        
        $dateDisembarked = ($crewDetails->DATECHANGEDISEMB == '') ? $crewDetails->DATEDISEMB:$crewDetails->DATECHANGEDISEMB;
        if($crewDetails->DATEEMB == '' && $dateDisembarked == '') {
            $crewStatus = 'STANDBY';    // IF NEWLY HIRED AND NOT SCHEDULED AT ALL
        } else {
            if(strtotime($crewDetails->DATEEMB) > strtotime($datetimenow)) {    // IF HAS SCHEDLUED EMBARKMENT
                // COUNT HOW MANY DAYS DIFFER
                $dateEmbarkmentDifference = dateDifference($crewDetails->DATEEMB);
                if($dateEmbarkmentDifference <= 90 && $dateEmbarkmentDifference > 0) { // IF EMBARKMENT HAS LESS THAN 3 MONTHS
                    $crewStatus = 'EMBARKING';
                } else if($dateEmbarkmentDifference > 90) {   // IF EMBARKMENT IS BEYOND 3 MONTHS BUT LESS THAN 1 YEAR
                    $crewStatus = 'STANDBY (LINE UP)';
                }
            } else { // IF EMBARKMENT IS ALREADY EXECUTED
                if(strtotime($dateDisembarked) > strtotime($datetimenow)) {     // IF ON BOARD AND NOT ALREADY DISEMBARKED
                    $crewStatus = 'ONBOARD';
                } else {                                                        // IF ALREADY DISEMBARKED
                    $dateDisembarkmentDifference = $this->dateDifference($dateDisembarked); 
                    if($dateDisembarkmentDifference > 365) {    // IF MORE THAN 1 YEAR DISEMBARKED AND NO SCHEDULED EMBARKMENT
                        $crewStatus = 'INACTIVE';
                    } else {                                    // IF LESS THAN 1 YEAR DISEMBARKED AND NO SCHEDULED EMBARKMENT
                        $crewStatus = 'STANDBY';
                    }
                }
            }
        }

        return $crewStatus;
    }

    function dateDifference($date_2) {
        $datetimenow=date("Y-m-d H:i:s");
        $current_date = date_create($datetimenow);
        $embark_date = date_create($date_2);
        $interval = date_diff($embark_date, $current_date);
        return $interval->format('%a');
    }

}
