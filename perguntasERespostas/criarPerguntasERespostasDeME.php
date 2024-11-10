<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Perguntas e respostas de múltipla escolha.</title>
</head>
<body>
    <?php
    $msg = '';
    $novaPergunta = isset($_GET["novaPergunta"]) ? $_GET["novaPergunta"] : '';
    $respostaCerta = isset($_GET["respostaCerta"]) ? $_GET["respostaCerta"] : '';
    $alternativa2 = isset($_GET["alternativa2"]) ? $_GET["alternativa2"] : '';
    $alternativa3 = isset($_GET["alternativa3"]) ? $_GET["alternativa3"] : '';
    $alternativa4 = isset($_GET["alternativa4"]) ? $_GET["alternativa4"] : '';

    $arquivo = "pergEResps.txt";

    if (!empty($novaPergunta) && !empty($respostaCerta) && !empty($alternativa2) && !empty($alternativa3) && !empty($alternativa4)) {
        if (!file_exists($arquivo)) {
            $arqDisc = fopen($arquivo, "w");
            if (!$arqDisc) {
                die("Erro ao criar o arquivo: " . error_get_last()['message']);
            }
            $linha = "novaPergunta;respostaCerta;alternativa2;alternativa3;alternativa4\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen($arquivo, "a");
        if (!$arqDisc) {
            die("Erro ao abrir o arquivo: " . error_get_last()['message']);
        }
        $linha = $novaPergunta . ";" . $respostaCerta . ";" . $alternativa2 . ";" . $alternativa3 . ";" . $alternativa4 . "\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
        $msg = "Deu tudo certo!!!";
    }
    ?>
    <main>
        <h3>Abaixo informe as informações necessárias para adicionar novas perguntas e respostas ao sistema:</h3>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
            <label for="novaPergunta">Nova Pergunta: </label>
            <input type="text" name="novaPergunta" id="novaPergunta" required>
            <br><br>
            <label for="respostaCerta">Resposta Certa: </label>
            <input type="text" name="respostaCerta" id="respostaCerta" required>
            <br><br>
            <label for="alternativa2">Alternativa 2: </label>
            <input type="text" name="alternativa2" id="alternativa2" required>
            <br><br>
            <label for="alternativa3">Alternativa 3: </label>
            <input type="text" name="alternativa3" id="alternativa3" required>
            <br><br>
            <label for="alternativa4">Alternativa 4: </label>
            <input type="text" name="alternativa4" id="alternativa4" required>
            <br><br>
            <input type="submit" value="Registrar Pergunta">
        </form>
        <?php if ($msg) : ?>
            <p><?= $msg; ?></p>
        <?php endif; ?>
    </main>
    <p><a href="./home.html">Voltar</a></p>
</body>
</html>
