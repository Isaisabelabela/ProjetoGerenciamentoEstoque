<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $tipo = "funcionario";

    $query = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";
    if ($conn->query($query)) {
        header("Location: login.php");
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }
}
?>
