<?php
include('includes/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $query = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user["senha"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_tipo"] = $user["tipo"];
            header("Location: dashboard.php");
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>
