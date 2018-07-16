<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/bootstrap.min.js') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/jquery-3.3.1.slim.min.js') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/popper.min.js') }}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{asset('bootstrap4\dist\css\bootstrap.min.css')}}">
        <script src="{{asset('bootstrap4\assets\js\vendor\jquery-slim.min.js')}}"></script>
        <script src="{{asset('bootstrap4\assets\js\vendor\popper.min.js')}}"></script>
        <script src="{{asset('bootstrap4\dist\js\bootstrap.min.js')}}"></script>

    </head>

    <body class="jumbotron" style="bg-color: blue">

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    {{-- <h4 class="text-center mb-4" style="
                    font-family: helvetica;
                    font-weight: bolder;
                    color: blue;"> VERITAS RESOURCE INTEGRATION PROGRAM</h4> --}}
                    <div class="row justify-content-center col-lg-6 mx-auto">
                      @include('inc.messages')
                    </div>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
        
                            <!-- form card login -->
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <h3 class="mb-0">Login</h3>
                                </div>
                                <div class="card-body">
                                    {!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'class' => 'form']) !!}
                                    {{-- <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST"> --}}
                                        <div class="form-group">
                                            <label for="uname1">Username</label>
                                            {{-- <input type="text" class="form-control form-control-lg rounded-0" name="uname1" id="uname1" required=""> --}}
                                            {{Form::text('username', '', ['class'=>'form-control form-control-lg rounded-0', 'placeholder'=>'Username', 'onblur'=>'this.value=this.value.toUpperCase()'])}}
                                            <div class="invalid-feedback">Oops, you missed this one.</div>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            {{-- <input type="password" class="form-control form-control-lg rounded-0" id="pwd1" required="" autocomplete="new-password"> --}}
                                            {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control form-control-lg rounded-0' ) ) }}
                                            <div class="invalid-feedback">Enter your password too!</div>
                                        </div>
                                        
                                        {{Form::submit('Submit', ['class' => 'btn btn-primary btn-block btn-lg'])}}
                                        {{-- <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button> --}}
                                    {!! Form::close() !!} 
                                    {{-- </form> --}}
                                </div>
                                <!--/card-block-->
                            </div>
                            <!-- /form card login -->
        
                        </div>
        
        
                    </div>
                    <!--/row-->
        
                </div>
                <!--/col-->
            </div>
            <!--/row-->
        </div>
        <!--/container-->
        
    </body>

</html>