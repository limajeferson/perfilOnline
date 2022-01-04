<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar Prato</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">
                
                <tr>
                    <td>Designação: </td>
                    <td>
                        <input type="text" name="title" placeholder="Nome do prato">
                    </td>
                </tr>

                <tr>
                    <td>Descrição: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Apresentação do prato"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Valor: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Selecionar imagem: </td>
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

    </div>
</div>

<?php include('partials/footer.php'); ?>