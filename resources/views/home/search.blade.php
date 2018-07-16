
@extends('layouts.application')

@section('content')
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
                   
                    <tr>
                      <td>0001</td>
                      <td>Code</td>
                      <td>Albert</td>
                      <td>Arbowez</td>
                      <td>Sugui</td>
                      <td>MTR</td>
                      <td>MTR</td>
                    </tr>
                  </tbody>
                </table>
        
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

@endsection