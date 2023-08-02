var images = []

$(document).ready(function() {
  pegarColaboradores();
});

function pegarColaboradores() {
  $.ajax({
      url: 'api/listar_colaboradores.php?sorteio=1', 
      type: 'GET', 
      dataType: 'json', 
      success: function(colaboradores) {
          images = colaboradores.map(colaborador => colaborador.nome+'.png')
      },
      error: function(xhr, status, error) {
          console.log('Erro na requisição: ' + status);
      }
  });
}

const firebaseConfig = {
    apiKey: "AIzaSyBDwKkX5zbcGUcdGWntUdxJm1ktu3jaqkk",
    authDomain: "sorteio-8a397.firebaseapp.com",
    databaseURL: "https://sorteio-8a397-default-rtdb.firebaseio.com",
    projectId: "sorteio-8a397",
    storageBucket: "sorteio-8a397.appspot.com",
    messagingSenderId: "812969196677",
    appId: "1:812969196677:web:3e230c4499b3be30263dec"
};

const app = firebase.initializeApp(firebaseConfig);

const database = firebase.database();

function getUltimosGanhadores() {
  return database.ref().child('ultimosGanhadores').once('value')
    .then((snapshot) => {
      const ganhadores = snapshot.val();
      return ganhadores;
    })
    .catch((error) => {
      console.error('Erro ao obter os dados:', error);
      throw error; // Rejeita a Promise caso ocorra um erro
    });
}


var ganhadores = getUltimosGanhadores()
  .then((ganhadores) => {
    ganhadores.forEach((ganhador) => {
      const index = images.indexOf(ganhador.nome);
      if (index !== -1) {
        images.splice(index, 1);
      }
    });

    console.log(images); // Array de imagens sem os nomes dos ganhadores
  })
  .catch((error) => {
    console.error('Erro ao obter os ganhadores:', error);
  });

function guardarNome(nome) {
  const dataAtual = new Date().toLocaleDateString('pt-BR');
  const novoGanhador = { data: dataAtual, nome: nome };

  database.ref('ultimosGanhadores').once('value', (snapshot) => {
    const ganhadoresAntigos = snapshot.val() || [];

    if (ganhadoresAntigos.length >= 3) {
      ganhadoresAntigos.shift(); // Remove o ganhador mais antigo
    }

    ganhadoresAntigos.push(novoGanhador); // Adiciona o novo ganhador

    database.ref('ultimosGanhadores').set(ganhadoresAntigos, (error) => {
      if (error) {
        console.error('Erro ao salvar no banco de dados:', error);
      } else {
        console.log('Ganhador salvo com sucesso!');
      }
    });
  });
}

//Logica
document.addEventListener('DOMContentLoaded', function() {
  var sortearButton = document.getElementById('sortearButton');

  sortearButton.addEventListener('click', function() {
    sortearButton.style.display = 'none';
    var circle = document.querySelector('.circle');
    contagemRegressiva()
  });
});

function parabenizarGanhador(interval){
  var circle = document.querySelector('.circle');
  circle.style.transition = '1.5s'
  circle.style.width = '500px';
  circle.style.height = '500px';

  circle.style.transform = 'translate(-31%, -29%)'

  clearInterval(interval);
  
  confetes = document.querySelector(".confetes")
  confetes.style.top = '100%';
}

function contagemRegressiva(){
  var circle = document.querySelector('.circle');
  var totalTime = 5000;
  var intervalTime = 1000;
  var currentTime = 0;
  var contador = 5;
  
  cont = 0;
  var interval2 = setInterval(function() {
    var sombra = document.querySelector('.sombra');

    if(cont % 2 == 0){
      circle.style.transform = 'translate3d(0px, -26px, 0px) rotateY(0deg) rotateZ(0deg)';
      sombra.style.width = '100px';
    }
    else{
      circle.style.transform = 'translate3d(0px, 0px, 0px) rotateY(0deg) rotateZ(0deg)';
      sombra.style.width = '130px';
    }
    cont++
  },750);

  var interval = setInterval(function() {
    if (currentTime >= totalTime) {
      clearInterval(interval);
      sortear(circle, interval2)
    } else {
      currentTime += intervalTime;
      circle.style.backgroundImage = 'url("imgs/numbers/' + contador + '.png")';
      contador -= 1;
    }
  }, intervalTime);
}

function sortear(circle, interval2){
  var totalTime = 8000; // Tempo total em milissegundos
  var intervalTime = 100; // Tempo de intervalo em milissegundos
  var currentTime = 0; // Tempo atual
  var randomImage = '';

  var interval = setInterval(function() {
    if (currentTime >= totalTime) {
      clearInterval(interval2)
      parabenizarGanhador(interval)
      guardarNome(randomImage);
    } else {
      currentTime += intervalTime;
      randomImage = images[Math.floor(Math.random() * images.length)];
      circle.style.backgroundImage = "url('imgs/" + randomImage + "')";
    }
  }, intervalTime);
}
