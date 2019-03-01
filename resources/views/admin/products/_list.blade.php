@php
    /** @var \App\Models\Product $product */
@endphp
<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Продукты', 'creatable' =>true, 'route' => route('admin.products.create')])
            @slot('header')
                <th style="width: 10px">ID</th>
                <th>Имя</th>
                <th>Тип</th>
                <th>Код</th>
                <th>Diasoft ID</th>
                <th>Создано</th>
            @endslot

            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id  }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{$product->type->name}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->diasoft_id}}</td>
                    <td>{{$product->created_at}}</td>
                </tr>
        @endforeach
    @endcomponent
    <!-- /.box -->
    </div>
</div>
