<?php
// Query SQL para selecionar informações da tabela
$sql = "SELECT * FROM usuario ORDER BY nome ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Chama a função para gerar a tabela de currículos
gerarTabelaCurriculos($stmt);

// Fecha a conexão com o banco de dados
$conn = null;

function gerarTabelaCurriculos($stmt) {
    if ($stmt->rowCount() > 0) {
        echo 
        "<div class='container-curriculos'>
            <table class='table table-striped table-responsive'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>";
        
        // Loop através dos resultados e exibe-os
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>
                    <a class='btn1' href='visualizar.php?id=" . $row['id'] . "'>Visualizar</a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";

        // Botão de voltar ao index
        echo "<a href='index.php' class='btn-voltar'>Voltar</a>";

        echo "</div>";
    } else {
        echo "<div class='nao-ha-curriculos'>Nenhum currículo cadastrado.</div>";
        echo "<a href='index.php' class='btn-voltar'>Voltar</a>";
    }
}
?>
