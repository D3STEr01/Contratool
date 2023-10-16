<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, caso contrário, redirecione para a página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nova senha
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Por favor insira a nova senha.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validar e confirmar a senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
        
    // Verifique os erros de entrada antes de atualizar o banco de dados
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare uma declaração de atualização
        $sql = "UPDATE tbl_corretores SET password = :password WHERE id = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
            // Definir parâmetros
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Senha atualizada com sucesso. Destrua a sessão e redirecione para a página de login
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Fechar conexão
    unset($pdo);
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
    <link rel="stylesheet" href="css/senhaa.css">
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

        <h2>Redefinir senha</h2>
        <p>Por favor, preencha este formulário para redefinir sua senha.</p>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="textfield">
                    <label>Nova senha</label>
                    <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                    <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                </div>
                <div class="textfield">
                    <label>Confirme a senha</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="btn-torto">
                        <input type="submit" class="btn-login" value="Redefinir">
                </div>
                <div class="btn-torto1">
                        <a class="btn-senha" href="configuser.php" >Cancelar</a>
                </div>
 
        </form>
                


        </div>
    </div>
</div>








    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

        
