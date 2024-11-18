<?php
// logout.php
session_start();
session_destroy();
header("Location: index.php");
?>

<?php
// salvar_produto.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, validade, unid_medida, desconto, quantidade) VALUES (?, ?, ?, ?, ?, ?)");
    
    try {
        $stmt->execute([
            $_POST['nome'],
            $_POST['preco'],
            $_POST['validade'],
            $_POST['unid_medida'],
            $_POST['desconto'],
            $_POST['quantidade']
        ]);
        header("Location: cadastro_produto.php?success=1");
    } catch(PDOException $e) {
        header("Location: cadastro_produto.php?erro=1");
    }
}
?>