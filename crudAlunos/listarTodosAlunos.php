<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas Todos os Alunos</title>
</head>
<body>
<h1>Listar Todos os Alunos</h1>
<table>
    <?php
        $arqDisc = fopen("alunos.txt", "r") or die("Erro ao criar arquivo");

        $linha = fgets($arqDisc);
        $coluna = explode(";", $linha);
    ?>
    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Matrícula</th>
        <th>Data de Nascimento</th>
    </tr>
    <?php
    $arqDisc = fopen("alunos.txt","r") or die("erro ao abrir arquivo");

    while (($linha = fgets($arqDisc)) !== false) {
        $colunaDados = explode(";", trim($linha)); // remove espaços em branco e quebras de linha

        if (count($colunaDados) >= 4) { 
            echo "<tr><td>" . htmlspecialchars($colunaDados[0]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[1]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[2]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[3]) . "</td></tr>";
        }
    }    
    fclose($arqDisc);
?>
</table>
<p><a href="./home.html">Voltar</a></p>
</body>
</html>