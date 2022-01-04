<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Gerenciar Categorias</h1>

        <br /><br />
        <?php
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>
        <br><br>

                <!-- Buttom to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Adicionar Categorias</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>Nº</th>
                        <th>Título</th>
                        <th>Imagem</th>
                        <th>Em destaque</th>
                        <th>Ativo</th>
                        <th>Ação</th>
                    </tr>

                    <?php

                        //Consultar para inserir todas as categorias para o banco de dados
                        $sql = "SELECT * FROM tbl_category";

                        //Executar consulta
                        $res = mysqli_query($conn, $sql);

                        //Contar linhas
                        $count = mysqli_num_rows($res);

                        //Criar número de série da variável, valor é 1
                        $sn=1;

                        //Verificar se temos dados no banco de dados ou não
                        if($count>0)
                        {
                            //Temos dados no banco de dados
                            //Inserir dados e exibir
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        
                                        <td>

                                            <?php
                                                //Verificar se o nome da imagem está disponível ou não
                                                if($image_name!="")
                                                {
                                                    //Exibir a imagem
                                                    ?>

                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="50px" >

                                                    <?php
                                                }
                                                else
                                                {
                                                    //Exibir a mensagem
                                                    echo "<div class='error'>Imagem não adicionada.</div>";
                                                }
                                            ?>

                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Categoria</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Deletar Categoria</a>
                                        </td>
                                    </tr>
                                
                                <?php
                                
                            }
                        }
                        else
                        {
                            //Não temos dados no banco de dados
                            //Vamos mostrar a mensagem dentro da tabela
                            ?>
                            
                            <tr>
                                <td colspan="6"><div class="error">Nenhuma categoria adicionada.</div></td>
                            </tr>

                            <?php
                        }

                    ?>

                    

                    
                </table>
    </div>

</div>

<?php include('partials/footer.php') ?>