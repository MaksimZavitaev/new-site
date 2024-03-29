@php
    /** @var \App\Models\Application $application */
@endphp
<div class="col-xs-12">
    @component('admin.components.boxed_table', ['name' => 'Заявки', 'route' => route('admin.applications.create')])
        @slot('header')
            <th></th>
            <th>ID</th>
            <th>Название страницы</th>
            <th>Название формы</th>
            <th>Создано</th>
        @endslot

        @foreach($applications as $application)
            <tr>
                <td style="text-align: center; width: 10px;">
                    <a href="{{ route('admin.applications.show', $application) }}">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
                <td>{{ $application->id  }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $application->page) }}">
                        {{ $application->page->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.forms.edit', $application->form) }}">
                        {{ $application->form->name }}
                    </a>
                </td>
                <td>{{ $application->created_at }}</td>
            </tr>
        @endforeach
    @endcomponent
</div>
