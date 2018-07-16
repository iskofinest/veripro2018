<nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: #003366;">
    <a class="navbar-brand" href="#"> <h1> VERIPRO </h1> </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> 
        <span class="navbar-toggler-icon"> </span>
    </button>

   
        <div class="form-inline " style="width: 1000px">
                
            <div class="form-group mx-sm-3 mb-2">
                <label class="sr-only" for="fieldToSearch"> Select Field </label>
                <select class="form-control  pr-5 font-weight-bold" id="fieldToSearch" >
                        <option value="FName">FAMILY NAME</option>
                        <option value="CREWCODE">CREW CODE</option>
                        <option value="APPLICANTNO">APPLICANT</option>
                        <option value="GNAME">GIVEN NAME</option>
                </select>
                <label class="sr-only" for="searchField"> Search </label>
                <input type="text" id="searchField" class="form-control ml-2 mr-2 font-weight-bold" onKeyPress="search()"
                        placeholder="Search" required autofocus style="width: 300px; text-transform: uppercase" name="searchField">
            </div>
        </div>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        

        <ul class="navbar-nav ml-auto ">
            @if(session('accessLevels'))
                
                @if(session('accessLevels')["CREW"])
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="" id="crewDropdown" data-toggle="dropdown"> <h4>Crew</h4>  </a>
                        <div class="dropdown-menu bg-primary">
                            @foreach(session('accessLevels')["CREW"] as $crew_selection)

                                @if(in_array("Crew Change Plan", (array)$crew_selection)) 
                                    <a class="dropdown-item col-sm-8 col-md-8 col-lg-8" href="#"> <h6>Crew Change Plan</h6> </a> 

                                @elseif(in_array("Onboard Manipulation", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6> Onboard Manipulation</h6> </a> 
                                
                                @elseif(in_array("Data Sheet", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Data Sheet</h6> </a> 
                                
                                @elseif(in_array("Onboard Crew Listing", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6> Onboard Crew Listing</h6> </a> 
                                
                                @elseif(in_array("Scholar", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Scholar</h6> </a> 
                                
                                @elseif(in_array("Fasttrack", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6> Fasttrack</h6> </a> 
                                
                                @elseif(in_array("Training Endorsement", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Training Endorsement</h6> </a> 
                                
                                @elseif(in_array("Debriefing/ Arriving", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Debriefing/ Arriving</h6> </a> 
                                
                                @elseif(in_array("Departing Seaman", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Departing Seaman</h6> </a> 
                                
                                @elseif(in_array("Debriefing Status", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Debriefing Status</h6> </a> 
                                
                                @elseif(in_array("Withdrawal", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Withdrawal</h6> </a> 
                                
                                @elseif(in_array("TNKCHouse (Booking)<", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>TNKCHouse (Booking)</h6> </a> 
                                
                                @elseif(in_array("Malasian License", (array)$crew_selection))
                                    <a class="dropdown-item" href="#"> <h6>Malasian License</h6> </a> 
                                
                                @endif
                            
                            @endforeach
                        </div>
                    </li>
                @endif

                @if(session('accessLevels')["APPLICANT"])
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="" id="applicantDropdown" data-toggle="dropdown"> <h4>Applicant</h4> </a>
                        <div class="dropdown-menu">

                            @foreach(session('accessLevels')["APPLICANT"] as $applicant_selection)

                                @if(in_array("Fleet Approval", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Fleet Approval</h6> </a>
                                
                                @elseif(in_array("Management Approval", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Management Approval</h6> </a>
                                   
                                @elseif(in_array("Character Check", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Character Check</h6> </a>
                                    
                                @elseif(in_array("Picture Loading", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Picture Loading</h6> </a>
                                    
                                @elseif(in_array("Encode Documents", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Encode Documents</h6> </a>
                                    
                                @elseif(in_array("Screening", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Screening</h6> </a>
                                    
                                @elseif(in_array("Monitor", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Monitor</h6> </a>
                                    
                                @elseif(in_array("Principal Approval", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Principal Approval</h6> </a>
                                    
                                @elseif(in_array("Division Approval", (array)$applicant_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Division Approval</h6> </a>

                                @endif
                                
                            @endforeach
                        </div>
                    </li>
                @endif


                @if(session('accessLevels')["TRAINING"])
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" data-toggle="dropdown"> <h4>Training</h4> </a>
                        <div class="dropdown-menu">

                            @foreach(session('accessLevels')["TRAINING"] as $training_selection)

                                @if(in_array("Evaluation", (array)$training_selection)) 

                                    <a class="dropdown-item" href="#"> <h6>Evaluation</h6> </a>
                                  
                                @elseif(in_array("Crew Checklist", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Crew Checklist</h6> </a>
                                   
                                @elseif(in_array("Generate Class Card", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Generate Class Card</h6> </a>
                                    
                                @elseif(in_array("Endorsement Letter", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Endorsement Letter</h6> </a>
                                    
                                @elseif(in_array("Grade Posting", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Grade Posting</h6> </a>
                                    
                                @elseif(in_array("Generate Certificate", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Generate Certificate</h6> </a>
                                    
                                @elseif(in_array("Monitor", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Monitor</h6> </a>
                                    
                                @elseif(in_array("Checklist By Rank", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Checklist By Rank</h6> </a>
                                    
                                @elseif(in_array("Checklist(revised)", (array)$training_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Checklist(revised)</h6> </a>

                                @endif
                            @endforeach
                        </div>
                    </li>
                @endif


                @if(session('accessLevels')["DOCUMENTS"])

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" data-toggle="dropdown"> <h4>Documents</h4> </a>
                        <div class="dropdown-menu">

                            @foreach(session('accessLevels')["DOCUMENTS"] as $documents_selection)

                                @if(in_array("File Manipulation", (array)$documents_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>File Manipulation</h6> </a>

                                @elseif(in_array("File Cleanup", (array)$documents_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>File Cleanup</h6> </a>

                                @endif

                            @endforeach
                        </div>
                    </li>

                @endif

                @if(session('accessLevels')["SETUP"])

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" data-toggle="dropdown"> <h4>Setup</h4> </a>
                        <div class="dropdown-menu">

                            @foreach(session('accessLevels')["SETUP"] as $setup_selection)

                                @if(in_array("Setup", (array)$setup_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Setup</h6> </a>
                                    
                                @elseif(in_array("Crew Info", (array)$setup_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Crew Info</h6> </a>
                                
                                @elseif(in_array("Upload CER", (array)$setup_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Upload CER</h6> </a>
                                
                                @elseif(in_array("Docs Info", (array)$setup_selection)) 
                                    <a class="dropdown-item" href="#"> <h6>Docs Info</h6> </a>
                                @endif

                            @endforeach
                        </div>
                    </li>

                @endif

                @if(session('accessLevels')["REPORTS"])
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> <h4>Reports</h4> </a>
                    </li>
                @endif

             @endif

             <li class="nav-item active">
                    <a class="nav-link " <a  id="logout"> <h4>Logout</h4> </a>
                </li>

        </ul> <!-- <ul class="navbar-nav ml-auto"> -->

    </div> <!-- div navbar-colapse-->
</nav>

<script>

    // function for logout nav
    $("#logout").on('click', function(e) {
        
        if(confirm('Do you want to logout?')){
            window.location.href = "{{url('users/logout')}}";
        }
    });

    // function for search 
    $("#searchField").keypress(function(e) {
        if(e.which == 13) {
            var searchText = $('#searchField').val();
            var searchField = $('#fieldToSearch').val();
            if(searchText != "")  window.location = "{{url('home/search')}}" + "/"  + searchText + "/" + searchField;
        }
    });
   
</script>