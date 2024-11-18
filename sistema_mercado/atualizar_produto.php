<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $stmt = $pdo->prepare("UPDATE produtos 
                              SET nome = ?, 
                                  preco = ?, 
                                  validade = ?, 
                                  unid_medida = ?, 
                                  desconto = ?, 
                                  quantidade = ? 
                              WHERE codigo = ?");
        
        $stmt->execute([
            $_POST['nome'],
            $_POST['preco'],
            $_POST['validade'],
            $_POST['unid_medida'],
            $_POST['desconto'],
            $_POST['quantidade'],
            $_POST['codigo']
        ]);

        // Se a atualização foi bem sucedida, redireciona com mensagem de sucesso
        header("Location: editar_produto.php?id=" . $_POST['codigo'] . "&success=1");
        exit();
        
    } catch(PDOException $e) {
        // Em caso de erro, redireciona com mensagem de erro
        header("Location: editar_produto.php?id=" . $_POST['codigo'] . "&erro=1");
        exit();
    }
} else {
    // Se alguém tentar acessar este arquivo diretamente sem POST
    header("Location: listagem_produtos.php");
    exit();
}
?>