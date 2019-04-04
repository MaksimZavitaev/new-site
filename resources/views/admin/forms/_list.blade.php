@php
    /** @var \App\Models\Form $form */
@endphp
<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', ['name' => 'Формы', 'creatable' =>true, 'route' => route('admin.forms.create')])
            @slot('header')
                <th>ID</th>
                <th>Название</th>
                <th>Создано</th>
                <th style="width: 10px"></th>
            @endslot

            @foreach($forms as $form)
                <tr>
                    <td>{{ $form->id  }}</td>
                    <td>
                        <a href="{{ route('admin.forms.edit', $form) }}">
                            {{ $form->name }}
                        </a>
                    </td>
                    <td>{{ $form->created_at }}</td>
                    <td>
                        {!! Form::model($form, ['method' => 'DELETE', 'route' => ['admin.forms.destroy', $form], 'class' => 'form-inline']) !!}
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
