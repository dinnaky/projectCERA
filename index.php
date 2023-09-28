<?php

/*aqui vamos conectar 
com o banco 
de dados*/
$servername = "localhost";
//você deu nome ao banco de dados
$database = "func2c";
$username = "root";
$password = "";

$conexao = mysqli_connect(
    $servername, $username, 
    $password,$database
);

if (!$conexao){
    die("Falha na conexão".mysqli_connect_error());
}
// echo "E essa palheta ai bb ;)  :P";
// echo  $id." ".$nome." ".$cpf." ".$botao;

$id = $_POST["id"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$botao = $_POST["botao"];

if(empty($botao)) {

}else if ($botao == "cadastrar"){
    $sql = "INSERT INTO funcionarios (id, nome, cpf) VALUES ('', '$nome', '$cpf')";
}

// aqui vou tratar erros das operações C.E.R.A

if(!empty($sql)) {
    if(mysqli_query($conexao, $sql)) {
        echo "Operação realizada com sucesso";
    }else{
        echo "Houve um erro na operação: <br /> ";
        echo mysqli_error($conexao);
    }
}

if($botao == "Cadastrar"){
    if (mysqli_query($conexao, $sql)){
        echo "Cadastrado com sucesso!";
    }else{
        echo "Falha ao cadastrar!";
    }
}

?>

<html>
    <head>
        <style>

            form {
                display: flex;
                flex-direction: column;
            }

            input {
                width: 400px;
                margin: 10px 0;
            }

            .buttons {
                display: flex;
                justify-content: space-around;
                width: 400px;
            }

            .buttons input {
                width: 80px;
            }
        </style>
    </head>
    <body>
        <form name="func" method = "POST">
            <label for="id">ID:</label> 
            <input type="text" name = "id">
            <label for="nome">NOME:</label> 
            <input type="text" name = "nome">
            <label for="cpf">CPF:</label> 
            <input type="text" name = "cpf">
                <div class="buttons">
                    <input type="submit" name = "botao" value="Cadastrar">
                    <input type="reset" name = "botao" value="Cancelar">
                </div>
        </form>
    </body>
</html>
