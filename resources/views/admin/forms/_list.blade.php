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
                </tr>
            @endforeach
        @endcomponent
    </div>
</div>
