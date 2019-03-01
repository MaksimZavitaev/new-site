@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.forms.store'], 'method' =>'POST']) !!}
        @include('admin.forms._form')
        {!! Form::close() !!}
    </div>
@stop
