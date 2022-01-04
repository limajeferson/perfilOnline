
    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Exibir os itens que estão ativos
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Executar consulta
                $res=mysqli_query($conn, $sql);

                //Contar linhas
                $count = mysqli_num_rows($res);

                //Verificar se os itens estão disponíveis ou não
                if($count>0)
                {
                    //Itens disponíveis
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Inserir valores
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
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
                                        //Imagem disponível
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

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Itens indisponíveis
                    echo "<div class='error'>Item não encontrado.</div>";
                }
            ?>
            
            
            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>