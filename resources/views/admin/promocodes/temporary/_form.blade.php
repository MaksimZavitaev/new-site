@php
    /** @var \App\Models\Promocode $promocode */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($promocode) ? 'Редактирование' : 'Создание' }} промокода</h3>
</div>
<div class="box-body">
    <div class="form-group">
        {!! Form::checkbox('active', true, !isset($promocode) ?: $promocode->active, ['class' => 'flat-orange']) !!}
        {!! Form::label('active', 'Активен') !!}
    </div>
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
                @if($parents->count())
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('promocode_id', 'Родитель') !!}
                            {!! Form::select('promocode_id', $parents, isset($promocode) ? $promocode->parent->id : null, [
                            'class' => 'form-control select2' . ($errors->has('promocode_id') ? ' is-invalid' : ''),
                            'placeholder' => 'Выберите родителя',
                            'required']) !!}
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('dates', 'Срок действия') !!}
                        {!! Form::text('dates', isset($promocode) ? "{$promocode->started_at} - {$promocode->ended_at}" : null, [
                        'id'    => 'dates',
                        'class' => 'form-control' . ($errors->has('dates') ? ' is-invalid' : ''),
                        'required']) !!}
                        {!! Form::hidden('started_at', isset($promocode) ? $promocode->started_at->format('Y-m-d h:i:s') : null, ['id' => 'started_at']) !!}
                        {!! Form::hidden('ended_at', isset($promocode) ? $promocode->ended_at->format('Y-m-d h:i:s') : null, ['id' => 'ended_at']) !!}
                    </div>
                </div>
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
            $('#started_at').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#ended_at').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });
    </script>
@endpush

