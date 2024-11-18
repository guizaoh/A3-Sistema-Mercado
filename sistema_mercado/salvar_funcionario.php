<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO funcionarios (cpf, nome, senha, permissao, salario_220h, horas_trabalhadas) VALUES (?, ?, ?, ?, ?, ?)");
    
    try {
        $stmt->execute([
            $_POST['cpf'],
            $_POST['nome'],
            $_POST['senha'],
            $_POST['permissao'],
            $_POST['salario_220h'],
            $_POST['horas_trabalhadas']
        ]);
        header("Location: cadastro_funcionario.php?success=1");
    } catch(PDOException $e) {
        header("Location: cadastro_funcionario.php?erro=1");
    }
}
?>