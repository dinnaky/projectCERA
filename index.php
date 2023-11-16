<?php

/*aqui vamos conectar 
com o banco 
de dados*/
$servername = "localhost";
//você deu nome ao banco de dados
$database = "func2c"; //func2c ou func2d
$username = "root";
$password = "";

$conexao = mysqli_connect(
    $servername, $username, 
    $password,$database
);

if (!$conexao){
    die("Falha na conexão".mysqli_connect_error());
}
//echo "conectado com sucesso";

$id = $_POST["id"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$botao = $_POST["botao"];
$pesquisa = $_POST["pesquisa"];

if(empty($botao)){

}else if($botao == "Cadastrar"){
    $sql = "INSERT INTO funcionarios 
    (id, nome, cpf) VALUES('','$nome', '$cpf')";
}else if ($botao == "Excluir"){
    $sql = "DELETE FROM funcionarios WHERE id = '$id'";
}else if ($botao == "Recuperar"){
    $sql_mostra_cad = "SELECT * FROM funcionarios WHERE nome LIKE '%$pesquisa%'";
}else if ($botao == "Alterar"){
    $sql = "UPDATE funcionarios SET nome = '$nome', cpf = '$cpf' WHERE id = '$id'";
}

//aqui vou tratar erros nas operações C.E.R.A
if(!empty($sql)){
    if(mysqli_query($conexao, $sql)){
        echo "Operação realizada com sucesso";
    }else{
        echo "Houve um erro na operação: <br />";
        echo  mysqli_error($conexao);
    }
}

$selecionado = $_GET["id"];

if(!empty($selecionado)){
    $sql_selecionado = "SELECT * FROM funcionarios
                        WHERE id = $selecionado";
    $resultado = mysqli_query($conexao, $sql_selecionado); 
         
    while($linha = mysqli_fetch_assoc($resultado)){
        $id = $linha["id"];
        $nome = $linha["nome"];
        $cpf = $linha["cpf"];
    }                      
}

?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.E.R.A</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    </head>

    <body>
    <form name = "func" method = "post" >
        <label>ID:</label>
        <input type ="text" name = "idi" value="<?php echo $id; ?>"disabled /><br />
        <input type ="hidden" name = "id" value="<?php echo $id; ?>"/>
        <label>NOME:</label>
        <input type ="text" name = "nome" value="<?php echo $nome; ?>" placeholder="Insira o nome do funcionario: "/><br />
        <label>CPF:</label>
        <input type ="text" name = "cpf" value="<?php echo $cpf; ?>" placeholder="Insira o CPF do funcionario: "/><br />
        <div class="buttons">
            <input type ="submit" name = "botao" value = "Cadastrar" />
            <input type ="submit" name = "botao" value = "Excluir" />
            <br/>
            <input type ="submit" name = "botao" value = "Alterar" />
        </div>
    </form>
    <div class="formulario">
        <div class="busca">
            <input type="text" name="pesquisa" class="buscarinput"  placeholder="Digite para pesquisar: "/> 
            <input type ="submit" name = "botao" value = "Recuperar" class="inputbutton"/>
        </div>
        <table>
            <tr>
                <td>-</td>
                <td>ID</td>
                <td>Nome</td>
                <td>CPF</td>
            </tr>
            <?php
            if(empty($pesquisa)){
                $sql_mostra_cad = "SELECT * FROM funcionarios
                ORDER BY id desc limit 0,10";
            }
            $resultado = mysqli_query($conexao, $sql_mostra_cad); 
            
            while($linha = mysqli_fetch_assoc($resultado)){
                echo "
                <tr>
                    <td>
                    <a href='?id=".$linha["id"]."'>Selecionar</a>
                    </td>
                    <td>".$linha["id"]."</td>
                    <td>".$linha["nome"]."</td>
                    <td>".$linha["cpf"]."</td>
                </tr>
                ";
            }
            ?>
        </table>
     </div>
    </body>
</html>