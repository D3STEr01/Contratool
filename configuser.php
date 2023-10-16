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
<!--------------------------------SANDRO HENRIQUE DE AMORIM SILVA GUEDES 2111269--------------------->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/config.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    </script>
    <link rel="shortcut icon" href="jorge.ico" > 
</head>

<body>

<div class="main-login">
    <div class="left-login">
 
        <img src="img/forgot-password-animate.svg" alt="">

    </div>
    <div id="linha-vertical"></div>
    <div class="right-login">
        <div class="card-login">
            <img src="img/SASAS.png" alt="">

            <h3 class="my-5">User: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h3>

        <div>
        <div>
            <a class="btn-senha" href="reset-password.php" >Resetar senha</a></div>
        <div>
             <a class="btn-senha" href="logout.php" >Logout</a></div>
        </div>
        <a class="a" href="index.php">Voltar para página principal</a>

                
                


        </div>
    </div>
</div>








    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>