<?php
    $v1 = $_GET["a"];
    $v2 = $_GET["b"];
    $operacao = $_GET["operacao"];
    $result = 0;

    switch ($operacao) {
        case 'soma':
            $result = $v1 + $v2;
            $operacao_nome = "Soma";
            break;
        case 'subtracao':
            $result = $v1 - $v2;
            $operacao_nome = "Subtração";
            break;
        case 'multiplicacao':
            $result = $v1 * $v2;
            $operacao_nome = "Multiplicação";
            break;
        case 'divisao':
            $result = $v1 / $v2;
            $operacao_nome = "Divisão";
            break;
        case 'troca':
            $result = $v1 *(-1);
            $operacao_nome = "Troca";
            break;
        case 'cosseno':
            $result = cos($v1);
            $operacao_nome = "Cosseno";
            break;
        case 'seno':
            $result = sin($v1);
            $operacao_nome = "Seno";
            break;
        case 'tangente':
            $result = tan($v1);
            $operacao_nome = "Tangente";
            break;
        case '1/porx':
            $result = 1/($v1);
            $operacao_nome = "1 / por Numero";
            break;
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <h1><?php echo $operacao_nome; ?></h1>
    <h2>Resultado: <?php echo $result; ?></h2>
</body>
</html>
