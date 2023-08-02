'use strict'

const openModal = () => document.getElementById('modal')
    .classList.add('active')

const closeModal = () => {
    document.getElementById('modal').classList.remove('active')
    location.reload()
}

document.getElementById('cadastrarColaborador')
    .addEventListener('click', openModal)

document.getElementById('modalClose')
    .addEventListener('click', closeModal)

function saveColaborador() {
    const nome = document.querySelector('.modal-field:nth-child(1)').value;
    const email = document.querySelector('.modal-field:nth-child(2)').value;
    const sorteio1 = document.querySelector('#sorteio1').checked;
    const sorteio2 = document.querySelector('#sorteio2').checked;
    const sorteio3 = document.querySelector('#sorteio3').checked;
    const arquivo = document.querySelector('#arquivo').files[0];

    const formData = new FormData();
    formData.append('nome', nome);
    formData.append('email', email);
    formData.append('sorteio1', sorteio1);
    formData.append('sorteio2', sorteio2);
    formData.append('sorteio3', sorteio3);
    formData.append('arquivo', arquivo);

    $.ajax({
        url: 'api/salvar_colaborador.php', 
        type: 'POST', 
        processData: false,
        contentType: false,
        data: formData, 
        success: function(response) {
            console.log('Colaborador cadastrado com sucesso!');
            closeModal(); 
        },
        error: function(xhr, status, error) {
            console.log('Erro ao cadastrar colaborador: ' + status);
        }
    });
}

document.querySelector('.modal-footer .button.green').addEventListener('click', saveColaborador);

function listColaboradores() {
    $.ajax({
        url: 'api/listar_colaboradores.php', 
        type: 'GET', 
        dataType: 'json', 
        success: function(colaboradores) {
            $('#lista').empty();
            
            colaboradores.forEach(function(colaborador) {
                $('#lista').append(`
                    <tr>
                        <td>${colaborador.nome}</td>
                        <td>${colaborador.email}</td>
                        <td>
                            <button type="button" onclick="modalEditar(${colaborador.id})" class="button green">editar</button>
                            <button type="button" onclick="deletarClick(${colaborador.id})" class="button red">excluir</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(xhr, status, error) {
            console.log('Erro na requisição: ' + status);
        }
    });
}

$(document).ready(function() {
    listColaboradores();
});

function modalEditar(id) {
    $.ajax({
        url: 'api/obter_colaborador.php',
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(colaborador) {
            document.querySelector('.modal-field:nth-child(1)').value = colaborador.nome;
            document.querySelector('.modal-field:nth-child(2)').value = colaborador.email;
            document.querySelector('#sorteio1').checked = colaborador.sorteio1 == 1 ? true: false;
            document.querySelector('#sorteio2').checked = colaborador.sorteio2 == 1 ? true: false;
            document.querySelector('#sorteio3').checked = colaborador.sorteio3 == 1 ? true: false;

            document.querySelector('.modal-footer .button.green').removeEventListener('click', saveColaborador);
            document.querySelector('.modal-footer .button.green').addEventListener('click', function() {
                editarColaborador(id);
            });

        
            openModal();
        },
        error: function(xhr, status, error) {
        
            console.log('Erro na requisição: ' + status);
        }
    });
}

function editarColaborador(id) {
    const nome = document.querySelector('.modal-field:nth-child(1)').value;
    const email = document.querySelector('.modal-field:nth-child(2)').value;
    const sorteio1 = document.querySelector('#sorteio1').checked;
    const sorteio2 = document.querySelector('#sorteio2').checked;
    const sorteio3 = document.querySelector('#sorteio3').checked;
    const arquivo = document.querySelector('#arquivo').files[0];

    const formData = {
        id: id,
        nome: nome,
        email: email,
        sorteio1: sorteio1,
        sorteio2: sorteio2,
        sorteio3: sorteio3,
        arquivo: arquivo
    };
    
    $.ajax({
        url: 'api/editar_colaborador.php', 
        type: 'POST', 
        dataType: 'json', 
        data: formData, 
        success: function(response) {      
            console.log('Colaborador editado com sucesso!');
            closeModal(); 
            listColaboradores(); 
        },
        error: function(xhr, status, error) {
            console.log('Erro ao editar colaborador: ' + status);
        }
    });
}

function deletarColaborador(id) {
    $.ajax({
        url: 'api/deletar_colaborador.php', 
        type: 'POST', 
        dataType: 'json', 
        data: { id: id }, 
        success: function(response) {
            console.log('Colaborador excluído com sucesso!');
            listColaboradores(); 
        },
        error: function(xhr, status, error) {
            console.log('Erro ao excluir colaborador: ' + status);
        }
    });
}

function deletarClick(id) {
    if (confirm("Tem certeza que deseja excluir este colaborador?")) {
        deletarColaborador(id);
    }
}

function updateColaborador(id) {
    const nome = document.querySelector('.modal-field:nth-child(1)').value;
    const email = document.querySelector('.modal-field:nth-child(2)').value;
    const sorteio1 = document.querySelector('#sorteio1').value;
    const sorteio2 = document.querySelector('#sorteio2').value;
    const sorteio3 = document.querySelector('#sorteio3').value;

    const formData = {
        id: id,
        nome: nome,
        email: email,
        sorteio1: sorteio1,
        sorteio2: sorteio2,
        sorteio3: sorteio3
    };

    $.ajax({
        url: 'api/update_colaborador.php',
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(response) {
            console.log('Colaborador atualizado com sucesso!');
            closeModal();
            listColaboradores();
        },
        error: function(xhr, status, error) {
            console.log('Erro ao atualizar colaborador: ' + status);
        }
    });
}
