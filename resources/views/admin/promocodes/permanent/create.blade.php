@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.promocodes.permanent.store'], 'method' =>'POST']) !!}
        @include('admin.promocodes.permanent._form')
        {!! Form::close() !!}
    </div>
@stop
