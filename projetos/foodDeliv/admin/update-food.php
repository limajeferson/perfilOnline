<?php include('partials/menu.php'); ?>

<?php
    //Verificar se o ID está ou não inserido
    if(isset($_GET['id']))
    {
        //Inserir todos os dados
        $id = $_GET['id'];

        //Consulta SQL para inserir o Item selecionado
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //Executar consulta
        $res2 = mysqli_query($conn, $sql2);

        //Obter os valores baseados na consulta executada
        $row2 = mysqli_fetch_assoc($res2);

        //Obter o valor individual dos Itens selecionados
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
        
    }
    else
    {
        //Redirecionar para a página Gestão de Cardápio
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Atualizar Item</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Título: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Digite o Nome do Item">
                    </td>
                </tr>

                <tr>
                    <td>Discrição: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Apresentação do Item"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Valor: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>" step="0.01" placeholder="Ex.: 27,99">
                    </td>
                </tr>

                <tr>
                    <td>Imagem Atual: </td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                //Imagem não disponível
                                echo "<div class='error'>Imagem Indisponível</div>";
                            }
                            else
                            {
                                //Imagem disponível
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo$current_image; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Nova Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Categoria: </td>
                    <td>
                        <select name="category">
                            
                            <?php
                                //Consulta para obter categorias
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //Executar consulta
                                $res = mysqli_query($conn, $sql);
                                //Contar linhas
                                $count = mysqli_num_rows($res);
                            
                                //Verificar se a catategoria está disponível ou não
                                if($count>0)
                                {
                                    //Categoria disponível
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                    
                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Categoria não disponível
                                    echo "<option value='0'>Categoria não disponível</option>";
                                }                        
                            
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Em Destaque: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Ativo: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Atualizar Item" class="btn-secondary">
                    </td>
                </tr>

            </table>

            </form>

            <?php
            
                if(isset($_POST['submit']))
                {
                    //echo "Botão clicado";

                    //1. Inserir todos os dados para o formulário
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //2. Carregar imagem se selecionada

                    //Verificar se o o botão de carregar está clicado ou não
                    if(isset($_FILES['image']['name']))
                    {
                        //Botão de carregar clicado
                        $image_name = $_FILES['image']['name']; //Novo nome da imagem

                        //Verificar se o arquivo está disponível ou não
                        if($image_name!="")
                        {
                            //Imagem está disponível
                            //A. Carregar nova imagem

                            //Renomear imagem
                            $ext = end(explode('.', $image_name)); //Inserir a extensão da imagem

                            $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //Isso vai renomear a imagem

                            //Inserir o diretório de origem e o destino
                            $src_path = $_FILES['image']['tmp_name']; //Diretório de origem
                            $dest_path = "../images/food/".$image_name; //Destino

                            //Carregar imagem
                            $upload = move_uploaded_file($src_path, $dest_path);

                            //Veriricar se a imagem está carregada ou não
                            if($upload==false)
                            {
                                //Falha ao carregar
                                $_SESSION['upload'] = "<div class='error'>Falha ao carregar imagem.</div>";
                                //Redirecionar para Gestão de cardápio
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //Parar o processo
                                die();
                            }
                            //3. Remover imagem se a nova imagem estiver carregarda e a atual imagem existir
                            //B. Remover atual imagem se disponível
                            if($current_image!="")
                            {
                                //Atual imagem está disponível
                                //Remover a imagem
                                $remove_path = "../images/food/".$current_image;
                                
                                $remove = unlink($remove_path);

                                //Verificar se a imagem foi removida ou não
                                if($remove==false)
                                {
                                    //Falha ao remover imagem atual
                                    $_SESSION['remove-failed'] = "<div class='error'>Falha ao remover imagem atual.</div>";
                                    //Redirecionar para a página Gestão de cardápio
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    //Parar processo
                                    die();
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image; //Imagem padrão quando a imagem não estiver selecionada
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Imagem padrão quando o botão não estiver clicado
                    }

                    

                    //4. Carregar item do banco de dados
                    $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = '$price',
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";

                    //Executar consulta SQL
                    $res3 = mysqli_query($conn, $sql3);

                    //Verificar se a consulta foi executada ou não
                    if($res3==true)
                    {
                        //Consulta executada e item atualizado
                        $_SESSION['update'] = "<div class='success'>Item atualizado com sucesso.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //Falha ao atualizar item
                        $_SESSION['update'] = "<div class='error'>Erro ao atualizar item.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                    
                }

            ?>
            
        </div>
    </div>

<?php include('partials/footer.php'); ?>