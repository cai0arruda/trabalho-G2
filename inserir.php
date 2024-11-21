<?php

include "pdoconfig.php";

$mensagem = ""; // Inicializa a mensagem como vazia

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos obrigatórios foram enviados e não estão vazios
    if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["experiencia_profissional"])) {
        try {
            // Função para limpar e validar o nome
            function limparNome($nome) {
                $nome = preg_replace("/[^a-zA-Z ]/", "", $nome); // Remove caracteres inválidos
                $nome = preg_replace("/\s+/", " ", $nome);       // Substitui múltiplos espaços por um único
                return trim($nome);                             // Remove espaços extras no início e no fim
            }

            // Função para limpar e validar o telefone
            function limparTelefone($telefone) {
                return preg_replace("/\D/", "", $telefone); // Remove qualquer caractere que não seja número
            }

            // Função para validar o e-mail
            function validarEmail($email) {
                $email = preg_replace("/[^a-zA-Z0-9@._-]/", "", $email); // Remove caracteres inválidos
                return filter_var(trim($email), FILTER_VALIDATE_EMAIL) ? $email : false;
            }

            // Função para validar o endereço web
            function validarEnderecoWeb($url) {
                // Remove caracteres que não fazem parte de uma URL válida
                $url = preg_replace("/[^a-zA-Z0-9:\/._-]/", "", $url); 
                // Valida o formato da URL
                return filter_var(trim($url), FILTER_VALIDATE_URL) ? $url : false;
            }

            // Função para validar experiência profissional
            function limparExperiencia($texto) {
                return preg_replace("/[^a-zA-Z0-9 ]/", "", $texto); // Remove caracteres especiais
            }

            // Aplicação das validações nos campos
            $nome = limparNome($_POST["nome"]);
            $telefone = !empty($_POST["telefone"]) ? limparTelefone($_POST["telefone"]) : null;
            $email = validarEmail($_POST["email"]);
            $endereco_web = !empty($_POST["endereco_web"]) ? validarEnderecoWeb($_POST["endereco_web"]) : null;
            $experiencia_profissional = limparExperiencia($_POST["experiencia_profissional"]);

            // Verificações pós-validação
            if (empty($nome)) {
                throw new Exception("O nome inserido é inválido.");
            }
            if (!empty($telefone) && strlen($telefone) !== 11) {
                throw new Exception("O telefone deve conter exatamente 11 dígitos.");
            }
            if (!$email) {
                throw new Exception("O e-mail inserido é inválido.");
            }
            if (!empty($endereco_web) && !$endereco_web) {
                throw new Exception("O endereço web inserido é inválido.");
            }

            // Prepara a inserção no banco de dados
            $stmt = $conn->prepare("
                INSERT INTO Usuario (nome, telefone, email, endereco_web, experiencia_profissional) 
                VALUES (:nome, :telefone, :email, :endereco_web, :experiencia_profissional)
            ");

            // Executa a inserção com os dados do formulário
            $stmt->execute([
                ":nome" => $nome,
                ":telefone" => $telefone,
                ":email" => $email,
                ":endereco_web" => $endereco_web,
                ":experiencia_profissional" => $experiencia_profissional
            ]);

            // Redireciona para a página de sucesso
            echo "<script>window.location.replace('index.php');</script>";
        } catch (PDOException $e) {
            $mensagem = "Erro ao inserir os dados: " . $e->getMessage();
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
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
