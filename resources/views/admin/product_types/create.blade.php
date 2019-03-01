@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.product-types.store'], 'method' =>'POST']) !!}
        @include('admin.product_types._form')
        {!! Form::close() !!}
    </div>
@stop
