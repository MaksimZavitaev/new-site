@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($promocode, ['route' => ['admin.promocodes.permanent.update', $promocode], 'method' =>'PUT']) !!}
        @include('admin.promocodes.permanent._form')
        {!! Form::close() !!}
    </div>
@stop
