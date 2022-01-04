<?php
    //Incluir Página Constants
    include('../config/constants.php');

    //echo "Página de Deletar Item";

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Tanto faz usar '&&' ou 'AND'
    {
        //Processo para deletar
        //echo "Processo para deletar";

        //1. Inserir ID e nome da imagem
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remover a imagem se disponível
        //Verificar se a imagem está disponível ou não e deletar somente se estiver disponível
        if($image_name != "")
        {
            // Tem imagem e precisa remover da pasta
            //Inserir a imagem no diretório
            $path = "../images/food/".$image_name;

            //Remover arquivo da imagem do diretório
            $remove = unlink($path);

            //Verificar se a imagem foi removida ou não
            if($remove==false)
            {
                //Falha ao remover imagem
                $_SESSION['upload'] - "<div class='error'>Falha ao remover arquivo de imagem.</div>";
                //Redirecionar para Gestão de cardápio
                header('location:'.SITEURL.'admin/manage-food.php');
                //Parar o processo de deletar item
                die();
            }

        }

        //3. Deletar item do banco de dados
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Executar Consulta
        $res = mysqli_query($conn, $sql);

        //Verificar se a consulta foi executada ou não e deixar mensagem
        //4. Redirecionar para a Gestão de cardápio
        if($res==true)
        {
            //Item deletado
            $_SESSION['delete'] = "<div class='success'>Item deletado com sucesso.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Falha ao deletar
            $_SESSION['delete'] = "<div class='error'>Falha ao deletar item.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //Redirecionar para Gestão de cardápio
        //echo "Redirecionar";
        $_SESSION['unauthorize'] = "<div class='error'>Acesso negado</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>