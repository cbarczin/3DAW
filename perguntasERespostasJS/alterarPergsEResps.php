<?php

// Recebe os dados do corpo da requisição em formato JSON
$data = json_decode(file_get_contents("php://input"), true);

// Verifica se todos os dados necessários foram recebidos
if (isset($data['pergAlterar'], $data['novaPerg'], $data['respostaCerta'], $data['alternativa2'], $data['alternativa3'], $data['alternativa4'])) {
    
    $pergAlterar = $data['pergAlterar'];
    $novaPergunta = $data['novaPerg'];
    $respostaCerta = $data['respostaCerta'];
    $alternativa2 = $data['alternativa2'];
    $alternativa3 = $data['alternativa3'];
    $alternativa4 = $data['alternativa4'];

    // Caminho do arquivo original e do arquivo temporário
    $arquivo = "pergEResps.txt";
    $arquivoTemp = "pergEResps_novo.txt";

    // Tenta abrir os arquivos
    $arqDisc = fopen($arquivo, "r");
    if (!$arqDisc) {
        echo json_encode(['msg' => 'Erro ao abrir arquivo para leitura.']);
        exit;
    }

    $arqDiscNovo = fopen($arquivoTemp, "w");
    if (!$arqDiscNovo) {
        fclose($arqDisc);
        echo json_encode(['msg' => 'Erro ao abrir arquivo temporário para escrita.']);
        exit;
    }

    $encontrou = false;

    // Processa cada linha do arquivo
    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", $linha);

        // Verifica se a pergunta atual é a que será alterada
        if (isset($colunaDados[0]) && trim($colunaDados[0]) == $pergAlterar) {
            $linha = $novaPergunta . ";" . $respostaCerta . ";" . $alternativa2 . ";" . $alternativa3 . ";" . $alternativa4 . "\n";
            $encontrou = true; // Marca que a pergunta foi encontrada e alterada
        }

        // Escreve a linha no arquivo temporário
        fwrite($arqDiscNovo, $linha);
    }

    // Fecha os arquivos
    fclose($arqDisc);
    fclose($arqDiscNovo);

    // Se a pergunta foi encontrada e alterada, substitui o arquivo original pelo temporário
    if ($encontrou) {
        rename($arquivoTemp, $arquivo);  // Substitui o arquivo original
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(['msg' => 'Pergunta alterada com sucesso!']);
    } else {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['msg' => 'Pergunta não encontrada.']);
    }

} else {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['msg' => 'Dados inválidos ou incompletos.']);
}
?>
