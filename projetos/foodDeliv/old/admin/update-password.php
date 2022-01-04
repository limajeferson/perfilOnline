<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Alterar Senha</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Senha atual: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Digite sua senha Atual">
                    </td>
                </tr>

                <tr>
                    <td>Nova Senha: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Digite sua nova Senha">
                    </td>
                </tr>

                <tr>
                    <td>Confirme a Senha</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Repita sua nova Senha">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Alterar Senha" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php

            //Verificar se o Botão Submit está Clicado ou Não
            if(isset($_POST['submit']))
            {
                //echo "Clicado";

                //1. Inserir os Dados para o Formulário
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                //2. Verificar se os Usuários com o atual ID e a atual Senha Existem ou Não
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Executar Consulta
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Verificar se os Dados estão Disponíveis ou Não
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //Usuário Existe e Senha Pode Ser Alterada
                        //echo "Usuário encontrado";

                        //Verificar se a Nova Senha e a Confimação Funcionam ou Não
                        if($new_password==$confirm_password)
                        {
                            //Atualizar a Senha
                            $sql2 = "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id
                            ";

                            //Executar Consulta
                            $res2 = mysqli_query($conn, $sql2);

                            //Verificar se a Consulta Foi Executada ou Não
                            if($res2==true)
                            {
                                //Exibir MEnsagem de Sucesso
                                //Redirecionar para a Página Gestão do Sistema com Mensagem de Sucesso
                                $_SESSION['change-pwd'] = "<div class='success'>Senha alterada com sucesso. </div>";
                                //Redirecionar o Usuário
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Exibir MEnsagem de Erro
                                //Redirecionar para a Página Gestão do Sistema com Mensagem de Erro
                                $_SESSION['change-pwd'] = "<div class='error'>Alteração de senha Falhou. </div>";
                                //Redirecionar o Usuário
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //Redirecionar para a Página Gestão do Sistema com Mensagem de Erro
                            $_SESSION['pwd-not-match'] = "<div class='error'>Senha não funcionou. </div>";
                        //Redirecionar o Usuário
                        header('location:'.SITEURL.'admin/manage-admin.php');
                            
                        }
                    }
                    else
                    {
                        //Usuário Não Existe Mostrar Mensagem e Redirecionar
                        $_SESSION['user-not-found'] = "<div class='error'>Usuário não encontrado. </div>";
                        //Redirecionar o Usuário
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                //3. Verificar se a Nova Senha e Confirmar se Funciona ou Não

                //4. Alterar a Senha Sobre Todos
            }

?>


<?php include('partials/footer.php'); ?>