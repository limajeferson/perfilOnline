<?php
    //Incluir constants.php ao SITEURL
    include('../config/constants.php');
    //1. Desconectar da sessão
    session_destroy(); //unsets $_SESSION['user']

    //2. Redirecionar para páginda de Login
    header('location:'.SITEURL.'admin/login.php');

?>