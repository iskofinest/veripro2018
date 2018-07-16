

<div class="row">
        <section class="col-sm-8 col-md-8">

                <h2>Search Results</h2>
        
                {{-- <p> Can inject supporting details for result</p> --}}
                <table class="table">
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
                            <tr>
                                
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
                {{ $posts->links('pagination.default') }}
                {{-- @include('pagination.default', ['paginator' => $applicants]) --}}
                {{-- <div class=" pagination col-sm-8 col-md-8" style="justify-content: center;"> {{ $applicants->links() }} </div>
                <div class="pagination ">{{ $applicants->links() }} </div> --}}
        
        </section>

        

        <div class="col-sm-6 col-md-4"> 
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"> Card Title </h5>
                    <p class="card-text"> Some quick text to build up on the card title </p>
                    <a href="#" class="card-link"> Another link </a>
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
