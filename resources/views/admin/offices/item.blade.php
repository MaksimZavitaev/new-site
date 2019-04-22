@extends('admin.wrapper')

@section('content')
    <offices :id="@json($office_id ?? null)"></offices>
@stop
