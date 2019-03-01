@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($productType, ['route' => ['admin.product-types.update', $productType], 'method' =>'PUT']) !!}
        @include('admin.product_types._form')
        {!! Form::close() !!}
    </div>
@stop
