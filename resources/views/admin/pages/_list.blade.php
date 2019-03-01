@php
    $pid = Request::get('pid', 1);
@endphp

<div class="col-md-12">
    @component('admin.components.boxed_table',[
        'name' => 'Страницы',
        'items' => $pages,
        'route' => route('admin.pages.create'),
        'creatable' => true,
        'searchable' => true
    ])
        @slot('header')
            <tr>
                <th>Имя</th>
                <th>Заголовок</th>
                <th>Создано</th>
                <th>Обновлено</th>
                <th>Состояние</th>
                <th></th>
            </tr>
        @endslot
        @forelse($pages->sortByDesc(['name', 'childs_count']) as $page)
            @if($page->parent && $loop->first)
                <tr>
                    <td>
                        <a href="{{ route('admin.pages.index', ['pid' => $page->parent->parent_id]) }}">
                            <i class="fa fa-level-up"></i>
                            Вверх
                        </a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
            <tr>
                <td>
                    <div class="btn-group btn-group-xs">
                        <a href="{{$page->link}}"
                           class="btn btn-primary" type="button" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.pages.create', ['pid' => $page]) }}"
                           class="btn btn-success" type="button">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="{{ route('admin.pages.edit', $page) }}"
                           class="btn btn-warning" type="button">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </div>

                    @if($page->childs_count)
                        <a href="{{ route('admin.pages.index', ['pid' => $page]) }}">
                            <i class="fa fa-folder-o"></i>
                            {{ $page->name }}
                        </a>
                    @else
                        <a href="{{ route('admin.pages.edit', $page) }}">
                            <i class="fa fa-file-text-o"></i>
                            {{ $page->name }}
                        </a>
                    @endif
                </td>
                @if(!$page->childs_count)
                    <td>{{ $page->seo['title'] }}</td>
                    <td>{{ $page->created_at }}</td>
                    <td>{{ $page->updated_at }}</td>
                    <td>
                        <span class="label label-warning text-black">{{ $page->status }}</span>
                    </td>
                    <td>
                        @if(!$page->isHome() && !$page->trashed())
                            {!! Form::model($page, ['method' => 'DELETE', 'route' => ['admin.pages.destroy', $page], 'class' => 'form-inline', 'data-confirm' => 'Удалить?']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',
                            [
                                'onclick' => 'if (!confirm("Вы уверены?")) { return false }',
                                'class' => 'btn btn-xs btn-danger',
                                'name' => 'submit',
                                'type' => 'submit'
                            ]) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                @endif
            </tr>
        @empty
            <h4>Данных не найдено</h4>
        @endforelse
    @endcomponent
</div>
