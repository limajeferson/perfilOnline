<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Formulário de Login inicia aqui -->
            <form action="" method="POST" class="text-center">
                Nome de usuário: <br>
                <input type="text" name="username" placeholder="Digite o nome de usuário"><br><br>

                Senha: <br>
                <input type="password" name="password" placeholder="Digite a senha"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Formulário de Login encerra aqui -->

            <p class="text-center">Criado por - <a href="">Jeferson Lima</a></p>
        </div>        
    
    </body>
</html>

<?php 

    //Verificar se o botão Enviar está clicado
    if(isset($_POST['submit']))
    {
        //Processar para logar
        //1. Inserir dados para formulário de Login
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL para verificar consulta do usuário se usuário e senha existem ou não
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Executar Consulta
        $res = mysqli_query($conn, $sql);

        //4. Contar linhas para verificar se o usuário existe ou não
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Usuário disponível e login com sucesso
            $_SESSION['login'] = "<div class='success'>Bem vindo!</div>";
            $_SESSION['user'] = $username; //Para verificar se o usuário está logado ou deslogado ou já saiu

            //Redirecionar para a página inicial
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //Usuário não disponível e erro de login
            $_SESSION['login'] = "<div class='error text-center'>Usuário ou senha não foram encontrados.</div>";
            //Redirecionar para a página inicial
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>