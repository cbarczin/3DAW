<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Perguntas</title>
</head>
<body>

<h3>Informe abaixo as informações necessárias para alterar as perguntas do sistema.</h3>

<!-- Formulário de Alteração -->
<form id="alterarPerguntaForm">
    <label for="pergAlterar">Qual pergunta será alterada?: </label>
    <input type="text" id="pergAlterar" required>
    <br><br>
    <label for="novaPerg">Qual será a nova pergunta?: </label>
    <input type="text" id="novaPerg" required>
    <br><br>
    <label for="respostaCerta">Qual é a sua resposta certa?: </label>
    <input type="text" id="respostaCerta" required>
    <br><br>
    <label for="alternativa2">Alternativa 2: </label>
    <input type="text" id="alternativa2" required>
    <br><br>
    <label for="alternativa3">Alternativa 3: </label>
    <input type="text" id="alternativa3" required>
    <br><br>
    <label for="alternativa4">Alternativa 4: </label>
    <input type="text" id="alternativa4" required>
    <br><br>
    <input type="submit" value="Alterar Pergunta">
</form>

<!-- Mensagem de resposta do servidor -->
<div id="responseMessage" style="margin-top: 20px; color: green;"></div>

<!-- Voltar -->
<p><a href="./home.html">Voltar</a></p>

<script>
// Captura o evento de envio do formulário
document.getElementById("alterarPerguntaForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio tradicional do formulário

    // Coleta os dados do formulário
    const pergAlterar = document.getElementById("pergAlterar").value;
    const novaPergunta = document.getElementById("novaPerg").value;
    const respostaCerta = document.getElementById("respostaCerta").value;
    const alternativa2 = document.getElementById("alternativa2").value;
    const alternativa3 = document.getElementById("alternativa3").value;
    const alternativa4 = document.getElementById("alternativa4").value;

    // Criação do objeto com os dados
    const dados = {
        pergAlterar: pergAlterar,
        novaPerg: novaPergunta,
        respostaCerta: respostaCerta,
        alternativa2: alternativa2,
        alternativa3: alternativa3,
        alternativa4: alternativa4
    };

    // Cria a requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "alterarPergunta.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Resposta do servidor
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            document.getElementById("responseMessage").innerText = response.msg;
        } else {
            document.getElementById("responseMessage").innerText = "Erro ao alterar a pergunta.";
        }
    };

    // Envia os dados para o servidor
    xhr.send(JSON.stringify(dados));
});
</script>

</body>
</html>
