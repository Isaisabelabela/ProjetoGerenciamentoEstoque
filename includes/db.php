<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "estoque_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>

/* Página de registro de usuário */
<?php
include('../includes/db.php');
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

/*Página de login (login.php) */

<?php
include('../includes/db.php');
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

/**Painel de administração (dashboard.php)*/
<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
echo "Bem-vindo ao painel de controle!";
?>





