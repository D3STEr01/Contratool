<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Verifique se o nome de usuário está vazio
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verifique se a senha está vazia
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciais
    if(empty($username_err) && empty($password_err)){
        // Prepare uma declaração selecionada
        $sql = "SELECT id, username, password FROM tbl_corretores WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_username = trim($_POST["username"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Verifique se o nome de usuário existe, se sim, verifique a senha
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // A senha está correta, então inicie uma nova sessão
                            session_start();
                            
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirecionar o usuário para a página de boas-vindas
                            header("location: index.php");
                        } else{
                            // A senha não é válida, exibe uma mensagem de erro genérica
                            $login_err = "Nome de usuário ou senha inválidos.";
                        }
                    }
                } else{
                    // O nome de usuário não existe, exibe uma mensagem de erro genérica
                    $login_err = "Nome de usuário ou senha inválidos.";
                }
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
    <link rel="stylesheet" href="css/loginn.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    </script>
    <link rel="shortcut icon" href="jorge.ico" > 
</head>

<body>

<div class="main-login">
    <div class="left-login">
        <h1>Video demonstrativo:</h1>
            <iframe src="https://www.youtube.com/embed/wVAIM9p0j_k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             
    </div>
    <div id="linha-vertical"></div>
    <div class="right-login">
        <div class="card-login">
            <img src="img/SASAS.png" alt="">
            <!--<h3>Login</h3>--->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="textfield">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="textfield">
                <label>Senha</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

                    <input type="submit" class="btn-login" value="Entrar">




        </form>
            <a class="a" href="register.php">Não possuo uma conta</a> 
        </div>
    </div>
</div>



    
<script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>