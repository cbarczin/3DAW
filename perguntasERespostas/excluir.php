<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Perguntas</title>
</head>
<body>
    <?php
    $msg = '';
    $arquivo = "perguntas.txt";

    // Verifica se foi enviado um pedido para excluir uma pergunta
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['perguntaParaExcluir'])) {
        $perguntaParaExcluir = $_POST['perguntaParaExcluir'];
        
        if (file_exists($arquivo)) {
            $linhas = file($arquivo);
            $novasLinhas = [];
            $encontrada = false;

            foreach ($linhas as $linha) {
                $data = explode(';', trim($linha));
                // Verifica se a pergunta atual é diferente da que queremos excluir
                if (trim($data[0]) !== $perguntaParaExcluir) {
                    $novasLinhas[] = $linha; // Mantém a linha se não for a que queremos excluir
                } else {
                    $encontrada = true; // Marca que a pergunta foi encontrada
                }
            }

            // Se a pergunta foi encontrada, reescreve o arquivo
            if ($encontrada) {
                file_put_contents($arquivo, $novasLinhas);
                $msg = "Pergunta excluída com sucesso!";
            } else {
                $msg = "Pergunta não encontrada.";
            }
        } else {
            $msg = "Arquivo de perguntas não encontrado.";
        }
    }

    $perguntas = [];
    if (file_exists($arquivo)) {
        $perguntas = file($arquivo);
    }
    ?>
    
    <main>
        <h3>Excluir Pergunta</h3>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
            <label for="perguntaParaExcluir">Selecione a pergunta a ser excluída:</label><br>
            <select name="perguntaParaExcluir" id="perguntaParaExcluir" required>
                <option value="">-- Selecione uma Pergunta --</option>
                <?php foreach ($perguntas as $linha): 
                    $data = explode(';', trim($linha)); ?>
                    <option value="<?= htmlspecialchars($data[0]); ?>"><?= htmlspecialchars($data[0]); ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <input type="submit" value="Excluir Pergunta">
        </form>
        <?php if ($msg) : ?>
            <p><?= htmlspecialchars($msg); ?></p>
        <?php endif; ?>
    </main>
    <p><a href="./home.html">Voltar</a></p>
</body>
</html>
