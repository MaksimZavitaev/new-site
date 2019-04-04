<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Пользователи', 'creatable' =>true, 'route' => route('admin.users.create')])
            @slot('header')
                <th style="width: 10px">ID</th>
                <th>Пользватель</th>
                <th>Создан</th>
                <th>Роли</th>
                <th style="width: 10px"></th>
            @endslot

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id  }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}">
                            {{ $user->fullname }}
                        </a>
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        @forelse($user->roles as $role)
                            <span class="label label-warning text-black">{{__('roles.' . $role->name)}}</span>
                        @empty
                            Ничего
                        @endforelse
                    </td>
                    <td>
                        {!! Form::model($user, ['method' => 'DELETE', 'route' => ['admin.users.destroy', $user], 'class' => 'form-inline']) !!}
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
