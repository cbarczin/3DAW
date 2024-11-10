<?php
$msg = ""; // Inicializa a mensagem

$antNome = isset($_GET["antNome"]) ? $_GET["antNome"] : '';
$Nnome = isset($_GET["Nnome"]) ? $_GET["Nnome"] : '';
$Ncpf = isset($_GET["Ncpf"]) ? $_GET["Ncpf"] : '';
$Nmatric = isset($_GET["Nmatric"]) ? $_GET["Nmatric"] : '';
$Nnasc = isset($_GET["Nnasc"]) ? $_GET["Nnasc"] : '';

    $arqDisc = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");
    $arqDiscNovo = fopen("alunos_novo.txt", "w") or die("Erro ao abrir arquivo"); 
    
    $encontrou = false; 
    
    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", $linha);

        // Verifica se a sigla da linha atual corresponde à sigla a ser alterada
        if (isset($colunaDados[0]) && trim($colunaDados[0]) == $antNome) {
            // Cria nova linha com as novas informações
            $linha = $Nnome . ";" . $Ncpf . ";" . $Nmatric . ";" . $Nnasc ."\n";
            $encontrou = true; 
        }

        fwrite($arqDiscNovo, $linha); 
    }
    
    fclose($arqDisc);
    fclose($arqDiscNovo);

    rename("alunos_novo.txt", "alunos.txt");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar aluno</title>
</head>
<body>
<h1>Alteração de aluno</h1>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
        <label for="antNome">Qual aluno será alterado?:</label>
        <input type="text" name="antNome" id="antNome">
        <br>
        <h3>Informações do aluno que será adicionado no sistema:</h3>
        <label for="Nnome">Nome:</label>
        <input type="text" name="Nnome" id="Nnome">
        <br><br>
        <label for="Ncpf">CPF:</label>
        <input type="text" name="Ncpf" id="Ncpf">
        <br><br>
        <label for="Nmatric">Matrícula:</label>
        <input type="text" name="Nmatric" id="Nmatric">
        <br><br>
        <label for="Nnasc">Data de Nascimento:</label>
        <input type="date" name="Nnasc" id="Nnasc">
        <br><br>
        <input type="submit" value="Incluir">
    </form>
<br>
<p><?php echo $msg; ?></p> <!-- Exibe mensagem de sucesso ou erro -->
<p><a href="./home.html">Voltar</a></p>
</body>
</html>