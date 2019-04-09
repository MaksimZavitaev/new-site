@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($attention, ['route' => ['admin.attentions.update', $attention], 'method' =>'PUT']) !!}
        @include('admin.attentions._form')
        {!! Form::close() !!}
    </div>
@stop
