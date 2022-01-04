<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar item</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">
                
                <tr>
                    <td>Título: </td>
                    <td>
                        <input type="text" name="title" placeholder="Digite o Nome do Item">
                    </td>
                </tr>

                <tr>
                    <td>Descrição: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Apresentação do Item"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Valor: </td>
                    <td>
                        <input type="number" name="price" step="0.01" placeholder="Ex.: 27,99">
                    </td>
                </tr>

                <tr>
                    <td>Selecionar Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Categoria: </td>
                    <td>
                        <select name="category">

                            <?php
                                //Criar código PHP para exibir as categorias para o banco de dados
                                //1. Criar SQL para inserir todos as categorias ativas ao banco de dados
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executar consulta
                                $res = mysqli_query($conn, $sql);

                                //Contar linhas para verificar se temos categorias ou não
                                $count = mysqli_num_rows($res);

                                //Se a contagem for maior que zero, temos categorias, senão não temos categorias
                                if($count>0)
                                {
                                    //Temos categorias
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Inserir os detalhes da categoria
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //Não temos categorias
                                    ?>
                                    <option value="0">Sem categorias encontradas</option>
                                    <?php
                                }


                                //2. Exibir em Dropdown
                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Em Destaque: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Ativo: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar ao cardápio" class="btn-secondary">
                    </td>
                </tr>
            
            </table>

        </form>


        <?php
        
            //Verificar se o botão está clicado ou não
            if(isset($_POST['submit']))
            {
                //Adicionar a opção no banco de dados
                //echo "Clicado";

                //1. Inserir os dados para o formulário
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Verificar se o botão destaca e ativar estão verificados ou não
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Definir o valor padrão
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Definir o valor padrão
                }

                //2. Carregar imagem e selecionar
                //Verificar se a imagem selecionada está clicada ou não e se o carregamento da imagem apenas se ela for
                if(isset($_FILES['image']['name']))
                {
                    //Inserir os detalhes da imagem selecionada
                    $image_name = $_FILES['image']['name'];

                    //Verifique se a imagem está selecionada ou não e a carregar a imagem apenas se estiver selecionada
                    if($image_name!="")
                    {
                        // Imagem está selecionada
                        //A. Renomear imagem
                        //Inserir a extenção da imagem selecionada (jpg, png, gif, etc.) "jeferson-lima.jpg" jeferson-lima jpg
                        $ext = end(explode('.', $image_name));

                        // Criar novo nome para a imagem
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //O novo nome da imagem pode ser "Food-Name-657.jpg"

                        //B. Carregar a imagem
                        //Inserir o Src Patch e o Destination Patch

                        // O caminho de origem é a localização atual da imagem
                        $src = $_FILES['image']['tmp_name'];

                        //Caminho destino para imagem carregada
                        $dst = "../images/food/".$image_name;

                        //Finalizar o da imagem do cardápio
                        $upload = move_uploaded_file($src, $dst);

                        //Verificar se a imagem foi carregada ou não
                        if($upload==false)
                        {
                            //Falha ao carregar a imagem
                            //Redirecionar para a página de Adicionar opção
                            $_SESSION['upload'] = "<div class='error'>Falha ao carregar imagem.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Para o processo
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //Definir o valor padrão em branco
                }

                //3. Inserir dentro do banco de dados

                //Criar uma consulta SQL para savar ou adicionar opção
                // Para números não precisamos passar o valor entre aspas '' mas para valores de string é obrigatório adicionar aspas ''
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Executar a consulta
                $res2 = mysqli_query($conn, $sql2);
                
                //Verificar se os dados foram inseridos ou não
                //4. Redirecionar com mensagem para a página de gestão de cardápio
                if($res2 == true)
                {
                    //Dados inseridos com sucesso
                    $_SESSION['add'] = "<div class='success'>Opção adicionada com sucesso.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Falha ao inserir dados
                    $_SESSION['add'] = "<div class='error'>Erro ao adicionar item.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>
        

    </div>
</div>

<?php include('partials/footer.php'); ?>