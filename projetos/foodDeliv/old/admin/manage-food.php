<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Gestão do Cardápio</h1>

        <br /><br />

                <!-- Buttom to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Adicionar Cardápio</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>Nº</th>
                        <th>Nome completo</th>
                        <th>Usuário</th>
                        <th>Opções</th>
                    </tr>

                    <tr>
                        <td>1. </td>
                        <td>Jeferson Lima</td>
                        <td>painho</td>
                        <td>
                            <a href="#" class="btn-secondary">Atualizar Admin</a>
                            <a href="#" class="btn-danger">Deletar Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2. </td>
                        <td>Jeferson Lima</td>
                        <td>painho</td>
                        <td>
                            <a href="#" class="btn-secondary">Atualizar Admin</a>
                            <a href="#" class="btn-danger">Deletar Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3. </td>
                        <td>Jeferson Lima</td>
                        <td>painho</td>
                        <td>
                            <a href="#" class="btn-secondary">Atualizar Admin</a>
                            <a href="#" class="btn-danger">Deletar Admin</a>
                        </td>
                    </tr>
                </table>
    </div>

</div>

<?php include('partials/footer.php') ?>