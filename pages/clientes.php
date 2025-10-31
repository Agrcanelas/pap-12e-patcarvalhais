<?php include '../includes/cabecalho.php'; ?>
<?php include '../config.php'; ?>

<main>
    <h1>Gestão de Clientes</h1>
    <form action="" method="POST">
    <!-- Nome (obrigatório) -->
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required minlength="3" maxlength="100" placeholder="Digite seu nome"><br>

    <!-- Telemóvel (validação de formato) -->
    <label for="telemovel">Telemóvel:</label>
    <input type="tel" name="telemovel" required pattern="^\d{9}$" placeholder="Exemplo: 123456789"><br>

    <!-- Email (obrigatório e formato válido) -->
    <label for="email">Email:</label>
    <input type="email" name="email" required placeholder="Digite seu email"><br>

    <!-- Endereço (opcional, mas com tamanho mínimo e máximo) -->
    <label for="endereco">Endereço:</label>
    <textarea name="endereco" placeholder="Digite seu endereço" maxlength="255"></textarea><br>

    <!-- NIF (obrigatório e validação simples) -->
    <label for="nif">NIF:</label>
    <input type="text" name="nif" required pattern="^\d{9}$" placeholder="Exemplo: 123456789"><br>

    <!-- Cartão de Cidadão (obrigatório e validação simples) -->
    <label for="cc">Cartão de Cidadão:</label>
    <input type="text" name="cc" required pattern="^\d{8}$" placeholder="Exemplo: 12345678"><br>

    <!-- Botão de envio -->
    <button type="submit" name="guardar">Guardar</button>
</form>


    <?php
    if (isset($_POST['guardar'])) {
        $nome = $_POST['nome'];
        $telemovel = $_POST['telemovel'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        $nif = $_POST['nif'];
        $cc = $_POST['cc'];

        $sql = "INSERT INTO clientes (nome, telemovel, email, endereco, nif, cc)
                VALUES ('$nome', '$telemovel', '$email', '$endereco', '$nif', '$cc')";

        if ($conn->query($sql) === true) {
            echo 'Cliente registado com sucesso!';
        } else {
            echo 'Erro: '.$conn->error;
        }
    }
?>
</main>

<?php include '../includes/rodape.php'; ?>
