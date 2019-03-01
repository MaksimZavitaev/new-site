<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">{{$name}}</h3>

        <div class="box-tools">
            @if(isset($creatable) && $creatable)
                <a href="{{$route}}" class="btn btn-sm btn-primary pull-right" type="button">Создать</a>
            @endif
            @if(isset($searchable) && $searchable)
                {!! Form::open(['route' => ['admin.pages.index'], 'method' =>'GET', 'class'=> 'pull-right']) !!}
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="s" class="form-control pull-right" value="{{ request()->get('s') }}"
                           placeholder="Поиск">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <tr>{{$header}}</tr>

                {{$slot}}
            </table>
        </div>
    </div>
    @if(isset($items) && $items instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="box-footer">
            {{ $items->links() }}
        </div>
    @endif
</div>
