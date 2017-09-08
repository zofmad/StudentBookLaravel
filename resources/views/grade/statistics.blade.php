




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Class statistics</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading lead"></div>

                <div class="panel-body">
                  <script labels="{{$subjects[0]}}" data="{{$nbOfGradesPerSubjectArray[1]}}"src="{{ asset('js/chart.js') }}"></script>
                  <canvas id="myChart" width="400" height="400"></canvas>
                  <hr>
                  @permission('classes-CRUD')
                    <a href="{{ route('classrooms.index') }}" class="btn btn-info">Back to all classes</a>

                  @endpermission
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
