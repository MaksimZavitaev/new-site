@extends('admin.wrapper')

@section('content')
    <div class="nav-tabs-custom">
        <div class="tab-content">
            {!! Form::open(['route' => ['admin.pages.store'], 'method' =>'POST']) !!}
            @include('admin.pages._form')

            {!! Form::close() !!}
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
@stop
