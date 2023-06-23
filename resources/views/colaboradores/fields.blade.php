<div class="row">
    <div class="form-group col-sm-5 require">
        {!! Form::label('nome', 'Colaborador:') !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'maxlength' => 150]) !!}
    </div>

    <div class="form-group col-sm-7 required">
        {!! Form::label('foto', 'Foto:') !!}
        <input type="file" name="foto" id="foto" class="form-control" multiple />
    </div>
</div>

<div class="row">
    
</div>