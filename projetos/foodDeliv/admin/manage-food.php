<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Gerenciar Cardápio</h1>

        <br /><br />

                <!-- Buttom to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Adicionar Item</a>

                <br /><br /><br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                ?>

                <table class="tbl-full">
                    <tr>
                        <th>Nº</th>
                        <th>Título</th>
                        <th>Valor</th>
                        <th>Imagem</th>
                        <th>Em destaque</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>

                    <?php
                        //Criar consulta SQL para inserir todas as opções ao cardápio
                        $sql = "SELECT * FROM tbl_food";

                        //Executar consulta
                        $res = mysqli_query($conn, $sql);

                        //Contar as linhas para verificar se temos todas as opções do cardápio ou não
                        $count = mysqli_num_rows($res);

                        //Crie a variável do número de série e defina o valor padrão como 1
                        $sn=1;

                        if($count>0)
                        {
                            //Temos as opções no banco de dados
                            //Inserir as opções ao banco de dados e exibir
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Inserir o valor às colunas individuais
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td>R$ <?php echo $price; ?></td>
                                    <td>
                                        <?php
                                            //Verificar se temos imagem ou não
                                            if($image_name=="")
                                            {
                                                //Não temos imagem, exibir mensagem de erro
                                                echo "<div class='error'>Imagem não adicionada.</div>";
                                            }
                                            else
                                            {
                                                //Temos imagem, exibir imagem
                                                ?>
                                                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar item</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Deletar item</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Opção não adicionada ao cardápio
                            echo "<tr> <td colspan='7' class='error'> Nenhum item adicionado. </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>

</div>

<?php include('partials/footer.php') ?>