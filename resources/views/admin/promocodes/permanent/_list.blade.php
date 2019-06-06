@php
    /** @var \App\Models\Product $product */
@endphp
<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Промокоды', 'creatable' =>true, 'route' => route('admin.promocodes.permanent.create')])
            @slot('header')
                <th style="width: 10px">ID</th>
                <th>Имя</th>
                <th>Продукт</th>
                <th>Diasoft ID</th>
                <th>Создано</th>
                <th style="width: 10px"></th>
            @endslot

            @foreach($promocodes as $promocode)
                <tr>
                    <td>{{ $promocode->id  }}</td>
                    <td>
                        <a href="{{ route('admin.promocodes.permanent.edit', $promocode) }}">
                            {{ $promocode->name }}
                        </a>
                    </td>
                    <td>{{$promocode->product->code}}</td>
                    <td>{{$promocode->diasoft_id}}</td>
                    <td>{{$promocode->created_at}}</td>
                    <td>
                        {!! Form::model($promocode, ['method' => 'DELETE', 'route' => ['admin.promocodes.permanent.destroy', $promocode], 'class' => 'form-inline']) !!}
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
