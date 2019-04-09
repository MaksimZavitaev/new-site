@php
    /** @var Attention $attention */use App\Models\Attention;
@endphp
<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Уведомления', 'creatable' =>true, 'route' => route('admin.attentions.create')])
            @slot('header')
                <th>ID</th>
                <th>Название</th>
                <th>Отобразить</th>
                <th>Скрыть</th>
                <th style="width: 10px"></th>
            @endslot

            @foreach($attentions as $attention)
                <tr>
                    <td>{{ $attention->id  }}</td>
                    <td>
                        <a href="{{ route('admin.attentions.edit', $attention) }}">
                            {{ $attention->title }}
                        </a>
                    </td>
                    <td>{{ $attention->started_at }}</td>
                    <td>{{ $attention->ended_at }}</td>
                    <td>
                        {!! Form::model($attention, ['method' => 'DELETE', 'route' => ['admin.attentions.destroy', $attention], 'class' => 'form-inline']) !!}
                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',
                        [
                            'class' => 'btn btn-xs btn-danger',
                            'type' => 'submit'
                        ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endcomponent
    </div>
</div>
