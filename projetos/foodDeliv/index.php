    <?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php
            //Criar consulta SQL para exibir categorias do banco de dados
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Executar a consulta
            $res = mysqli_query($conn, $sql);
            //Contar linhas para verificar se as categorias estão disponíveis ou não
            $count = mysqli_num_rows($res);
            
            if($count>0)
            {
                //Categorias disponíveis
                while($row=mysqli_fetch_assoc($res))
                {
                    //Inserir os valores como id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <a href="category-foods.html">
                        <div class="box-3 float-container">
                            <?php
                            //Verificar se a imagem está disponível ou não
                            if($image_name=="")
                            {
                                //Exibir mensagem
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
                    //Categorias indisponíveis
                    echo "<div class='error'>Categorias não adicionadas.</div>";
                }
            ?>
            
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Inserir itens pelo banco de dados se estiverem ativos e em destaque
            //Consulta SQL
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Executar a consulta
            $res2 = mysqli_query($conn, $sql2);

            //Contar as linhas
            $count2 = mysqli_num_rows($res2);

            //Verificar se os itens estão disponíveis ou não
            if($count2>0)
            {
                //Item Disponível
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Inserir todos os valores
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                //Verificar se a imagem está disponível ou não
                                if($image_name=="")
                                {
                                    //Imagem indisponível
                                    echo "<div class='error'>Imagem Indisponível.</div>";
                                }
                                else
                                {
                                    //Imagem Disponível
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>
                
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">R$ <?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            
                            <a href="order.html" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    
                    <?php
                }
            }
            else
            {
                //Item indisponível
                echo "<div class='error'>Item Indisponível.</div>";
            }

            ?>
            
            
            
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>