<?php include('partials/menu.php'); ?>


        <!-- Início da Seção de Conteúdo Principal -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Gerenciar Sistemas</h1>

                <br />
                
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Exibir Mensagem da Sessão
                        unset($_SESSION['add']); //Remover Mensagem da Sessão
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br><br><br>

                <!-- Botão Para Adicionar Administrador -->
                <a href="add-admin.php" class="btn-primary">Adicionar Admin</a>

                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Nº</th>
                        <th>Nome completo</th>
                        <th>Usuário</th>
                        <th>Opções</th>
                    </tr>


                    <?php
                        //Consultar Todos os Administradores
                        $sql = "SELECT * FROM tbl_admin";
                        //Executar Consulta
                        $res = mysqli_query($conn, $sql);

                        //Verificar se a Consulta foi Executada
                        if($res==TRUE)
                        {
                            // Contar Linhas para Verificar se Temos Informações no Banco de Dados ou Não
                            $count = mysqli_num_rows($res); // Função para Obter Todas as Linhas no Banco de Dados

                            $sn=1; //Criar uma Variável e Atribuir o Valor 

                            //Verificar Número de Linhas
                            if($count>0)
                            {
                                //Temos Informações no Banco de Dados
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Usando o Ciclo para Obter Todas as Informações do Banco de Dados
                                    //E o Ciclo será Executado Enquanto Tivermos Informações no Danco de Dados

                                    //Inserir Dados Individuais
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Exibir os Valores e Sua Tabela
                    ?>
                    
                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Alterar Senha</a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Deletar Admin</a>
                        </td>
                    </tr>
                    
                    <?php

                                }
                            }
                            else
                            {
                                //Nós não Temos Informações no Banco de Dados
                            }
                        }

                    ?>

                </table>
                
            </div>
        </div>
        <!-- Fim  da Seção de Conteúdo Principal -->

<?php include('partials/footer.php'); ?>