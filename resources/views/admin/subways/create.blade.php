@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.subways.store'], 'method' =>'POST']) !!}
        @include('admin.subways._form')
        {!! Form::close() !!}
    </div>
@stop
