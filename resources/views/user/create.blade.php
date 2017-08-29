




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Add a New {{$role}}</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              @include('partials.alerts.errors')




                <div class="panel-heading lead">Enter the personal details of a new {{$role}} below.</div>

                <div class="panel-body">



                  {!! Form::open([
                      'route' => 'user.store'
                  ]) !!}

                  <div class="form-group">
                      {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                      {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="form-group">
                      {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                      {!! Form::email('email', null, ['class' => 'form-control']) !!}

                  </div>

                  <div class="form-group">
                    <?php
                    // include 'Text/Password.php';
                    // $tp = new Text_Password();
                    // $pass = $tp->create(10).rand(0,1000);

                    //narazie bez sprawdzania sily hasla
                    $genPass = str_random(10);
                    $hashedGenPass = Hash::make("$genPass");


                    ?>


                      {!! Form::label('password', "Generated password: $genPass", ['class' => 'control-label']) !!}
                      {!! Form::hidden('password', $hashedGenPass) !!}
                      {!! Form::hidden('role', $role) !!}


                  </div>


                  {!! Form::submit("Create $role", ['class' => 'btn btn-primary']) !!}

                  <a href="{{ route('user.list.role', $role) }}" class="btn btn-info">Back to all {{$role}}s</a>
                  {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</div>





@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
