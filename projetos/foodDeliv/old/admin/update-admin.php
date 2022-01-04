<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Administrador</h1>

        <br><br>

        <?php 
            //1. Inserir o ID do Administrador Selecionado
            $id=$_GET['id'];

            //2. Criar Consulta SQL para inserir os detalhes
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Executar a Consulta
            $res=mysqli_query($conn, $sql);

            //Verificar se a Consulta foi Executada ou Não
            if($res==TRUE)
            {
                //Verificar se os Dados Estão Disponíveis ou Não
                $count = mysqli_num_rows($res);
                //Verificar se Temos Dados Administradores ou Não
                if($count==1)
                {
                    // Inserir os Detalhes
                    //echo "Administrador Disponível";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];   
                }
                else
                {
                    //Redirecionar para a Página Gerenciar Sistema
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>


        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>Nome completo: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Nome de usuário: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

            //Verificar se o Botão Enviar foi Clicado ou não
            if(isset($_POST['submit']))
            {
                //echo "Botão Clicado";
                //Inserir todos os Valores do Formulário para Atualizar
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

                //Criar uma Consulta para Atualizar o Administrador
                $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id='$id'
                ";

                //Executar a Consulta
                $res = mysqli_query($conn, $sql);

                //Verificar se a Consulta Foi Feita ou Não
                if($res==TRUE)
                {
                    //Consultar Execução e Atualização do administrador
                    $_SESSION['update'] = "<div class='success'>Administrador Atualizado com Sucesso.</div>";
                    //Redirecionar para a Página de Gestão do Sistema
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    //Falha ao Atualizar Administrador
                    $_SESSION['update'] = "<div class='error'>Falha ao Deletar Administrador.</div>";
                    //Redirecionar para a Página de Gestão do Sistema
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }

?>


<?php include('partials/footer.php'); ?>