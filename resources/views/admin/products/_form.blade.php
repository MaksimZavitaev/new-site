@php
    /** @var \App\Models\Product $product */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($product) ? 'Редактирование' : 'Создание' }} продукта</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('name', 'Имя') !!}
                        {!! Form::text('name', null, [
                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                        'required']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('code', 'Код') !!}
                        {!! Form::text('code', null, [
                        'class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''),
                        'required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                @if($types->count())
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('product_type_id', 'Тип продукта') !!}
                            {!! Form::select('product_type_id', $types, isset($product) ? $product->type->id : null, [
                            'class' => 'form-control select2' . ($errors->has('product_type_id') ? ' is-invalid' : ''),
                            'placeholder' => 'Выберите тип продукта',
                            'required']) !!}
                        </div>
                    </div>
                @endif
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('diasoft_id', 'Diasoft ID') !!}
                        {!! Form::text('diasoft_id', null, [
                        'class' => 'form-control' . ($errors->has('diasoft_id') ? ' is-invalid' : ''),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')
