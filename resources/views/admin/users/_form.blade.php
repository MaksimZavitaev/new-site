@php
    /** @var \App\Models\User $user */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($user) ? 'Редактирование' : 'Создание' }} пользователя</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <h3>Данные</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Имя') !!}
                        {!! Form::text('name', null, [
                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                        'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::text('email', null, [
                        'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                        isset($user) ? 'disabled' : '']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('password', 'Пароль') !!}
                        {!! Form::password('password', [
                        'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                        'required' => !isset($user)]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Повторите пароль') !!}
                        {!! Form::password('password_confirmation', [
                        'class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : '')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Привилегии</h3>
            <div class="form-group">
                {!! Form::label('roles','Роли') !!}
                {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('name') : null, [
                'class' => 'form-control select2' . ($errors->has('name') ? ' is-invalid' : ''),
                'multiple']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('permissions','Права') !!}
                {!! Form::select('permissions[]', $permissions, isset($user) ? $user->permissions->pluck('name') : null, [
                'class' => 'form-control select2',
                'multiple']) !!}
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')
