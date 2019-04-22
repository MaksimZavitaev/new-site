<div class="col-xs-12">
    @component('admin.components.boxed_table', ['name' => 'Офисы', 'creatable' =>true, 'route' => route('admin.offices.create')])
        @slot('header')
            <th style="width: 10px">ID</th>
            <th>Адрес</th>
            <th>Создан</th>
            <th style="width: 10px"></th>
        @endslot

        @foreach($offices as $office)
            <tr>
                <td>{{ $office->id  }}</td>
                <td>
                    <a href="{{ route('admin.offices.edit', $office) }}">
                        {{ $office->address }}
                    </a>
                </td>
                <td>{{$office->created_at}}</td>
                <td>
                    {!! Form::model($office, ['method' => 'DELETE', 'route' => ['admin.offices.destroy', $office], 'class' => 'form-inline']) !!}
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
