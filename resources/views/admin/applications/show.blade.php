@php
    /** @var \App\Models\Application $application */
@endphp

@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Заявка #{{$application->id}}</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6 col-xs-12">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Название страницы</b>
                        <a href="{{$application->page->link}}" class="pull-right">
                            {{$application->page->name}}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Название формы</b>
                        <a href="{{route('admin.forms.edit', $application->form)}}" class="pull-right">
                            {{$application->form->name}}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>IP пользователя</b>
                        <p class="pull-right">{{$application->user_ip}}</p>
                    </li>
                    <li class="list-group-item">
                        <b>Браузер пользователя</b>
                        <p>{{$application->user_agent}}</p>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 col-xs-12">
                <pre>{{json_encode($application->data)}}</pre>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        var $pre = $('pre');
        var jsonStr = $pre.text();
        var jsonObj = JSON.parse(jsonStr);
        var jsonPretty = JSON.stringify(jsonObj, null, '  ');

        $pre.text(jsonPretty);
    </script>
@endpush
