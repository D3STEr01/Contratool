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
  <title>Contratool</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript">
  </script>
  <link rel="shortcut icon" href="jorge.ico">
</head>

<body>
  <!-- The sidebar -->
  <div class="sidebar">
    <img src="img/SASAS.png" alt="">
    <br>
    <br>
    <hr>
    <a  href="imovel.html">Imóveis</a>
    <a  href="index.php">Clientes</a>
    <a class="nav-link disabled" href="contrato.html">Contratos</a>
    <hr>
    <a href="rimoveis.php">+ Registrar Imóvel</a>
    <a href="rcontratos.php">+ Registrar Contrato</a>
    <a href="rcliente.php">+ Registrar Cliente</a>
    <hr>
    <a href="somos.html">Quem somos?</a>
    <hr>
    <a href="configuser.php">Configuração</a>
  </div>

  <!--b(knR@n#ORf1aAELGTMG Page content -->
  <div class="content">
    <div class="card-login">
      <div class="topo">

        <h3>Clientes
          <i class="fa fa-users"> </i>
        </h3>
        <h5>
          <a href="rcontratos.php" class="btn btn-primary btn-xs">
            <i class="fa fa-user-plus"></i>
          </a>
        </h5>
      </div>

      <table class="table ">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Cpf</th>
            <th scope="col">E-mail</th>
            <th scope="col">Telefone</th>
            <th scope="col">Endereço</th>
            <th scope="col">--------</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th class="rows">


              <?php
              $result_msg_cont = "SELECT * FROM tbl_contratos ORDER BY ctt_id DESC";

              //Seleciona os registros
              $resultado_msg_cont = $pdo->prepare($result_msg_cont);
              $resultado_msg_cont->execute();
              while ($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)) {
                echo "<br><br>" . $row_msg_cont['ctt_contrato'] . "<a href='rclienteperfil.php' class='ml-5 '> Olhar
              </a>";
              }
              ?>


              </th>

          </tr>
        </tbody>
      </table>


    </div>
  </div>




  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>