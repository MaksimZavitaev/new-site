<div class="box-body">
    <div class="row">
        @if(isset($page) && $page->parent)
            {!! Form::hidden('path', rtrim($page->parent->link, '/') . '/' . $page->slug) !!}
        @endif
        <div class="col-md-6">
            <h3>Данные</h3>
            <div class="form-group">
                {!! Form::label('name', 'Имя') !!}
                {!! Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => 'Show in dashboard',
                'required']) !!}
            </div>
            @if(!isset($page) || !$page->isHome())
                <div class="form-group">
                    {!! Form::label('slug', 'Ссылка') !!}
                    {!! Form::text('slug', null, [
                    'class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''),
                    'placeholder' => 'Символьный код',
                    'required']) !!}
                </div>
                @if($pages->count())
                    <div class="form-group">
                        {!! Form::label('parent_id', 'Родитель') !!}
                        {!! Form::select('parent_id', $pages, (isset($page) && $page->parent !== null) ? $page->parent->id : $pid,[
                        'class' => 'form-control select2' . ($errors->has('parent_id') ? ' is-invalid' : '')]) !!}
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::checkbox('active', true, $page->active ?? true, ['class' => 'flat-orange']) !!}
                    {!! Form::label('active', 'Страница является активной') !!}
                </div>
            @else
                {!! Form::hidden('active', true) !!}
            @endif
        </div>
        <div class="col-md-6">
            <h3>SEO</h3>
            <div class="form-group">
                {!! Form::label('seo[title]', 'Title') !!}
                {!! Form::text('seo[title]', null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('seo[keywords]', 'Keywords') !!}
                {!! Form::text('seo[keywords]', null, [
                'class' => 'form-control' . ($errors->has('seo[keywords]') ? ' is-invalid' : ''),
                'placeholder' => 'Укажите через запятую',
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('seo[description]', 'Description') !!}
                {!! Form::textarea('seo[description]', null, [
                'rows' => 2,
                'class' => 'form-control' . ($errors->has('seo[description]') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('seo[h1]', 'H1') !!}
                {!! Form::text('seo[h1]', null, [
                'class' => 'form-control' . ($errors->has('seo[h1]') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('seo[alt]', 'Alt (по умолчанию)') !!}
                {!! Form::text('seo[alt]', null, [
                'class' => 'form-control' . ($errors->has('seo[alt]') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <h3>Хлебные крошки
                <small>не менять для стандартного поведения</small>
            </h3>
            @if(isset($page))
                <breadcrumbs-list items="{{ json_encode($page['breadcrumbs']) }}"></breadcrumbs-list>
            @else
                <breadcrumbs-list></breadcrumbs-list>
            @endif
        </div>
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')

@push('scripts')
    <script>
        $slug = $('#slug');
        $('#name').change(function (e) {
            if (!$slug.val()) {
                $slug.val(slugify($(this).val().toLowerCase()))
            }
        });
    </script>
@endpush
