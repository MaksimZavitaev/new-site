@php
    /** @var \App\Models\Form $form */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($form) ? 'Редактирование' : 'Создание' }} формы</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                {!! Form::label('name', 'Имя') !!}
                {!! Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
        {{--<div class="col-md-4 col-sm-6">
            <div class="form-group">
                {!! Form::label('product_id', 'Тип продукта') !!}
                {!! Form::select('product_id', $products, isset($form) ? $form->product->id : null, [
                'class' => 'form-control select2' . ($errors->has('product_id') ? ' is-invalid' : ''),
                'placeholder' => 'Выберите тип продукта',
                'required']) !!}
            </div>
        </div>--}}
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')
