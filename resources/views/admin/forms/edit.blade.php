@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($form, ['route' => ['admin.forms.update', $form], 'method' =>'PUT']) !!}
        @include('admin.forms._form')
        {!! Form::close() !!}
    </div>
@stop
