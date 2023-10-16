<?php
// Incluir arquivo de configuração
require_once "config.php";

// Defina variáveis e inicialize com valores vazios
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar nome de usuário
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor coloque um nome de usuário.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM tbl_corretores WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Definir parâmetros
            $param_username = trim($_POST["username"]);

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "Este nome de usuário já está em uso.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }

    // Validar senha
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor insira uma senha.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar e confirmar a senha
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme a senha.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "A senha não confere.";
        }
    }

    // Verifique os erros de entrada antes de inserir no banco de dados
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare uma declaração de inserção
        $sql = "INSERT INTO tbl_corretores (username, password) VALUES (:username, :password)";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Definir parâmetros
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                // Redirecionar para a página de login
                header("location: login.php");
            } else {
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
    <link rel="stylesheet" href="css/regilogin.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    </script>
    <link rel="shortcut icon" href="jorge.ico">
</head>

<body>

    <div class="main-login">
        <div class="left-login">
            <h1>Video demonstrativo:</h1>
            <iframe src="https://www.youtube.com/embed/wVAIM9p0j_k" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        <div id="linha-vertical"></div>
        <div class="right-login">
            <div class="card-login">
                <img src="img/SASAS.png" alt="">
                <!--<h3>Login</h3>--->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="textfield">
                        <label>Nome do usuário</label>
                        <input type="text" name="username"
                            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>">
                        <span class="invalid-feedback">
                            <?php echo $username_err; ?>
                        </span>
                    </div>
                    <div class="textfield">
                        <label>Senha</label>
                        <input type="password" name="password"
                            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $password; ?>">
                        <span class="invalid-feedback">
                            <?php echo $password_err; ?>
                        </span>
                    </div>
                    <div class="textfield">
                        <label>Confirme a senha</label>
                        <input type="password" name="confirm_password"
                            class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback">
                            <?php echo $confirm_password_err; ?>
                        </span>
                    </div>

                    <input type="submit" class="btn-senha" value="Criar Conta">

                </form>
                <a class="a" href="login.php">Já possuo uma conta</a>
            </div>
        </div>
    </div>








    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>