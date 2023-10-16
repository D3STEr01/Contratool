<?php
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$ctt_contrato = "";
$ctt_contrato_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["ctt_contrato"]))){
        $ctt_contrato_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_@]+$/', trim($_POST["ctt_contrato"]))){
        $ctt_contrato_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT ctt_id FROM tbl_contratos WHERE ctt_contrato = :ctt_contrato";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":ctt_contrato", $param_ctt_contrato, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_ctt_contrato = trim($_POST["ctt_contrato"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $ctt_contrato_err = "este endereco já está em uso";
                } else{
                    $ctt_contrato = trim($_POST["ctt_contrato"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

        }
    }


    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($ctt_contrato_err)){
        
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO tbl_contratos (ctt_contrato) VALUES (:ctt_contrato)";


         
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":ctt_contrato", $param_ctt_contrato, PDO::PARAM_STR);

            
            // Definir parâmetros
            $param_ctt_contrato = $ctt_contrato;

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
    <link rel="stylesheet" href="css/rimov.css">
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
  <a href="imovel.html">Imóveis</a>
  <a href="index.php">Clientes</a>
  <a href="imovel.php">Contratos</a>
  <hr>
  <a href="rimoveis.php">+ Registrar Imóvel</a>
  <a class="nav-link disabled" href="#rcontratos.php">+ Registrar Contrato</a>
  <a href="rcliente.php">+ Registrar Cliente</a>
  <hr>
  <a href="configuser.php">Configuração</a>
</div>

<!-- Page content -->
<div class="content">
    <div class="background">
        <div class="card-login">
        <h3>Registro Imóvel</h3>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="textfield">
                <label>Url contratro: </label>
                <input type="text" name="ctt_contrato" class="form-control <?php echo (!empty($ctt_contrato_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ctt_contrato; ?>">
                <span class="invalid-feedback"><?php echo $ctt_contrato_err; ?></span>
            </div>   


            <input type="submit" class="btn-login" value="cadastrar contrato">

            </form>
                
        </div>
    </div>
</div>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>