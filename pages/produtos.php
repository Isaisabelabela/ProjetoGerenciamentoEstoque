<form action="produtos.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nome" placeholder="Nome do Produto" required>
    <input type="text" name="descricao" placeholder="Descrição">
    <input type="number" name="preco" placeholder="Preço" required>
    <input type="number" name="quantidade" placeholder="Quantidade" required>
    <input type="file" name="imagem">
    <button type="submit">Cadastrar Produto</button>
</form>

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    
    $imagem = $_FILES["imagem"]["name"];
    move_uploaded_file($_FILES["imagem"]["tmp_name"], "assets/images/".$imagem);

    $query = "INSERT INTO produtos (nome, descricao, preco, quantidade, imagem) 
              VALUES ('$nome', '$descricao', '$preco', '$quantidade', '$imagem')";
    $conn->query($query);
}
?>
