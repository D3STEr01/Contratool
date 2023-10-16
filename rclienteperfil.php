<?php
// Inicialize a sessão
include_once 'config.php';
session_start();

// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<!--------------------------------SANDRO HENRIQUE DE AMORIM SILVA GUEDES --------------------->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/rrperfil.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<body>
  <!-- The sidebar -->
  <div class="sidebar">
    <img src="img/SASAS.png" alt="">
    <br>
    <br>
    <hr>
    <a href="imovel.html">Imóveis</a>
    <a class="nav-link disabled" href="cliente.html">Clientes</a>
    <a href="contrato.html">Contratos</a>
    <hr>
    <a href="rimoveis.php">+ Registrar Imóvel</a>
    <a href="rcontratos.php">+ Registrar Contrato</a>
    <a href="rcliente.php">+ Registrar Cliente</a>
    <hr>
    <a href="configuser.php">Configuração</a>
  </div>

  <!-- Page content -->
  <div class="content">
    <div class="card-login">

      <p class="my-5"> <b>
          <?php $result_msg_cont = "SELECT cli_id, cli_nome, cli_cpf, cli_email, cli_telefone, cli_endereco FROM tbl_clientes WHERE cli_id = '1'";

                    //Seleciona os registros
                    $resultado_msg_cont = $pdo->prepare($result_msg_cont);
                    $resultado_msg_cont->execute();
                    while ($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)) {
                      echo "Id do cliente: " . $row_msg_cont['cli_id'] . "<br><br>";
                      echo "Nome: " . $row_msg_cont['cli_nome'] . "<br><br>";
                      echo "Cpf: " . $row_msg_cont['cli_cpf'] . "<br><br>";
                      echo "E-mail: " . $row_msg_cont['cli_email'] . "<br><br>";
                    } ?>
        </b>
      </p>
      <p class="my-5"> <b>
          <?php $result_msg_cont = "SELECT ctt_contrato FROM tbl_contratos WHERE ctt_id = '1'";

                    //Seleciona os registros
                    $resultado_msg_cont = $pdo->prepare($result_msg_cont);
                    $resultado_msg_cont->execute();
                    while ($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)) {
                      echo "<h6>contratos vinculados ao cliente:</h6> <br>" . $row_msg_cont['ctt_contrato'] . "<br><br>";

                    } ?>
        </b>
      </p>
      <div id="linha-vertical"></div>

      <a class="a" href="index.php">Voltar para página principal</a>
    </div>

  </div>




  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>