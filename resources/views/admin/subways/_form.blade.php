@php
    /** @var \App\Models\Subway $subway */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($subway) ? 'Редактирование' : 'Создание' }} станции метро</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('station', 'Название станции') !!}
                        {!! Form::text('station', null, [
                        'class' => 'form-control' . ($errors->has('station') ? ' is-invalid' : ''),
                        'required']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('line','Линия') !!}
                        {!! Form::select('line', $lines, isset($subway) ? $subway->line : null, [
                        'class' => 'form-control select2' . ($errors->has('line') ? ' is-invalid' : '')]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')
