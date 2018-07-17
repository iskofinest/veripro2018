

<div class="row">
        <section class="col-sm-9 col-md-9">

                

                <div class="form-inline " style="width: 1000px">
                
                        <h2>Search Results</h2>
                        <div class="form-group mx-sm-3 mb-2">
                            <label class="sr-only" for="fieldToSearch"> Select Field </label>
                            <select class="form-control  pr-5 font-weight-bold" id="fieldToSearch">
                                    <option value="FName">FAMILY NAME</option>
                                    <option value="CREWCODE">CREW CODE</option>
                                    <option value="APPLICANTNO">APPLICANT NO</option>
                                    <option value="GNAME">GIVEN NAME</option>
                            </select>
                            @if(isset($fieldToSearch))
                                <script>
                                    document.getElementById('fieldToSearch').value = "{{$fieldToSearch}}";
                                </script>
                            @endif
                            <label class="sr-only" for="searchField"> Search </label>
                            <input type="text" id="searchField" class="form-control ml-2 mr-2 font-weight-bold"
                                @if(isset($searchText))
                                    value={{$searchText}}
                                @endif
                            placeholder="Search" required autofocus style="width: 300px; text-transform: uppercase" name="searchField">
                        </div>
                    </div>
        
                {{-- <p> Can inject supporting details for result</p> --}}
                <table class="table table-hover">
                  <thead class="thead-dark ">
                    <tr>
                            <th>APP. NO</th>
							<th>CREW CODE</th>
							<th>FNAME</th>
							<th>GNAME</th>
							<th>MNAME</th>
							<th>RANK</th>
							<th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($applicants) > 0)
                        @foreach($applicants as $applicant)
                            <tr style="cursor: pointer;" role="button" ondblclick="chooseApplicant({{$applicant->APPLICANTNO}})">
                                <td>{{$applicant->APPLICANTNO}}</td>
                                <td>{{$applicant->CREWCODE}}</td>
                                <td>{{$applicant->FNAME}}</td>
                                <td>{{$applicant->GNAME}}</td>
                                <td>{{$applicant->MNAME}}</td>
                                @if(!empty($applicant->RANK)) <td>{{$applicant->RANK}}</td> @endif
                                @if(empty($applicant->DESCRIPTION) && empty($applicant->FASTTRACK) && empty($applicant->UTILITY))
                                    <td>REGULAR</td>
                                @else
                                    <td> {{$applicant->DESCRIPTION}} {{$applicant->FASTTRACK}} {{$applicant->UTILITY}}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
                {{$applicants->links('vendor.pagination.bootstrap-4')}}
        
        </section>

        

        <div class="col-sm-3 col-md-3"> 
            <div class="card mb-4">
                <div class="card-body">

                    <h5 class="card-title text-center"> <img id="applicantImage" 
                        src={{asset('storage/idpics/'.$applicants[0]->APPLICANTNO.'.JPG')}}
                        {{-- {{'/'.$applicants[0]->APPLICANTNO.'.JPG'}} --}}
                        {{-- {{'/no_image.jpg'}} --}}
                        {{-- src="{{asset('storage/idpics/')}}".{{$applicants[0]->APPLICANTNO}}.jpg --}}
                        style="border: 1px solid black;" height="250px" width = "250px"> </h5>
                        {{-- @if(file_exists( {{asset('storage/idpics/'.$applicants[0]->APPLICANTNO.'.JPG')}} )) --}}
                        
                    <div class="row m-3">
                            <button type="button" class="col col-12 btn btn-primary mb-2" onclick="view201()">201 Profile</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">Debriefing</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">Withdrawal</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">Training</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">Crew Comments</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">Documents Index</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">List of Recommendee</button>
                            <button type="button" class="col col-12 btn btn-primary mb-2">Cash Advance</button>
                        </div>
                    {{-- <p class="card-text"> Some quick text to build up on the card title </p>
                    <a href="#" class="card-link"> Another link </a> --}}
                </div>
            </div>
        </div>

</div>

  {{-- <div class="row">

        <div class="col-sm-6 col-md-4"> 
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"> Card Title </h5>
                    <p class="card-text"> Some quick text to build up on the card title </p>
                    <a href="#" class="card-link"> Another link </a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-md-4"> 
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"> Card Title </h5>
                    <p class="card-text"> Some quick text to build up on the card title </p>
                    <a href="#" class="card-link"> Another link </a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-md-4"> 
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"> Card Title </h5>
                    <p class="card-text"> Some quick text to build up on the card title </p>
                    <a href="#" class="card-link"> Another link </a>
                </div>
            </div>
        </div>
    </div> --}}

</div>

<script>

    var chosenApplicant = "";


    function initializeData(applicantNo) {

    }

    function chooseApplicant(applicantNo) {
        chosenApplicant = applicantNo;
        var url = "{{asset('storage/idpics/')}}/" + applicantNo + ".JPG";
        $("#applicantImage").attr("src", url).on("error", function(){
            $("#applicantImage").attr("src",   "{{asset('storage/idpics/')}}/no_image.jpg");
        });
    }

    // function for search 
    $("#searchField").keypress(function(e) {
        if(e.which == 13) {
            var searchText = $('#searchField').val();
            var searchField = $('#fieldToSearch').val();
            if(searchText != "")  window.location = "{{url('home/search')}}" + "/"  + searchText + "/" + searchField;
            else  window.location = "{{url('home')}}";
        }
    });

    function view201() {

    }

</script>
