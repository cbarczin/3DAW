<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Aluno</title>
</head>
<body>
    <?php
    $msg = "";

    $nome = isset($_GET["nome"]) ? $_GET["nome"] : '';
    $cpf = isset($_GET["cpf"]) ? $_GET["cpf"] : '';
    $matric = isset($_GET["matric"]) ? $_GET["matric"] : '';
    $nasc = isset($_GET["nasc"]) ? $_GET["nasc"] : '';
    // $msg = "";
    // echo "nome: " . $nome . " sigla: " . " carga: " . $carga;

    if (!file_exists("alunos.txt")) {
        $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
        $linha = "nome;cpf;matric;nasc\n";
        fwrite($arqDisc,$linha);
        fclose($arqDisc);
    }

    $arqDisc = fopen("alunos.txt","a") or die("erro ao criar arquivo");
//    $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
    $linha = "nome;cpf;matric;nasc\n";
    $linha = $nome . ";" . $cpf . ";" . $matric . ";" . $nasc . "\n";
    fwrite($arqDisc,$linha);
    fclose($arqDisc);
    $msg = "Deu tudo certo!!!";
?>
    <h1>Incluir Alunos</h1>
    <p>Informe as informações necessárias para incluir novos alunos no sistema</p>
    <form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">
        <br><br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf">
        <br><br>
        <label for="matric">Matrícula:</label>
        <input type="text" name="matric" id="matric">
        <br><br>
        <label for="nasc">Data de Nascimento:</label>
        <input type="date" name="nasc" id="nasc">
        <br><br>
        <input type="submit" value="Incluir">
    </form>
    <p><a href="./home.html">Voltar</a></p>
</body>
</html>