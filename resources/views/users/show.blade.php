<div class="row">
    <div class="form-group col-sm-12 required">
        {!! Form::label('name', 'Nome:') !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-12 required">
        {!! Form::label('email', 'E-mail:') !!}
        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6 required">
        {!! Form::label('role', 'Grupo:') !!}
        {!! Form::text('role', count($user->roles) > 0 ? $user->roles->first()->name : '', ['class' => 'form-control']) !!}
    </div>
</div>
<script>
    $(function() {
        $('input').attr('disabled', 'true');
    })
</script>
