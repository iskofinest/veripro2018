<div class="row">
        <section class="col-sm-9 col-md-9">

            <div class="form-inline " style="width: 1000px">
            
                <div class="pl-5 form-group mx-sm-3 mb-2">
                    <label class="sr-only" for="fieldToSearch1"> Select Field </label>
                    <select class="form-control  pr-0 font-weight-bold" id="fieldToSearch1">
                            <option value="FName">FAMILY NAME</option>
                            <option value="CREWCODE">CREW CODE</option>
                            <option value="APPLICANTNO">APPLICANT NO</option>
                            <option value="GNAME">GIVEN NAME</option>
                    </select>
                    @if(isset($fieldToSearch1))
                        <script>
                            document.getElementById('fieldToSearch1').value = "{{$fieldToSearch1}}";
                        </script>
                    @endif
                    <label class="sr-only" for="searchField1"> Search </label>
                    <input type="text" id="searchField1" class="form-control ml-2 font-weight-bold" style="width: 250px;"
                        @if(isset($searchText1))
                            value="{{$searchText1}}"
                        @endif
                    placeholder="Search" required autofocus style="width: 300px; text-transform: uppercase" name="searchField1">
                </div>
                    
                <div class="form-group mx-sm-3 mb-2">
                    <label class="sr-only" for="fieldToSearch2"> Select Field </label>
                    <select class="form-control  pr-0 font-weight-bold" id="fieldToSearch2">
                        <option value="FName">FAMILY NAME</option>
                        <option value="CREWCODE">CREW CODE</option>
                        <option value="APPLICANTNO">APPLICANT NO</option>
                        <option value="GNAME">GIVEN NAME</option>
                    </select>

                    @if(isset($fieldToSearch2))
                        <script>
                            document.getElementById('fieldToSearch2').value = "{{$fieldToSearch2}}";
                        </script>
                    @endif
                    <label class="sr-only" for="searchField"2> Search </label>
                    <input type="text" id="searchField2" class="form-control ml-2 font-weight-bold" style="width: 250px;"
                        @if(isset($searchText2))
                            value="{{$searchText2}}"
                        @endif
                    placeholder="Search" required style="width: 300px; text-transform: uppercase" name="searchField2">
                </div>
            </div> <!-- div form-inline close tag -->
        
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
                            <tr style="cursor: pointer;" role="button" onclick="chooseApplicant({{$applicant->APPLICANTNO}})">
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
                    {{-- @if(count($applicants) > 0) --}}
                        @if((count($applicants)>0) && file_exists('storage/idpics/'.$applicants[0]->APPLICANTNO.'.JPG')) 
                            <h5 class="card-title text-center"> <img id="applicantImage" 
                            src={{asset('storage/idpics/'.$applicants[0]->APPLICANTNO.'.JPG')}}
                            style="border: 1px solid black;" height="250px" width = "250px"> </h5>
                        @else
                            <h5 class="card-title text-center"> <img id="applicantImage" 
                            src={{asset('storage/idpics/no_image.JPG')}}
                            style="border: 1px solid black;" height="250px" width = "250px"> </h5>
                        @endif
                    {{-- @endif --}}
                        
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

                </div>
            </div>
        </div> <!-- div close tag for applicant 201 display -->

    </div>

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

    // functions for search 
    $("#searchField1").keypress(function(e) {
        if(e.which == 13) {
            search();
        }
    });

    $("#searchField2").keypress(function(e) {
        if(e.which == 13) {
            search();
        }
    });
    

    function search() {
        var searchText1 = $('#searchField1').val();
        var searchField1 = $('#fieldToSearch1').val();
        var searchText2 = $('#searchField2').val();
        var searchField2 = $('#fieldToSearch2').val();
        if(searchText1 === "") {
            alert("empty searchfield 1");
            searchText1 = "null";
        }
        if(searchText2 == "") {
            alert("empty searchfield 2");
            searchText2 = "null";
        }
        if(searchText1 != "")  {
            alert("{{url('home/search')}}" + "/"  + searchText1 + "/" + searchField1+ "/"  + searchText2 + "/" + searchField2);
            // window.location = "{{url('home/search')}}" + "/"  + searchText1 + "/" + searchField1;
            window.location = "{{url('home/search')}}" + "/"  + searchText1 + "/" + searchField1+ "/"  + searchText2 + "/" + searchField2;
        }else  window.location = "{{url('home')}}";
    }

    function view201() {
        window.open('/google.com');
    }

</script>
