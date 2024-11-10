<?php
// Recebe os dados enviados via AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Extrai os dados do JSON
$novaPergunta = $data['novaPergunta'] ?? '';
$respostaCerta = $data['respostaCerta'] ?? '';
$alternativa2 = $data['alternativa2'] ?? '';
$alternativa3 = $data['alternativa3'] ?? '';
$alternativa4 = $data['alternativa4'] ?? '';

$msg = '';

// Verifica se todos os campos estão preenchidos
if (!empty($novaPergunta) && !empty($respostaCerta) && !empty($alternativa2) && !empty($alternativa3) && !empty($alternativa4)) {
    $arquivo = "pergEResps.txt";

    // Criação do arquivo caso não exista
    if (!file_exists($arquivo)) {
        $arqDisc = fopen($arquivo, "w");
        if (!$arqDisc) {
            die("Erro ao criar o arquivo: " . error_get_last()['message']);
        }
        $linha = "novaPergunta;respostaCerta;alternativa2;alternativa3;alternativa4\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
    }

    // Abre o arquivo para adicionar a nova pergunta
    $arqDisc = fopen($arquivo, "a");
    if (!$arqDisc) {
        die("Erro ao abrir o arquivo: " . error_get_last()['message']);
    }

    // Monta a linha a ser escrita no arquivo
    $linha = $novaPergunta . ";" . $respostaCerta . ";" . $alternativa2 . ";" . $alternativa3 . ";" . $alternativa4 . "\n";
    fwrite($arqDisc, $linha);
    fclose($arqDisc);

    // Mensagem de sucesso
    $msg = "Pergunta registrada com sucesso!";
} else {
    // Mensagem de erro caso algum campo esteja vazio
    $msg = "Todos os campos devem ser preenchidos!";
}

// Retorna a resposta como JSON
echo json_encode(['msg' => $msg]);
