<?php
    //Incluir arquivo constants.php
    include('../config/constants.php');

    //echo "Página para deletar";
    //Verificar se o ID e image_name passuem dados ou não
    if(isset($_GET['id']) AND isset ($_GET['image_name']))
    {
        //Inserir dados e deletar
        //echo "Inserir informações e deletar";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remover o arquivo físico da imagem
        if($image_name != "")
        {
            //Imagem disponível, então remova
            $path = "../images/category/".$image_name;
            //Remover imagem
            $remove = unlink($path);

            //Se falhar ao remover a imagem então exibe uma mansagem de erro e para o processo
            if($remove==false)
            {
                //Colocar a mensagem da sessão
                $_SESSION['remove'] = "<div class='error'>Falha a remover imagem da categoria.</div>";
                //Redirecionar para a págine de Gestão de categorias
                header('location:'.SITEURL.'admin/manage/category.php');
                //Parar o processo
                die();
            }
        }

        //Deletar dados do banco de dados
        //Consulta SQL para deletar dados do banco de dados
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Executar consulta
        $res = mysqli_query($conn, $sql);

        //Verificar se os dados estão deletados do banco de dados ou não
        if($res==true)
        {
            //Inserir mensagem de sucesso e redirecionar
            $_SESSION['delete'] = "<div class='success'>Categoria deletada com sucesso.</div>";
            //Redirecionar para Gestão de categorias
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Inserir mensagem de fail e redirecionar
            $_SESSION['delete'] = "<div class='error'>Erro ao deletar categoria.</div>";
            //Redirecionar para Gestão de categorias
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        
        
    }
    else
    {
        //Redirecionar para Gestão de categorias
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>