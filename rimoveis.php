<?php
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$imv_uf = $imv_cep =$imv_cidade = $imv_bairro = $imv_endereco = $imv_numero = $itp_tipo = $itp_finalidade = $cpm_tipo = "";
$imv_id_err = $imv_uf_err = $imv_cep_err =$imv_cidade_err = $imv_bairro_err = $imv_endereco_err = $imv_numero_err = $itp_tipo_err = $itp_finalidade_err = $cpm_tipo_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["imv_uf"]))){
        $imv_uf_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_@.°,  ]+$/', trim($_POST["imv_uf"]))){
        $imv_uf_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT imv_id FROM tbl_imotbl_imoveisveis WHERE imv_uf = :imv_uf";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":imv_uf", $param_imv_uf, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_imv_uf = trim($_POST["imv_uf"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $imv_uf_err = "este endereco já está em uso";
                } else{
                    $imv_uf = trim($_POST["imv_uf"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

        }
    }
    if(empty(trim($_POST["$imv_cidade "]))){
        $imv_cidade_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_@.]+$/', trim($_POST["imv_cidade"]))){
        $imv_cidade_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT imv_id FROM tbl_imotbl_imoveisveis WHERE imv_cidade = :imv_cidade";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":imv_cidade", $param_imv_cidade, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_imv_cidade = trim($_POST["imv_cidade"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $imv_cidade_err = "Este e-mail já está em uso.";
                } else{
                    $imv_cidade = trim($_POST["imv_cidade"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

        }
    }
    
    // Validar cep
    if(empty(trim($_POST["imv_cep"]))){
        $imv_cep_err = "Por favor insira um cep.";     
    } elseif(strlen(trim($_POST["imv_cep"])) < 1){
        $imv_cep_err = "O cep deve ser válido";
    } else{
        $imv_cep = trim($_POST["imv_cep"]);
    }

    // Validar numero do imovel
    if(empty(trim($_POST["imv_numero"]))){
        $imv_numero_err = "Por favor insira um telefone.";     
    } elseif(strlen(trim($_POST["imv_numero"])) < 1){
        $imv_numero_err = "você deve colocar um telefone valido.";
    } else{
        $imv_numero = trim($_POST["imv_numero"]);
    }
    // Validar bairro
    if(empty(trim($_POST["imv_endereco"]))){
        $imv_endereco_err = "Por favor insira um telefone.";     
    } elseif(strlen(trim($_POST["imv_endereco"])) < 1){
        $imv_endereco_err = "você deve colocar um telefone valido.";
    } else{
        $imv_endereco = trim($_POST["imv_endereco"]);
    }
 
    if(empty(trim($_POST["itp_tipo"]))){
        $itp_tipo_err = "Por favor insira um telefone.";     
    } elseif(strlen(trim($_POST["itp_tipo"])) < 8){
        $itp_tipo_err = "você deve colocar um telefone valido.";
    } else{
        $itp_tipo = trim($_POST["itp_tipo"]);
    }



    if(empty(trim($_POST["itp_finalidade"]))){
        $itp_finalidade_err = "Por favor insira um telefone.";     
    } elseif(strlen(trim($_POST["itp_finalidade"])) < 8){
        $itp_finalidade_err = "você deve colocar um telefone valido.";
    } else{
        $itp_finalidade = trim($_POST["itp_finalidade"]);
    }



    if(empty(trim($_POST["cpm_tipo"]))){
        $cpm_tipo_err = "Por favor insira um telefone.";     
    } elseif(strlen(trim($_POST["cpm_tipo"])) < 8){
        $cpm_tipo_err = "você deve colocar um telefone valido.";
    } else{
        $cpm_tipo = trim($_POST["cpm_tipo"]);
    }
    
    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($imv_uf_err)&& empty($imv_cep_err) && empty($imv_cidade_err) && empty($imv_bairro_err) && empty($imv_endereco_err) && empty($imv_numero_err) && empty($itp_tipo_err) && empty($itp_finalidade_err) && empty($cpm_tipo_err)){
        
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO tbl_contratos (ctt_contrato) VALUES (:ctt_contrato)";
        $sql = "INSERT INTO tbl_imovelTipo (itp_tipo) VALUES (:itp_tipo)";
        $sql = "INSERT INTO tbl_imovelFinalidade (itp_finalidade) VALUES (:itp_finalidade)";
        $sql = "INSERT INTO tbl_imovelComplemento (cpm_tipo) VALUES (:cpm_tipo)";

         
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":imv_uf", $param_imv_uf, PDO::PARAM_STR);
            $stmt->bindParam(":imv_cep", $param_imv_cep, PDO::PARAM_STR);
            $stmt->bindParam(":imv_cidade ", $param_imv_cidade, PDO::PARAM_STR);
            $stmt->bindParam(":imv_bairro", $param_bairro, PDO::PARAM_STR);
            $stmt->bindParam(":imv_endereco", $param_imv_endereco, PDO::PARAM_STR);
            $stmt->bindParam(":imv_numero", $param_imv_numero, PDO::PARAM_STR);
            $stmt->bindParam(":itp_tipo", $param_itp_tipo, PDO::PARAM_STR);
            $stmt->bindParam(":itp_finalidade", $param_itp_finalidade, PDO::PARAM_STR);
            $stmt->bindParam(":cpm_tipo", $param_cpm_tipo, PDO::PARAM_STR);

            
            // Definir parâmetros
            $param_imv_uf =  $imv_uf;
            $param_imv_cep = $imv_cep;
            $param_imv_cidade = $imv_cidade;
            $param_imv_bairro = $imv_bairro;
            $param_imv_endereco = $imv_endereco;
            $param_imv_numero = $imv_numero;
            $param_itp_tipo = $itp_tipo;
            $param_itp_finalidade = $itp_finalidade;
            $param_cpm_tipo = $cpm_tipo;
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
  <a href="#">Imóveis</a>
  <a href="index.php">Clientes</a>
  <a href="imovel.php">Contratos</a>
  <hr>
  <a class="nav-link disabled" href="#news">+ Registrar Imóvel</a>
  <a href="rimoveis.php">+ Registrar Contrato</a>
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
                <label>Uf</label>
                <input type="text" name="cpf" id="cpf"  value="<?php echo $imv_uf; ?>">
                
            </div> 
            <div class="textfield">
                <label>Cep</label>
                <input type="text" name="nome" id="nome" value="<?php echo $imv_cep; ?>">
                
            </div>    
            <div class="textfield">
                <label>Cidade</label>
                <input type="text" name="email" id="email" value="<?php echo $imv_cidade; ?>">
                
            </div> 
            <div class="textfield">
                <label>Bairro</label>
                <input type="tel" name="telefone" id="telefone" value="<?php echo $imv_bairro; ?>">
                
            </div>
            <div class="textfield">
                <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" value="<?php echo $imv_endereco; ?>">
            </div>
            <div class="textfield">
                <label>Numero Imv</label>
                <input type="text" name="endereco" id="endereco" value="<?php echo $imv_numero; ?>">
            </div>
            <input placeholder="Tipo:" class="textfield" list="browsers" value="<?php echo $itp_tipo; ?>">

                <datalist class="textfield" id="browsers" >
                <option value="Internet Explorer">
                <option value="Firefox">
                <option value="Google Chrome">
                <option value="Opera">
                <option value="Safari">
                </datalist>

                <input placeholder="Finalidade:" class="textfield" list="browsers" value="<?php echo $itp_finalidade; ?>">

                <datalist class="textfield" id="browsers">
                <option value="Internet Explorer">
                <option value="Firefox">
                <option value="Google Chrome">
                <option value="Opera">
                <option value="Safari">
                </datalist>

                
                <input placeholder="Finalidade:" class="textfield" list="browsers" value="<?php echo $cpm_tipo; ?>">

                <datalist class="textfield" id="browsers">
                <option value="Internet Explorer">
                <option value="Firefox">
                <option value="Google Chrome">
                <option value="Opera">
                <option value="Safari">
                </datalist>


                <input type="submit" class="btn-login" value="Cadastrar" name="CadCliente">
                <a class="a" href="index.php">Voltar para página de contratos</a>

            </form>
                
        </div>
    </div>
</div>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>