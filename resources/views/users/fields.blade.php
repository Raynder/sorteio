<div class="form-group col-sm-12 required">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group @if (isset($user) && $user->id == null) col-sm-8 @else col-sm-12 @endif  required">
    {!! Form::label('email', 'E-mail:') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
</div>
@if (!isset($user))
    <div class="form-group col-sm-4 required">
        {!! Form::label('password', 'Senha:') !!}
        {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
    </div>
@endif
<div class="form-group col-md-12 required">
    {!! Form::label('role_id', 'Grupo de permissões:') !!}
    <select style="width:100%;" class="form-control" id="role_id" required name="role_id">
        <option value="">Informe o grupo de permissões</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ isset($isRoleSelected) && $isRoleSelected($role) }}>{{ $role->name }}
            </option>
        @endforeach
    </select>
</div>