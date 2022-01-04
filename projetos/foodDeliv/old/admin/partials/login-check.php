<?php

    //Autorização - Controle de Acesso (Access Control)
    //Verificar se o usuário está logado ou não
    if(!isset($_SESSION['user'])) //Se a sessão de usuário está feita ou não
    {
        //Usuário não está logado
        //Redirecionar para página de login com mensagem
        $_SESSION['no-login-message'] = "<div class='error text-center'>Por favor, inicie uma sessão para acessar a Gestão do Sistema</div>";
        //Redureionar para página de login
        header('location:'.SITEURL.'admin/login.php');
    }

?>