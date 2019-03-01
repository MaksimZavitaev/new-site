@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.products.store'], 'method' =>'POST']) !!}
        @include('admin.products._form')
        {!! Form::close() !!}
    </div>
@stop
