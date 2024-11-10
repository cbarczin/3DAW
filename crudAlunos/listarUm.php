<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Aluno</title>
</head>
<body>
<h1>Listar Aluno</h1>
<form action="./listarUm.php" method="get">
    <label for="aluno">Qual aluno será buscada?</label>
    <input type="text" name="aluno" required>
    <input type="submit" value="Listar Aluno">
</form>
<table>
    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Matrícula</th>
        <th>Data de Nascimento</th>
    </tr>
<?php

if (isset($_GET["aluno"])) {
    $aluno = trim($_GET["aluno"]); // Trim para remover espaços em branco
    $arqDisc = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    $encontrou = false; 

    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", $linha);

        // Verifica se a linha contém dados suficientes
        if (count($colunaDados) >= 4 && trim($colunaDados[0]) === $aluno) {
            echo "<tr><td>" . htmlspecialchars($colunaDados[0]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[1]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[2]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[3]) . "</td></tr>";
            $encontrou = true; // Encontrou a disciplina
        }
    }

    fclose($arqDisc);

    if (!$encontrou) {
        echo "<tr><td colspan='3'>Aluno não encontrada.</td></tr>";
    }
} else {
    // Caso a página seja acessada sem dados no GET
    echo "<tr><td colspan='3'>Por favor, insira uma aluno.</td></tr>";
}
?>
</table>
<p><a href="./home.html">Voltar</a></p>
</body>
</html>