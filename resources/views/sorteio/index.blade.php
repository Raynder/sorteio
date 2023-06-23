<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <img src="{{ asset('img/sorteio/components/bg2.png') }}" alt="" class="confetes">

  <div class="circle"></div>
  <div class="sombra"></div>

  <div class="people" style="display: none;">
    @foreach($pessoas as $pessoa)
      <img src='{{ asset("storage/".$pessoa->foto) }}'></img>
    @endforeach
    <!-- Adicione mais divs de pessoas se necessário -->
  </div>

  <div style="display:none;">
    @foreach($imagensUteis as $imagem)
      @php $caminho = "img/sorteio/".$imagem @endphp
      <img src='{{ asset($caminho) }}'></img>
    @endforeach
  </div>

  <img id="sortearButton" src="{{ asset('img/sorteio/components/button.png') }}" alt="Sortear">

  <script src="script.js"></script>
</body>

<style>
  .circle {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    margin: 0 auto;
    top: 35%;
    left: 43%;
    transform: translate(-56%, -50%);
    /* background-image: url(./img/components/logo.jpg); */
    background-image: url("img/sorteio/components/logo.jpg");
    background-size: cover;
    position: absolute;
    z-index: 999;
    box-shadow: 1px 1px 0 1px #0000ff00, -1px 0 28px 0 rgba(34, 33, 81, 0.01);
  }

  /* efeito */
  .circle {
    transform: rotateX(0deg) rotateZ(0deg);
    transform-style: preserve-3d;
    border-radius: 50%;
    transition: .750s ease-in-out transform, 0.4s ease-in-out box-shadow;

    &:hover {
      transform: translate3d(0px, -16px, 0px) rotateY(0deg) rotateZ(0deg);
    }
  }

  .sombra {
    left: 50%;
    border-radius: 50%;
    top: 58%;
    position: absolute;
    width: 130px;
    height: 30px;
    transform: translateX(-50%);
    transition: 0.750s;


    box-shadow: 0px 20px 0px 0px #f9f9fb00, 0px 0 20px 0 rgb(34 33 81 / 0%), 0px 80px 20px 0px rgb(0 0 0 / 20%);

    &:hover {
      transform: translate3d(0px, -16px, 0px) rotateX(51deg) rotateZ(43deg);
      box-shadow: 1px 1px 0 1px #f9f9fb, -1px 0 28px 0 rgba(34, 33, 81, 0.01),
        54px 54px 28px -10px rgba(34, 33, 81, 0.15);
    }
  }


  .people {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    position: absolute;
    bottom: 20px;
  }

  .person {
    margin: 0 10px;
  }

  .person img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    cursor: pointer;
  }

  body {
    background-image: url("img/sorteio/components/bg.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
  }

  #sortearButton {
    width: 200px;
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-56%);
    cursor: pointer;
  }

  img.confetes {
    position: fixed;
    top: -600%;
    transition: 5s;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var sortearButton = document.getElementById('sortearButton');

    sortearButton.addEventListener('click', function() {
      sortearButton.style.display = 'none';
      var circle = document.querySelector('.circle');
      contagemRegressiva()
    });
  });

  function parabenizarGanhador(interval) {
    var circle = document.querySelector('.circle');
    circle.style.transition = '1.5s'
    circle.style.width = '500px';
    circle.style.height = '500px';

    circle.style.transform = 'translate(-31%, -29%)'

    clearInterval(interval);

    confetes = document.querySelector(".confetes")
    confetes.style.top = '100%';
  }

  function contagemRegressiva() {
    var circle = document.querySelector('.circle');
    var totalTime = 5000;
    var intervalTime = 1000;
    var currentTime = 0;
    var contador = 5;

    cont = 0;
    var interval2 = setInterval(function() {
      var sombra = document.querySelector('.sombra');

      if (cont % 2 == 0) {
        circle.style.transform = 'translate3d(0px, -26px, 0px) rotateY(0deg) rotateZ(0deg)';
        sombra.style.width = '100px';
      } else {
        circle.style.transform = 'translate3d(0px, 0px, 0px) rotateY(0deg) rotateZ(0deg)';
        sombra.style.width = '130px';
      }
      cont++
    }, 750);

    var interval = setInterval(function() {
      if (currentTime >= totalTime) {
        clearInterval(interval);
        sortear(circle, interval2)
      } else {
        currentTime += intervalTime;
        circle.style.backgroundImage = 'url("img/sorteio/numbers/' + contador + '.png")';
        contador -= 1;
      }
    }, intervalTime);
  }

  function sortear(circle, interval2) {
    var divPessoas = document.querySelector('.people');
    var totalTime = 8000; // Tempo total em milissegundos
    var intervalTime = 100; // Tempo de intervalo em milissegundos
    var currentTime = 0; // Tempo atual

    // pegar todos os src de cada tag img dentro de divPessoas e colocar em um array de images
    var images = Array.from(divPessoas.querySelectorAll('img')).map(function(img) {
      return img.src
    });

    var interval = setInterval(function() {
      if (currentTime >= totalTime) {
        clearInterval(interval2)
        parabenizarGanhador(interval)
      } else {
        currentTime += intervalTime;
        var randomImage = images[Math.floor(Math.random() * images.length)];
        circle.style.backgroundImage = 'url(' + randomImage + ')';
      }
    }, intervalTime);
  }
</script>

</html>