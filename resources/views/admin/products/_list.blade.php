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
                <th style="width: 10px"></th>
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
                    <td>
                        {!! Form::model($product, ['method' => 'DELETE', 'route' => ['admin.products.destroy', $product], 'class' => 'form-inline']) !!}
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
    <!-- /.box -->
    </div>
</div>

@push('scripts')
    <script>
        $('button.btn-danger').click(function (e) {
            e.preventDefault();
            var el = $(e.currentTarget);
            var icon = el.children();
            var form = el.parent();
            icon.removeClass('fa-trash');
            icon.addClass('fa-spinner fa-pulse');
            Swal.fire({
                title: 'Вы уверены?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить!',
                cancelButtonText: 'Отмена',
            }).then(function (result) {
                if (result.value) {
                    form.submit();
                    return;
                }
                icon.removeClass('fa-spinner fa-pulse');
                icon.addClass('fa-trash');
            });
        });
    </script>
@endpush
