<?php
    //Início de Sessão
    session_start();


    //Criar constantes para Não Armazenar Valores Repetidos
    define('SITEURL','https://bush-range.000webhostapp.com/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'id17457512_id17304333_delimajeferson');
    define('DB_PASSWORD', '@&bGB>7N2|1)%|2i');
    define('DB_NAME', 'id17457512_pedidos');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Conexão do Banco de Dados
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecionando Bando de Dados

    
?>