@extends('admin.wrapper')

@section('content')
    <div class="nav-tabs-custom">
        <div class="tab-content">
            {!! Form::open(['route' => ['admin.attentions.store'], 'method' =>'POST']) !!}
            @include('admin.attentions._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop
