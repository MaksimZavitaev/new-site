@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($promocode, ['route' => ['admin.promocodes.temporary.update', $promocode], 'method' =>'PUT']) !!}
        @include('admin.promocodes.temporary._form')
        {!! Form::close() !!}
    </div>
@stop
