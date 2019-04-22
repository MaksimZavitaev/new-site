@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($subway, ['route' => ['admin.subways.update', $subway], 'method' =>'PUT']) !!}
        @include('admin.subways._form')
        {!! Form::close() !!}
    </div>
@stop
