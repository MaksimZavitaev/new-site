@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($product, ['route' => ['admin.products.update', $product], 'method' =>'PUT']) !!}
        @include('admin.products._form')
        {!! Form::close() !!}
    </div>
@stop
