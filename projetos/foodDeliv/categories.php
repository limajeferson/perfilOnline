
    <?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //Exibir todas as categorias ativas
                //Consulta SQL
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Executar a consulta
                $res = mysqli_query($conn, $sql);

                //Contar linhas
                $count = mysqli_num_rows($res);

                //Verificar se as categorias estão disponíveis ou não
                if($count>0)
                {
                    //Categorias disponível
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Inserir os valores
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="category-foods.html">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name=="")
                                        {
                                            //Imagem não disponível
                                            echo "<div class='error'>Imagem Indisponível.</div>";
                                        }
                                        else
                                        {
                                            //Imagem disponível
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        
                        <?php
                    }
                }
                else
                {
                    //Categorias Indisponível
                    echo "<div class='error'>Categoria não Encontrada.</div>";
                }
            
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>