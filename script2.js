var images = []

$(document).ready(function() {
  pegarColaboradores();
});

function pegarColaboradores() {
  $.ajax({
      url: 'api/listar_colaboradores.php', 
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
    } else {
      currentTime += intervalTime;
      randomImage = images[Math.floor(Math.random() * images.length)];
      circle.style.backgroundImage = "url('imgs/" + randomImage + "')";
    }
  }, intervalTime);
}
