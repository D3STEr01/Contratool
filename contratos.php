<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <!-- The sidebar -->
<div class="sidebar">
  <img src="img/SASAS.png" alt="">
  <br>
  <br>
  <hr>
  <a href="imovel.html">Imóveis</a>
  <a href="cliente.html">Clientes</a>
  <a href="contrato.html">Contratos</a>
  <hr>
  <a href="#news">+ Registrar Imóvel</a>
  <a href="#contact">+ Registrar Contrato</a>
  <a href="#about">+ Registrar Cliente</a>
  <hr>
  <a href="configuser.php">Configuração</a>
</div>

<!-- Page content -->
<div class="content">
    <div class="background">
        <div class="card-login">
                <h3>Clientes</h3> 
                <div class="table">
                    <table>
                        <tr>
                            <th>Nome</th>
                            <th>AAAA</th>
                            <th>finalidade</th>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                            <td>AAAAA</td>
                            <td>aluguel</td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                            <td>AAAAA</td>
                            <td>aluguel</td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                            <td>AAAAA</td>
                            <td>aluguel</td>
                        </tr>
                    </table>  
                </div> 
                
        </div>
    </div>
</div>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>