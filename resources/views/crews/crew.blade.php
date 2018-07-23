@extends('layouts.application')

@section('content')

<div class="row mb-3">
    <div class="col-sm-12 col-md-12">
        <div class="card bg-primary">
                <div class="card-body">
                    <h2 class="card-title text-center">
                        {{$crewDetails->GNAME.' '.$crewDetails->MNAME.' '.$crewDetails->FNAME}}
                    </h2>
                </div> <!-- div title card-body -->
        </div> <!-- div title card -->
    </div> <!-- div title col -->
</div> <!-- div title row -->

<section >
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="card">
                <div class="card-body">

                    <h3 class="card-title lead">
                        <p class="h3">Personal Details</p>
                    </h3>
                    
                    <div class="row">

                        <div class="col-sm-9 col-md-9"> <!-- START DIV WITH 9 COLUMN CLASS -->
                        
                            <ul class="list-group" > <!-- START LIST WITH 9 COLUMN CLASS -->
                        
                                <li class="list-group-item custom-list-partial"> <!-- START APPLICANT IDENTIFICATION LIST ITEM -->
                                    
                                    <div class="row"> <!-- APPLICANT ID ROW -->

                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right">
                                            <strong>APPLICANT NO:</strong>
                                        </div>
                                        
                                        <div class="col-sm-2 col-md-2 text-left">
                                            {{$crewDetails->APPLICANTNO}} 
                                        </div>
                                        
                                        <div class="col-sm-3 col-md-3 text-right">
                                            <strong>CREW CODE: </strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$crewDetails->CREWCODE}} 
                                        </div> 

                                    </div> <!-- APPLICANT ID ROW -->

                                </li> <!-- END APPLICANT IDENTIFICATION LIST ITEM -->

                                <li class="list-group-item custom-list-partial"> <!-- START NAME LIST ITEM -->
                                
                                    <div class="row"> <!-- APPLICANT NAME ROW -->
                                
                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right">
                                            <strong>NAME:</strong>
                                        </div>
                                
                                        <div class="col-sm-9 col-md-9 text-left">
                                            {{$crewName}}
                                        </div>
                                
                                    </div> <!-- APPLICANT NAME ROW -->
                                
                                </li> <!-- END NAME LIST ITEM -->
                                
                                <li class="list-group-item custom-list-partial"> <!-- START RANK LIST ITEM -->
                                
                                    <div class="row"> <!-- APPLICANT RANK ROW -->
                                
                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right">
                                            <strong>PRESENT RANK:</strong>
                                        </div>
                                
                                        <div class="col-sm-9 col-md-9 text-left">
                                            {{$crewDetails->RANK}} 
                                        </div>
                                
                                    </div> <!-- APPLICANT RANK ROW -->
                                
                                </li> <!-- END RANK LIST ITEM -->

                                <li class="list-group-item custom-list-partial"> <!-- START ADDRESS LIST ITEM -->

                                    <div class="row"> <!-- APPLICANT ADDRESS ROW -->
                                    
                                        <div class="col-sm-3 col-md-3 pr-0 pl-0 text-right align-self-center">
                                            <strong>ADDRESS:</strong>
                                        </div>
                                    
                                        <div class="col-sm-9 col-md-9 text-left">
                                            {{$address}} 
                                        </div>
                                    
                                    </div> <!-- APPLICANT ADDRESS ROW -->

                                </li> <!-- END ADDRESS LIST ITEM -->

                            </ul> <!-- END LIST WITH 9 COLUMN CLASS -->
                            
                        </div> <!-- END DIV WITH 9 COLUMN CLASS -->

                            <img id="applicantImage" class="col-sm-3 col-md-3 mr-0 pr-0"
                                src={{asset('storage/idpics/'.$crewDetails->APPLICANTNO.'.JPG')}}
                                style="border: 1px solid black;" height="200px" width = "200px">
                        
                    </div> <!-- row with image -->

                    <div class="row"> <!-- START 2ND ROW COLUMN CLASS -->

                        <div class="col-sm-12 col-md-12"> <!-- START COLUMNS FOR 2ND ROW -->

                            <ul class="list-group" > <!-- START LIST FOR 2ND ROW -->
                        
                                <li class="list-group-item custom-list-full" style="border-top: 1px solid rgb(155, 148, 148);"> <!-- START 1ST LIST GROUP ITEM FOR 2ND ROW -->

                                    <div class="row pl-3"> <!-- APPLICANT CONTACT ROW -->

                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>TEL. NO:</strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$crewDetails->TELNO}} 
                                        </div>
                                        
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>EMAIL: </strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$crewDetails->EMAIL}} 
                                        </div> 

                                    </div> <!-- APPLICANT CONTACT ROW -->

                                </li> <!-- END 1ST LIST GROUP ITEM FOR 2ND ROW -->
                        
                                <li class="list-group-item custom-list-full" style="border-top: 1px solid rgb(155, 148, 148);"> <!-- START 2ND LIST GROUP ITEM FOR 2ND ROW -->

                                    <div class="row pl-3"> <!-- APPLICANT ALOTEE ROW -->

                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>ALOTEE:</strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$crewDetails->NEXTOFKIN}} 
                                        </div>
                                        
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>ALOTEE NO:</strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$crewDetails->CEL4}} 
                                        </div> 

                                    </div> <!-- APPLICANT ALOTEE ROW -->

                                </li> <!-- END 2ND LIST GROUP ITEM FOR 2ND ROW -->
                        
                                <li class="list-group-item custom-list-full" style="border-top: 1px solid rgb(155, 148, 148);"> <!-- START 3RD LIST GROUP ITEM FOR 2ND ROW -->

                                    <div class="row pl-3"> <!-- APPLICANT RECOMENDATION ROW -->

                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>RECOMENDED:</strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$recomendedBy}} 
                                        </div>
                                        
                                        <div class="col-sm-2 col-md-2 pr-0 pl-0 text-right">
                                            <strong>JIS HOLDER:</strong>
                                        </div>
                                        
                                        <div class="col-sm-4 col-md-4 text-left">
                                            {{$crewDetails->DOCCODE}} 
                                        </div> 

                                    </div> <!-- APPLICANT RECOMENDATION ROW -->

                                </li> <!-- END 3rd LIST GROUP ITEM FOR 2ND ROW -->

                            </ul> <!-- END LIST FOR 2ND ROW -->
                                
                        </div> <!-- END COLUMNS FOR 2ND ROW -->

                    </div> <!-- END 2ND ROW COLUMN CLASS -->

                </div> <!-- div title card-body -->

            </div> <!-- div title card -->

        </div> <!-- column -->
    
    </div> <!-- row -->

</section> <!-- end section -->
   
@endsection