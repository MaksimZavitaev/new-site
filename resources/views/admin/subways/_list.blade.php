<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Станции метро', 'creatable' =>true, 'route' => route('admin.subways.create')])
            @slot('header')
                <th style="width: 10px">ID</th>
                <th>Название станиции</th>
                <th>Линия метро</th>
                <th style="width: 10px"></th>
            @endslot

            @foreach($subways as $item)
                <tr>
                    <td>{{ $item->id  }}</td>
                    <td>
                        <a href="{{ route('admin.subways.edit', $item) }}">
                            {{ $item->station }}
                        </a>
                    </td>
                    <td>
                        {{ $lines->firstWhere('line', $item->line)['name'] }}
                    </td>
                    <td>
                        {!! Form::model($item, ['method' => 'DELETE', 'route' => ['admin.subways.destroy', $item], 'class' => 'form-inline']) !!}
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
