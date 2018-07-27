@extends('layouts.application')

@section('content')

<div class="row mb-3">
    <div class="col-sm-12 col-md-12">
        <div class="card bg-primary">
                {{-- <div class="card-body"> --}}
                    <h2 class="card-title text-center">
                        {{$crewDetails->GNAME.' '.$crewDetails->MNAME.' '.$crewDetails->FNAME}}
                    </h2>
                {{-- </div> <!-- div title card-body --> --}}
        </div> <!-- div title card -->
    </div> <!-- div title col -->
</div> <!-- div title row -->

<section >
    <div class="row">
        <div class="col-sm-6 col-md-6 pr-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title lead">
                        <p class="h3">Personal Details</p>
                    </h3>
                    <div class="row">
                        <div class="col-sm-9 col-md-9"> <!-- START DIV WITH 9 COLUMN CLASS -->
                            <ul class="list-group" > <!-- START LIST WITH 9 COLUMN CLASS -->
                        
                                <li class="list-group-item custom-list-partial pr-0"> <!-- START APPLICANT IDENTIFICATION LIST ITEM -->
                                    <div class="row"> <!-- APPLICANT ID ROW -->
                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right">
                                            <strong>APPLICANT NO:</strong>
                                        </div>
                                        <div class="col-sm-2 col-md-2 text-left pr-0">
                                            {{$crewDetails->APPLICANTNO}} 
                                        </div>
                                        <div class="col-sm-3 col-md-3 text-right">
                                            <strong>CREW CODE: </strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->CREWCODE}} 
                                        </div> 
                                    </div> <!-- APPLICANT ID ROW -->
                                </li> <!-- END APPLICANT IDENTIFICATION LIST ITEM -->

                                <li class="list-group-item custom-list-partial"> <!-- START NAME LIST ITEM -->
                                    <div class="row"> <!-- APPLICANT NAME ROW -->
                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right">
                                            <strong>NAME:</strong>
                                        </div>
                                        <div class="col-sm-9 col-md-9 text-left pr-0">
                                            {{$crewName}}
                                        </div>
                                    </div> <!-- APPLICANT NAME ROW -->
                                </li> <!-- END NAME LIST ITEM -->
                                
                                <li class="list-group-item custom-list-partial"> <!-- START RANK LIST ITEM -->
                                    <div class="row"> <!-- APPLICANT RANK ROW -->
                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right">
                                            <strong>PRESENT RANK:</strong>
                                        </div>
                                        <div class="col-sm-9 col-md-9 text-left pr-0">
                                            @if($crewstatus=='EMBARKING' || $crewstatus=='STANDBY (LINE UP)')
                                                {{$lastEmbarkStatus['rank']}}
                                            @else
                                                {{$crewDetails->RANK}} 
                                            @endif
                                        </div>
                                    </div> <!-- APPLICANT RANK ROW -->
                                </li> <!-- END RANK LIST ITEM -->

                            </ul> <!-- END LIST WITH 9 COLUMN CLASS -->
                            
                        </div> <!-- END DIV WITH 9 COLUMN CLASS -->

                        @if(file_exists('storage/idpics/'.$crewDetails->APPLICANTNO.'.JPG')) 
                            <img id="applicantImage" class="col-sm-3 col-md-3 mr-0 pr-0"
                            src={{asset('storage/idpics/'.$crewDetails->APPLICANTNO.'.JPG')}}
                            style="border: 1px solid black;" height="150px" width = "150px">
                        @else
                            <img id="applicantImage" class="col-sm-3 col-md-3 mr-0 pr-0"
                            src={{asset('storage/idpics/no_image.JPG')}}
                            style="border: 1px solid black;" height="150px" width = "150px">
                        @endif
                        
                    </div> <!-- row with image -->

                    <div class="row"> <!-- START 2ND ROW COLUMN CLASS -->

                        <div class="col-sm-12 col-md-12"> <!-- START COLUMNS FOR 2ND ROW -->

                            <ul class="list-group" > <!-- START LIST FOR 2ND ROW -->

                                <li class="list-group-item custom-list-partial"> <!-- START ADDRESS LIST ITEM -->
                                    <div class="row ml-1"> <!-- APPLICANT ADDRESS ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0  text-right align-self-center">
                                            <strong>ADDRESS:</strong>
                                        </div>
                                        <div class="col-sm-10 col-md-10 text-left pr-0">
                                            {{$address}} 
                                        </div>
                                    </div> <!-- APPLICANT ADDRESS ROW -->
                                </li> <!-- END ADDRESS LIST ITEM -->
                        
                                <li class="list-group-item custom-list-full pr-0" > <!-- START 1ST LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row pl-3"> <!-- APPLICANT CONTACT ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>TEL. NO:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->TELNO}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>EMAIL:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->EMAIL}} 
                                        </div> 
                                    </div> <!-- APPLICANT CONTACT ROW -->
                                </li> <!-- END 1ST LIST GROUP ITEM FOR 2ND ROW -->
                        
                                <li class="list-group-item custom-list-full pr-0" > <!-- START 2ND LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row pl-3"> <!-- APPLICANT ALOTEE ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>ALOTEE:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->NEXTOFKIN}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>ALOTEE NO:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->CEL4}} 
                                        </div> 
                                    </div> <!-- APPLICANT ALOTEE ROW -->
                                </li> <!-- END 2ND LIST GROUP ITEM FOR 2ND ROW -->
                        
                                <li class="list-group-item custom-list-full pr-0" > <!-- START 3RD LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row pl-3"> <!-- APPLICANT RECOMENDATION ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>RECOMENDED:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$recomendedBy}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>JIS HOLDER:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->DOCCODE}} 
                                        </div> 
                                    </div> <!-- APPLICANT RECOMENDATION ROW -->
                                </li> <!-- END 3rd LIST GROUP ITEM FOR 2ND ROW -->
                                
                                <li class="list-group-item custom-list-full pr-0" > <!-- START 4th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row pl-3"> <!-- APPLICANT EDUC BACKGROUND ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>SCHOOL:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$school}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>COURSE:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$course}} 
                                        </div> 
                                    </div> <!-- APPLICANT EDUC BACKGROUND ROW -->
                                </li> <!-- END 4th LIST GROUP ITEM FOR 2ND ROW -->
                                
                                <li class="list-group-item custom-list-full pr-0" > <!-- START 5th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row"> <!-- APPLICANT HEIGHT AND EMB ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>HEIGHT:</strong>
                                        </div>
                                        <div class="col-sm-2 col-md-2 text-left pr-0">
                                            {{$crewDetails->HEIGHT}} cm. 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>EMB WEIGHT:</strong>
                                        </div>
                                        <div class="col-sm-1 col-md-1 text-left pr-0">
                                            {{$crewDetails->WEIGHT}} kg
                                        </div> 
                                        <div class="col-sm-1 col-md-1 pr-0 pl-0 text-right">
                                            <strong>BMI:</strong>
                                        </div>
                                        <div class="col-sm-3 col-md-3 text-left pr-0">
                                            {{$embBmi}}
                                        </div> 
                                    </div> <!-- APPLICANT HEIGHT AND EMB ROW -->
                                </li> <!-- END 5th LIST GROUP ITEM FOR 2ND ROW -->
                                
                                <li class="list-group-item custom-list-full pr-0" > <!-- START 6th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row"> <!-- APPLICANT BIRTHDATE AND DMB ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>BIRTHDATE:</strong>
                                        </div>
                                        <div class="col-sm-2 col-md-2 text-left pr-0">
                                            {{$crewDetails->BIRTHDATE}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>DMB WEIGHT:</strong>
                                        </div>
                                        <div class="col-sm-1 col-md-1 text-left pr-0">
                                            {{$crewDetails->DMBWEIGHT}} kg
                                        </div> 
                                        <div class="col-sm-1 col-md-1 pr-0 pl-0 text-right">
                                            <strong>BMI:</strong>
                                        </div>
                                        <div class="col-sm-3 col-md-3 text-left pr-0">
                                            {{$dmbBmi}}
                                        </div> 
                                    </div> <!-- APPLICANT BIRTHDATE AND DMB ROW -->
                                </li> <!-- END 6th LIST GROUP ITEM FOR 2ND ROW -->

                                <li class="list-group-item custom-list-full pr-0" > <!-- START 7th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row"> <!-- APPLICANT AGE AND SSS ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>AGE:</strong>
                                        </div>
                                        <div class="col-sm-2 col-md-2 text-left pr-0">
                                            {{$age}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>GENDER:</strong>
                                        </div>
                                        <div class="col-sm-1 col-md-1 text-left pr-0 pl-1">
                                            {{$gender}}
                                        </div>
                                        <div class="col-sm-1 col-md-1 pr-0 pl-0 text-right">
                                            <strong>SSS NO:</strong>
                                        </div>
                                        <div class="col-sm-2 col-md-2 text-left pr-0">
                                            {{$crewDetails->SSS}} 
                                        </div> 
                                    </div> <!-- APPLICANT AGE AND SSS ROW -->
                                </li> <!-- END 7th LIST GROUP ITEM FOR 2ND ROW -->

                                <li class="list-group-item custom-list-full pr-0" > <!-- START 8th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row"> <!-- APPLICANT BIRTHPLACE AND TIN ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>BIRTHPLACE:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->BIRTHPLACE}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>TAX ID NO:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->TIN}} 
                                        </div> 
                                    </div> <!-- APPLICANT BIRTHPLACE AND TIN ROW -->
                                </li> <!-- END 8th LIST GROUP ITEM FOR 2ND ROW -->

                                <li class="list-group-item custom-list-full pr-0" > <!-- START 9th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row"> <!-- APPLICANT STATUS AND PHILHEALTH ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>STATUS:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$civilStatus}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>PHILHEALTH NO:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->PHILHEALTH}} 
                                        </div> 
                                    </div> <!-- APPLICANT STATUS AND PHILHEALTH ROW -->
                                </li> <!-- END 9th LIST GROUP ITEM FOR 2ND ROW -->

                                <li class="list-group-item custom-list-full pr-0" > <!-- START 10th LIST GROUP ITEM FOR 2ND ROW -->
                                    <div class="row"> <!-- APPLICANT RELIGION AND PAGIBIG ROW -->
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>RELIGION:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->RELIGION}} 
                                        </div>
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>PAGIBIG NO:</strong>
                                        </div>
                                        <div class="col-sm-4 col-md-4 text-left pr-0">
                                            {{$crewDetails->PAGIBIG}} 
                                        </div> 
                                    </div> <!-- APPLICANT RELIGION AND PAGIBIG ROW -->
                                </li> <!-- END 10th LIST GROUP ITEM FOR 2ND ROW -->
                            </ul> <!-- END LIST FOR 2ND ROW -->

                            <div class="row crew-201status">

                                <div class="col-sm-12 col-md-12 crew-201status"> <!-- START COLUMNS FOR 3ND ROW -->

                                    <ul class="list-group crew-201status"> <!-- START LIST GROUP -->

                                        @if($crewstatus == 'ONBOARD')
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 1ST LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- APPLICANT VESSEL AND NEXT LINE UP ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>PRESENT VESSEL:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->VESSEL}} 
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>NEXT LINE UP:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        --------
                                                    </div> 
                                                </div> <!-- APPLICANT VESSEL AND NEXT LINE UP ROW -->
                                            </li> <!-- END 1ST LIST GROUP ITEM FOR 3RD ROW -->
                            
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 2ND LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- APPLICANT EMBARKED AND RANK ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>EMBARKED:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->DATEEMB}} 
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>RANK:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        
                                                    </div> 
                                                </div> <!-- APPLICANT EMBARK AND RANK ROW -->
                                            </li> <!-- END 2ND LIST GROUP ITEM FOR 3RD ROW -->
                            
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 3RD LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- START OF CONTRACT AND ETD ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>END OF CONTRACT:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$datedisemb}} 
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>ETD:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        
                                                    </div> 
                                                </div> <!-- APPLICANT END OF CONTRACT AND ETD ROW -->
                                            </li> <!-- END 3RD LIST GROUP ITEM FOR 3RD ROW -->

                                        @elseif($crewstatus == 'STANDBY (LINE UP)' || $crewstatus == 'EMBARKING')

                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 1ST LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- APPLICANT VESSEL AND NEXT LINE UP ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>LAST VESSEL:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                            {{$lastEmbarkStatus['vessel']}}
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>NEXT LINE UP:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->VESSEL}} 
                                                    </div> 
                                                </div> <!-- APPLICANT VESSEL AND NEXT LINE UP ROW -->
                                            </li> <!-- END 1ST LIST GROUP ITEM FOR 3RD ROW -->
                            
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 2ND LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row crew-201status"> <!-- APPLICANT EMBARKED AND RANK ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>EMBARKED:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                            {{$lastEmbarkStatus['embarked']}}
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>RANK:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->RANK}} 
                                                        </div> 
                                                </div> <!-- APPLICANT EMBARK AND RANK ROW -->
                                            </li> <!-- END 2ND LIST GROUP ITEM FOR 3RD ROW -->
                            
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 3RD LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- START OF CONTRACT AND ETD ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>END OF CONTRACT:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                            {{$lastEmbarkStatus['eoc']}}
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>ETD:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->DATEEMB}} 
                                                    </div> 
                                                </div> <!-- APPLICANT END OF CONTRACT AND ETD ROW -->
                                            </li> <!-- END 3RD LIST GROUP ITEM FOR 3RD ROW -->
                                            
                                        @else   
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 1ST LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- APPLICANT VESSEL AND NEXT LINE UP ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>LAST VESSEL:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->VESSEL}} 
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>NEXT LINE UP:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        --------
                                                    </div> 
                                                </div> <!-- APPLICANT VESSEL AND NEXT LINE UP ROW -->
                                            </li> <!-- END 1ST LIST GROUP ITEM FOR 3RD ROW -->
                            
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 2ND LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row crew-201status"> <!-- APPLICANT EMBARKED AND RANK ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>EMBARKED:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$crewDetails->DATEEMB}} 
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>RANK:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                    </div> 
                                                </div> <!-- APPLICANT EMBARK AND RANK ROW -->
                                            </li> <!-- END 2ND LIST GROUP ITEM FOR 3RD ROW -->
                            
                                            <li class="list-group-item custom-list-full pr-0 crew-201status" > <!-- START 3RD LIST GROUP ITEM FOR 3RD ROW -->
                                                <div class="row"> <!-- START OF CONTRACT AND ETD ROW -->
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>END OF CONTRACT:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">
                                                        {{$datedisemb}} 
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right crew-201status">
                                                        <strong>ETD:</strong>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 text-left pr-0 crew-201status">

                                                    </div> 
                                                </div> <!-- APPLICANT END OF CONTRACT AND ETD ROW -->
                                            </li> <!-- END 3RD LIST GROUP ITEM FOR 3RD ROW -->
                    
                                        @endif

                                        <li class="list-group-item custom-list-full pr-0 crew-201status" style="border-bottom: 1px solid rgb(155, 148, 148);"> <!-- START 4th LIST GROUP ITEM FOR 3RD ROW -->
                                            <div class="row"> <!--  END OF CONTRACT AND ETD ROW -->
                                                <div class="col-sm-6 col-md-6 pr-0 pl-0 text-right">
                                                    <table>
                                                        <tr>
                                                            <th> HIRING <br/> RESTRICTION:</th>
                                                            <td> {{$crewDetails->HIRINGRESTRICTION}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-right"> REMARKS: </th>
                                                            <td> {{$crewDetails->REMARKS}}  </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                {{-- <div class="col-sm-4 col-md-4 text-left pr-0">
                                                    <table>
                                                        <tr>
                                                            <td> {{$crewDetails->DATEEMB}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> {{$crewDetails->DATEEMB}} </td>
                                                        </tr>
                                                    </table>
                                                </div> --}}
                                                <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                                    <strong>STATUS:</strong>
                                                </div>
                                                <div class="col-sm-4 col-md-4 text-left pr-0">
                                                    {{$crewstatus}} 
                                                </div>
                                            </div> <!--  END OF CONTRACT AND ETD ROW -->
                                        </li> <!-- END 4th LIST GROUP ITEM FOR 3RD ROW -->
                                    </ul> <!-- END LIST GROUP -->

                                </div> <!-- END COLUMNS FOR 3ND ROW -->

                            </div>

                        </div> <!-- END COLUMNS FOR 2ND ROW -->
                    </div> <!-- END 2ND ROW COLUMN CLASS -->
                </div> <!-- div title card-body -->
            </div> <!-- div title card -->

        </div> <!-- column -->
        <div class="col-sm-6 col-md-6 pl-0">

            <table class="table table-hover docu-table" >
                <thead class="thead-dark ">
                    <tr>
                        <th>DOCUMENT</th>
                        <th>NO.</th>
                        <th>RANK</th>
                        <th>DATE ISSUED</th>
                        <th>DATE EXPIRED</th>
                    </tr>
                    <tbody>
                            @if(count($crewdocuments) > 0)
                                @foreach($crewdocuments as $document)
                                    <tr style="cursor: pointer;">
                                        <td> {{$document->DOCUMENT}} </td>
                                        <td> {{$document->DOCNO}} </td>
                                        <td> {{$document->RANK}} </td>
                                        <td> {{$document->DATEISSUED}} </td>
                                        <td> {{$document->DATEEXPIRED}} </td>
                                    </tr>
                                @endforeach
                            @endif
                    </tbody>
                </thead>

            </table>

        </div>
    </div> <!-- row -->
</section> <!-- end section -->

   
@endsection
