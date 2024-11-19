<?php

include "pdoconfig.php";

$mensagem = ""; // Inicializa a mensagem como vazia

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos obrigatórios foram enviados e não estão vazios
    if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["experiencia_profissional"])) {
        try {
            // Prepara a inserção no banco de dados
            $stmt = $conn->prepare("
                INSERT INTO Usuario (nome, telefone, email, endereco_web, experiencia_profissional) 
                VALUES (?, ?, ?, ?, ?)
            ");

            // Executa a inserção com os dados do formulário
            $stmt->execute([
                $_POST["nome"],
                $_POST["telefone"] ?? null,               // Valor opcional, usa NULL se vazio
                $_POST["email"],
                $_POST["endereco_web"] ?? null,          // Valor opcional, usa NULL se vazio
                $_POST["experiencia_profissional"]
            ]);

            // Redireciona para a página de sucesso
            echo "<script>window.location.replace('index.php');</script>";
        } catch (PDOException $e) {
            // Exibe erro caso ocorra problema na execução
            $mensagem = "Erro ao inserir os dados: " . $e->getMessage();
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
    }
}

// Exibe a mensagem se estiver definida
if (!empty($mensagem)) {
    echo "<p>$mensagem</p>";
}
?>
