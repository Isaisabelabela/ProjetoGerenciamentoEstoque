<form action="vendas.php" method="POST">
    <select name="id_produto">
        <?php
        $result = $conn->query("SELECT * FROM produtos");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nome']}</option>";
        }
        ?>
    </select>
    <input type="number" name="quantidade_vendida" placeholder="Quantidade">
    <button type="submit">Registrar Venda</button>
</form>

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto = $_POST["id_produto"];
    $quantidade_vendida = $_POST["quantidade_vendida"];

    $conn->query("INSERT INTO vendas (id_produto, quantidade_vendida) VALUES ('$id_produto', '$quantidade_vendida')");
    $conn->query("UPDATE produtos SET quantidade = quantidade - $quantidade_vendida WHERE id = $id_produto");
}
?>
