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
                <th style="width: 10px;"></th>
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
                    <td>
                        {!! Form::model($type, ['method' => 'DELETE', 'route' => ['admin.product-types.destroy', $type], 'class' => 'form-inline']) !!}
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
                text: 'Удаление записи приведет к удалению зависящих от нее продуктов!',
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
