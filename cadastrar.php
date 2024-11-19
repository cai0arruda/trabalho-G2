<div class="formulario">
    <div class="form-container">
        <h2>Formulário de Inserção</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- Nome -->
        <label for="nome">Nome (Obrigatório)</label>
        <input type="text" id="nome" name="nome" required>
        
        <!-- Telefone -->
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone">

        <!-- E-mail -->
        <label for="email">Endereço de E-mail (Obrigatório)</label>
        <input type="email" id="email" name="email" required>

        <!-- Endereço WEB -->
        <label for="endereco_web">Endereço WEB</label>
        <input type="url" id="endereco_web" name="endereco_web">

        <!-- Experiência Profissional -->
        <label for="experiencia_profissional">Experiência Profissional (Obrigatório)</label>
        <textarea id="experiencia_profissional" name="experiencia_profissional" required></textarea>

        <!-- Botão -->
        <button type="submit" href="index.php">Enviar</button>
        <?php
            include "inserir.php";
            ?>
        </form>
    </div>
</div>