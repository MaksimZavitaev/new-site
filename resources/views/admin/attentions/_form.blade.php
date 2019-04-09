@php
    /** @var \App\Models\Form $attention */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($attention) ? 'Редактирование' : 'Создание' }} уведомление</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                {!! Form::label('title', 'Заголовок') !!}
                {!! Form::text('title', null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::hidden('active', true) !!}
                {!! Form::checkbox('active', true, $attention->active ?? true, ['class' => 'flat-orange']) !!}
                {!! Form::label('active', 'Активность') !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                {!! Form::label('dates', 'Даты') !!}
                {!! Form::text('dates', null, [
                'id'    => 'dates',
                'class' => 'form-control' . ($errors->has('dates') ? ' is-invalid' : ''),
                'required']) !!}
                {!! Form::hidden('started_at', null, ['id' => 'started_at']) !!}
                {!! Form::hidden('ended_at', null, ['id' => 'ended_at']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="form-group">
                {!! Form::label('content', 'Содержимое') !!}
                {!! Form::textarea('content', null, [
                'id'    => 'content',
                'class' => 'form-control' . ($errors->has('content') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')

@push('scripts')
    <script>
        //Date range picker with time picker
        $('#dates').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'DD/MM/YYYY h:mm A',
            locale: {
                format: 'DD/MM/YYYY HH:mm',
            },
        }, function (start, end) {
            $('#started_at').val(start.format('YYYY-MM-DD HH:mm'));
            $('#ended_at').val(end.format('YYYY-MM-DD HH:mm'));
        });
    </script>
@endpush
