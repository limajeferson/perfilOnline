<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Atualizar Categorias</h1>

            <br><br>


            <?php

                //Verificar se o ID está inserido ou não
                if(isset($_GET['id']))
                {
                    //Verificar o ID e todos os outros detalhes
                    //echo "Inserindo dados";
                    $id = $_GET['id'];
                    //Criar consulta SQL para inserir todos os detalhes
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    //Executar consulta
                    $res = mysqli_query($conn,$sql);

                    //Contar os números de linhas para verificar o ID é válido ou não
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //Inserir todos os dados
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        //Redirecionar para Gestão de categorias com mensagem
                        $_SESSION['no-category-found'] = "<div class='error'>Categoria não encontrada.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }
                else
                {
                    //Redirecionar para Gestão de Categorias
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Título: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Imagem atual: </td>
                        <td>
                            <?php
                                if($current_image != "")
                                {
                                    //Exibir imagem
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="120px">
                                    <?php
                                }
                                else
                                {
                                    //Exibir mensagem
                                    echo "<div class='error'>Imagem não adicionada</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Nova imagem: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Em destaque: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Ativo: </td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Atualizar Categoria" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

                if(isset($_POST['submit']))
                {
                    //echo "Clicado";
                    //1. Inserir todos os valores para o nosso formulário
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //2. Atualizar a nova imagem se selecionada
                    //Verificar se a imagem está selecionada ou não
                    if(isset($_FILES['image']['name']))
                    {
                        //Inserir os detalhes da imagem
                        $image_name = $_FILES['image']['name'];

                        //Verificar se a imagem está diponível ou não
                        if($image_name != "")
                        {
                            //Imagem disponível
                            
                            //A. Atualizar a nova imagem
                            
                            //Auto renomear nossa imagem
                            //Inserir a extensão da nossa imagem (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                            $ext = end(explode('.', $image_name));
                        
                            //Renomear a imagem
                            $image_name = "Food_category_".rand(000, 999).'.'.$ext; // e.g. Food_gategory_834.jpg
                        
                        
                            $source_path = $_FILES['image']['tmp_name'];
                        
                            $destination_patch = "../images/category/".$image_name;
                        
                            //Finalizar carregamento da imagem
                            $upload = move_uploaded_file($source_path, $destination_patch);
                        
                            //Verificar se a imagem foi carregada ou não
                            //E se a imagem não foi carregada vamos parar o processo e redirecionar com uma mensagem de erro
                            if($upload==false)
                            {
                                //Exibir mensagem
                                $_SESSION['upload'] = "<div class='error'>Falha ao carregar imagem.</div>";
                                //Redirecionar para a página de adicionar categoria
                                header('location:'.SITEURL.'admin/manage-category.php');
                                //Parar o processo
                                die();
                            }
                            
                            //B. Remover a imagem atual se disponível
                            if($current_image !="")
                            {
                                $remove_path = "../images/category/".$current_image;
                            
                                $remove = unlink($remove_path);
                            
                                //Verificar se a imagem foi removida ou não
                                //Se falhar a remoção exiba a mensagem e pare o processo
                                if($remove==false)
                                {
                                    //falha ao remover a imagem
                                    $_SESSION['failed-remove'] = "<div class='error'>Falha ao remover a imagem atual.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();//Parar o processo
                                }
                            }
                            
                            
                        }
                        else
                        {
                            $image_name = $current_image;                            
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    //3. Atualizar o banco de dados
                    $sql2 = "UPDATE tbl_category SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";

                    //Executar consulta
                    $res2 = mysqli_query($conn, $sql2);

                    //4. Redirecionar para a página Gestão de Categorias
                    //Verificar se foi executado ou não
                    if($res2==true)
                    {
                        //Categoria Atualizada
                        $_SESSION['update'] = "<div class='success'>Categoria atualizada com sucesso.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Falha ao atualizar categoria
                        $_SESSION['update'] = "<div class='error'>Falha ao atualizar categoria.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }
            
            ?>

        </div>    
    </div>

<?php include('partials/footer.php') ?>