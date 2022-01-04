<?php include('partials/menu.php'); ?>

        <!-- Main Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Painel de controle</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categorias
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categorias
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categorias
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categorias
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Section Ends -->
        
        <?php include('partials/footer.php'); ?>