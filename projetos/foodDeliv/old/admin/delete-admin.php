<?php

    //Incluir o Arquivo constants.php aqui
    include('../config/constants.php');

    //1. Colocar o ID do Administrador para ser Deletado
    $id = $_GET['id'];

    //2. Consultar SQL para Deletar Administrador
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Executar a Consulta
    $res = mysqli_query($conn, $sql);

    //Verificar se a Consulta foi Executada ou Não
    if($res==TRUE)
    {
        //Consulta Executada e Administrador Deletado
        //echo "Administrador Deletado";
        //Criar Sessão Variante para Exibir Mensagem
        $_SESSION['delete'] = "<div class='success'>Administrador Deletado</div>";
        //Redirecionar para Página Gestão do Sistema
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Falha ao Deletar Administrador
        //echo "Falha ao Deletar Administrador";

        $_SESSION['delete'] = "<div class='error'>Falha ao Deletar Administrador. Tente Novamente Mais Tarde</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. Redirecionar para a Página Gestão de Sistemas com a Mensagem (Sucesso/Erro)

?>