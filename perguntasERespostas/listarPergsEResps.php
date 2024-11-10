<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Perguntas E Respostas</title>
</head>
<body>
    <main>
        <h3>Lista das perguntas e respostas registradas no sistema</h3>
        <table>
        <?php
        $arqDisc = fopen("pergEResps.txt", "r") or die("Erro ao criar arquivo");

        $linha = fgets($arqDisc);
        $coluna = explode(";", $linha);
    ?>
    <tr>
        <th>Pergunta</th>
        <th>Resposta Certa</th>
        <th>Alternativa 2</th>
        <th>Alternativa 3</th>
        <th>Alternativa 4</th>
    </tr>

    <?php
    $arqDisc = fopen("pergEResps.txt","r") or die("erro ao abrir arquivo");

    while (($linha = fgets($arqDisc)) !== false) {
        $colunaDados = explode(";", trim($linha)); 

        if (count($colunaDados) >= 4) { 
            echo "<tr><td>" . htmlspecialchars($colunaDados[0]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[1]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[2]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[3]) . "</td>" .
                "<td>" . htmlspecialchars($colunaDados[4]) . "</td></tr>";
        }
    }    
    fclose($arqDisc);
?>
    </table>
    </main>
    <p><a href="./home.html">Voltar</a></p>
</body>
</html>