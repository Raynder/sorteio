<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <img src="imgs/components/bg2.png" alt="" class="confetes">

  <div class="circle"></div>
  <div class="sombra"></div>
  
  <div class="people" style="display: none;">
    <?php
      require_once 'api/dbconfig.php';
      $conn = connectDB();
      
      $sql = "SELECT * FROM colaboradores where sorteio1 = 1";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          $pessoas = array();
      
          while ($row = $result->fetch_assoc()) {
              $pessoas[] = $row;
              echo('<img src="imgs/'.$row['nome'].'.png"/>');
          }
      
      } else {
          $pessoas = array();
      }
      
      $conn->close();
    ?>
    <!-- Adicione mais divs de pessoas se necessário -->
  </div>
  
  <img id="sortearButton" src="imgs/components/button.png" alt="Sortear">
  <footer>
    Copyright &copy; <a style="text-decoration: none; color: grey;" href="https://github.com/Raynder"> Raynder Cardoso </a>
  </footer>


  <!-- Carregue a versão do Firebase compatível diretamente pelo script -->
  <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-database.js"></script>

  <script src="script.js"></script>
</body>
</html>
