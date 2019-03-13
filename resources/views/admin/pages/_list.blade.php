@php
    $pid = Request::get('pid', 1);
@endphp

<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-body">
                    <div class="list-group list-group-unbordered">
                        @if ($pages->has('folders'))
                            @foreach($pages['folders']->sortBy('name') as $folder)
                                <a class="list-group-item clearfix"
                                   href="{{ route('admin.pages.index', ['pid' => $folder]) }}">
                                    <i class="fa fa-folder-o"></i>
                                    {{ $folder->name }}
                                    <object class="pull-right">
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{$folder->link}}"
                                               class="btn btn-primary" type="button" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.pages.create', ['pid' => $folder]) }}"
                                               class="btn btn-success" type="button">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="{{ route('admin.pages.edit', $folder) }}"
                                               class="btn btn-warning" type="button">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                    </object>
                                </a>
                            @endforeach
                        @else
                            Директорий не найдено
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-8">
            @component('admin.components.boxed_table',[
                'name' => 'Страницы',
                'items' => $pages['items'],
                'route' => route('admin.pages.create'),
                'creatable' => true,
                'searchable' => true
            ])
                @slot('header')
                    <tr>
                        <th>Имя</th>
                        <th>Создано</th>
                        <th>Обновлено</th>
                        <th>Состояние</th>
                        <th></th>
                    </tr>
                @endslot
                {{-- TODO: Create LevelUp Link --}}
                @foreach($pages['items']->sortBy('name') as $page)
                    @if($loop->first && Request::get('pid') && (int) Request::get('pid') !== 1)
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
                            <a href="{{ route('admin.pages.edit', $page) }}">
                                <i class="fa fa-file-text-o"></i>
                                {{ $page->name }}
                            </a>
                        </td>
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
                    </tr>
                @endforeach
            @endcomponent
        </div>
    </div>
</div>
