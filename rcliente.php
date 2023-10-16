<?php
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$cli_nome = $cli_cpf = $cli_email = $cli_telefone = $cli_endereco = "";
$cli_nome_err = $cli_cpf_err = $cli_email_err = $cli_telefone_err =  $cli_endereco_err ="";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nome de usuário
    if(empty(trim($_POST["cli_nome"]))){
        $cli_nome_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_.@ ]+$/', trim($_POST["cli_nome"]))){
        $cli_nome_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT cli_id FROM tbl_clientes WHERE cli_nome = :cli_nome";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":cli_nome", $param_cli_nome, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_cli_nome = trim($_POST["cli_nome"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $cli_nome_err = "Este nome de usuário já está em uso.";
                } else{
                    $cli_nome = trim($_POST["cli_nome"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

        }
    }
    
    if(empty(trim($_POST["cli_endereco"]))){
        $cli_endereco_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_@.°,  ]+$/', trim($_POST["cli_endereco"]))){
        $cli_endereco_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT cli_id FROM tbl_clientes WHERE cli_endereco = :cli_endereco";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":cli_endereco", $param_cli_endereco, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_cli_endereco = trim($_POST["cli_endereco"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $cli_endereco_err = "este endereco já está em uso";
                } else{
                    $cli_endereco = trim($_POST["cli_endereco"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

        }
    }
    if(empty(trim($_POST["cli_email"]))){
        $cli_email_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_@.]+$/', trim($_POST["cli_email"]))){
        $cli_email_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT cli_id FROM tbl_clientes WHERE cli_email = :cli_email";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":cli_email", $param_cli_email, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_cli_email = trim($_POST["cli_email"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $cli_email_err = "Este e-mail já está em uso.";
                } else{
                    $cli_email = trim($_POST["cli_email"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

        }
    }
    
    // Validar senha
    if(empty(trim($_POST["cli_cpf"]))){
        $cli_cpf_err = "Por favor insira um cpf.";     
    } elseif(strlen(trim($_POST["cli_cpf"])) < 6){
        $cli_cpf_err = "O cpf deve ser válido";
    } else{
        $cli_cpf = trim($_POST["cli_cpf"]);
    }



    if(empty(trim($_POST["cli_telefone"]))){
        $cli_telefonef_err = "Por favor insira um telefone.";     
    } elseif(strlen(trim($_POST["cli_telefone"])) < 8){
        $cli_telefone_err = "você deve colocar um telefone valido.";
    } else{
        $cli_telefone = trim($_POST["cli_telefone"]);
    }

    

    
    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($cli_nome_err) && empty($cli_cpf_err) && empty($cli_email_err) && empty($cli_telefone_err) && empty($cli_endereco_err)){
        
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO tbl_clientes (cli_nome, cli_cpf, cli_email, cli_telefone, cli_endereco) VALUES (:cli_nome, :cli_cpf, :cli_email, :cli_telefone, :cli_endereco)";
         
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":cli_nome", $param_cli_nome, PDO::PARAM_STR);
            $stmt->bindParam(":cli_cpf", $param_cli_cpf, PDO::PARAM_STR);
            $stmt->bindParam(":cli_email", $param_cli_email, PDO::PARAM_STR);
            $stmt->bindParam(":cli_telefone", $param_cli_telefone, PDO::PARAM_STR);
            $stmt->bindParam(":cli_endereco", $param_cli_endereco, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_cli_nome = $cli_nome;
            $param_cli_cpf = $cli_cpf;
            $param_cli_email = $cli_email;
            $param_cli_telefone = $cli_telefone;
            $param_cli_endereco = $cli_endereco;
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Redirecionar para a página de login
                header("location: index.php");
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
<!--------------------------------SANDRO HENRIQUE DE AMORIM SILVA GUEDES --------------------->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/rcliente.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    </script>
    <link rel="shortcut icon" href="jorge.ico" > 
</head>

<body>
    <!-- The sidebar -->
<div class="sidebar">
  <img src="img/SASAS.png" alt="">
  <br>
  <br>
  <hr>
  <a href="#">Imóveis</a>
  <a href="index.php">Clientes</a>
  <a href="imovel.php">Contratos</a>
  <hr>
  <a href="rimoveis.php">+ Registrar Imóvel</a>
  <a href="rcontratos.php">+ Registrar Contrato</a>
  <a class="nav-link disabled" href="#about">+ Registrar Cliente</a>
  <hr>
  <a href="configuser.php">Configuração</a>
</div>

<!-- Page content -->
<div class="content">
        <div class="card-login">
           <h3>Registro de clientes</h3>
           
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="textfield">
                <label>Nome: </label>
                <input type="text" name="cli_nome" class="form-control <?php echo (!empty($cli_nome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cli_nome; ?>">
                <span class="invalid-feedback"><?php echo $cli_nome_err; ?></span>
            </div>    
            <div class="textfield">
                <label>Cpf: </label>
                <input type="text" name="cli_cpf" class="form-control <?php echo (!empty($cli_cpf_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cli_cpf; ?>">
                <span class="invalid-feedback"><?php echo $cli_cpf_err; ?></span>
            </div> 
            <div class="textfield">
                <label>email: </label>
                <input type="text" name="cli_email" class="form-control <?php echo (!empty($cli_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cli_email; ?>">
                <span class="invalid-feedback"><?php echo $cli_email_err; ?></span>
            </div> 
            <div class="textfield">
                <label>telefone: </label>
                <input type="text" name="cli_telefone" class="form-control <?php echo (!empty($cli_telefone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cli_telefone; ?>">
                <span class="invalid-feedback"><?php echo $cli_telefone_err; ?></span>
            </div>
            <div class="textfield">
                <label>Endereco: </label>
                <input type="text" name="cli_endereco" class="form-control <?php echo (!empty($cli_endereco_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cli_endereco; ?>">
                <span class="invalid-feedback"><?php echo $cli_endereco_err; ?></span>
            </div>
            
                <input type="submit" class="btn-login" value="Criar Conta">

        </form>
        <a class="a" href="index.php">Voltar para página principal</a>
        </div>

</div>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>