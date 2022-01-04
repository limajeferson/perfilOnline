<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cadastro Administrador</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])) //Verificar se a Sessão está Definida ou Não
            {
                echo $_SESSION['add']; //Exibir a Mensagem da Sessão se Configurada
                unset($_SESSION['add']); //Remover a Mensagem da Sessão
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nome Completo: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Nome completo">
                    </td>
                </tr>
                
                <tr>
                    <td>Nome de Usuário: </td>
                    <td>
                        <input type="text" name="username" placeholder="Nome de usuário">
                    </td>
                </tr>

                <tr>
                    <td>Senha: </td>
                    <td>
                        <input type="password" name="password" placeholder="Senha">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Continuar" class="btn-secondary">
                    </td>
                </tr>

            </table>
        
        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    //Processar o Valor do Formulário e Salvar no Bando de Dados

    //Verificar Se o Botão de Enviar Foi Clicado ou Não

    if(isset($_POST['submit']))
    {
        // Botão clicado
        //echo "Botão clicado";

        //1. Colocar os Dados no Formulário
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Criptografia de senha com MD5

        //2. Consultar SQL para Salvar os Dados no Banco de Dados
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
       
       //3. Executar Consulta e Salvamento no Banco de Dados
       $res = mysqli_query($conn, $sql) or die(mysqli_error());

       //4. Verificar se os dados (Consulta foi Executada) Estão Inseridos ou Não
       if($res==TRUE)
       {
           //Data Inserted
           //echo "Dados Inseridos";
           //Criar uma Sessão Variável para a Mensagem Exibida
           $_SESSION['add'] = "Administrador Adicionado com Sucesso";
           //Redirecionar Página Gerenciador Administrativo
           header("location:".SITEURL.'admin/manage-admin.php');
        }
       else
       {
           //Failed to Insert Data
           //echo "Falha ao Inserir Dados";
           //Criar uma Sessão Variável para a Mensagem Exibida
           $_SESSION['add'] = "Erro ao Adicionar Administrador";
           //Redirecionar Página Cadastro Administrador
           header("location:".SITEURL.'admin/add-admin.php');
       }

    }

?>