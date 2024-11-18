<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistema Mercado</title>
    <style>
        body { 
            font-family: Arial; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .login-form { 
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input { 
            width: 100%; 
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button { 
            width: 100%; 
            padding: 10px; 
            background: #4CAF50; 
            color: white; 
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2 style="text-align: center; margin-bottom: 20px;">Login do Sistema</h2>
        
        <?php if(isset($_GET['erro'])): ?>
        <div class="error-message">
            CPF ou senha incorretos!
        </div>
        <?php endif; ?>

        <form action="verificar_login.php" method="POST">
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="11" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" maxlength="5" required>
            </div>
            
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>