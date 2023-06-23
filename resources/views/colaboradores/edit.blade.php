@include('adminlte-templates::common.errors')
{!! Form::model($colaborador, [
    'route' => ['colaboradores.update', $colaborador->id],
    'id' => 'form',
    'component' => 'colaboradores',
    'autocomplete' => 'off',
    'method' => 'patch',
]) !!}
<div class="row">
    @include('colaboradores.fields')
    <x-form-buttons :create="false" />
</div>
{!! Form::close() !!}
<script>
    $(function() {
        $("#form").submit(function(e) {
            Ajax.salvarRegistroComArquivo($(this));
            e.preventDefault();
        });
    });
</script>
