<?php include('partials/menu.php') ;?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar Categoria</h1>

        <br><br>

        <?php
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Adicionar formulário de categoria início -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Título: </td>
                    <td>
                        <input type="text" name="title" placeholder="Título da categoria">
                    </td>
                </tr>

                <tr>
                    <td>Selecionar Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Apresentar: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Sim
                        <input type="radio" name="featured" value="No"> Não
                    </td>
                </tr>

                <tr>
                    <td>Ativo: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Sim
                        <input type="radio" name="active" value="No"> Não
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar Categoria" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Adicionar formulário de categoria fim -->

        <?php
        
            //Verificar se o botão Enviar está clicado ou não
            if(isset($_POST['submit']))
            {
                //echo "Clicado";

                //1. Inserir o valor para o formulário de categoria
                $title = $_POST['title'];

                //Para a entrada de seleção, precisamos verificar se o botão está ou não selecionado
                if(isset($_POST['featured']))
                {
                    //Inserir o valor para o formulário
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Inserir informações padrão
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //Verificar se a imagem está seleciona ou não e envia a informação para o nome da imagem
                //print_r($_FILES['image']);
                
                //die();//Para o código aqui

                if(isset($_FILES['image']['name']))
                {
                    //Carregar imagem
                    //Para carregar imagem precisamos nomear a imagem, fonte e destino
                    $image_name = $_FILES['image']['name'];

                    // Carregar imagem somente se a imagem estiver selecionada
                    if($image_name != "")
                    {
                        
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
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Parar o processo
                            die();
                        }
                    
                    }
                }
                else
                {
                    //Não enviar imagem e inserir a image_name em branco
                    $image_name="";
                }

                //2. Criar consulta SQL para inserir dentro do banco de dados
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Executar consulta e salvar no banco de dados
                $res = mysqli_query($conn, $sql);

                //4. Verificar se a consulta foi executada ou não e os dados foram inseridos ou não
                if($res==true)
                {
                    //Executar consulta e adicionar categoria
                    $_SESSION['add'] = "<div class='success'>Categoria Adicionada com sucesso.</div>";
                    //Redirecionar para a Gestão de categorias
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Falha para todas as categorias
                    $_SESSION['add'] = "<div class='error'>Falha ao Adicionar a categoria.</div>";
                    //Redirecionar para a Gestão de categorias
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php') ;?>