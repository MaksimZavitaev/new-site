<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Пользователи', 'creatable' =>true, 'route' => route('admin.users.create')])
            @slot('header')
                <th style="width: 10px">ID</th>
                <th>Пользватель</th>
                <th>Создан</th>
                <th>Роли</th>
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
                    {{--<td>
                        <a href="{{ route('admin.users.destroy', $user) }}"><i class="fa fa-trash-o text-danger"></i></a>
                    </td>--}}
                </tr>
            @endforeach
        @endcomponent
        <!-- /.box -->
    </div>
</div>
