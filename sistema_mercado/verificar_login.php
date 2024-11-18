<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = trim($_POST['cpf']);
    $senha = trim($_POST['senha']);
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE cpf = ? AND senha = ?");
        $stmt->execute([$cpf, $senha]);
        
        if ($stmt->rowCount() > 0) {
            $funcionario = $stmt->fetch();
            $_SESSION['usuario'] = $funcionario['nome'];
            $_SESSION['permissao'] = $funcionario['permissao'];
            $_SESSION['cpf'] = $funcionario['cpf'];
            
            header("Location: menu.php");
            exit();
        } else {
            header("Location: index.php?erro=1");
            exit();
        }
    } catch(PDOException $e) {
        error_log("Erro no login: " . $e->getMessage());
        header("Location: index.php?erro=2");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>