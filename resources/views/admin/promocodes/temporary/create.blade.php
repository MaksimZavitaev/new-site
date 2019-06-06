@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.promocodes.temporary.store'], 'method' =>'POST']) !!}
        @include('admin.promocodes.temporary._form')
        {!! Form::close() !!}
    </div>
@stop
