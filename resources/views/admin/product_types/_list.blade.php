@php
    /** @var \App\Models\ProductType $type */
@endphp
<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Виды продуктов', 'creatable' =>true, 'route' => route('admin.product-types.create')])
            @slot('header')
                <th style="width: 10px">ID</th>
                <th>Имя</th>
                <th>Код</th>
                <th>Diasoft ID</th>
                <th>Создано</th>
            @endslot

            @foreach($types as $type)
                <tr>
                    <td>{{ $type->id  }}</td>
                    <td>
                        <a href="{{ route('admin.product-types.edit', $type) }}">
                            {{ $type->name }}
                        </a>
                    </td>
                    <td>{{$type->code}}</td>
                    <td>{{$type->diasoft_id}}</td>
                    <td>{{ $type->created_at }}</td>
                </tr>
        @endforeach
    @endcomponent
    <!-- /.box -->
    </div>
</div>
