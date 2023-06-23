@include('adminlte-templates::common.errors')
{!! Form::open([
    'route' => 'colaboradores.store',
    'id' => 'form',
    'component' => 'colaboradores',
    'autocomplete' => 'off',
]) !!}
<div class="row">
    @include('colaboradores.fields')
    <x-form-buttons :create="true" />
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
