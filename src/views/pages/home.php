<?= $render('header'); ?>

<section>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-12 text-center">
                <h2>Usuários Cadastrados</h2>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Telefone</th>
                <th scope="col" class="text-center">CPF</th>
                <th scope="col" class="text-center">Data de Nascimento</th>
                <th scope="col" class="text-center">Rua</th>
                <th scope="col" class="text-center">Bairro</th>
                <th scope="col" class="text-center">Cidade</th>
                <th scope="col" class="text-center">Tipo de Endereço</th>
                <th scope="col" class="text-center">Data de Cadastro</th>
                <th scope="col" class="text-center">Data de Alteração de Cadastro</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php if (null !== $usuarios): ?>
                <?php foreach ($usuarios as $key => $usuario): ?>
                    <tr>
                        <?php foreach ($usuario as $info): ?>
                            <td><?=$info;?></td>
                        <?php endforeach; ?>
                        <td colspan="2">
                            <a class="btn btn-success" href="<?=$base;?>/visualizar-usuario/<?=$usuario['id_usuario'];?>"">Visualizar</a>
                            <a class="btn btn-warning" href="<?=$base;?>/editar-usuario/<?=$usuario['id_usuario'];?>">Editar</a>
                            <a class="btn btn-danger" href="<?=$base;?>/excluir-usuario/<?=$usuario['id_usuario'];?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <h3><b>Não existem usuários cadastrados ainda.</b></h3>
                <a class="btn btn-primary my-5" href="<?=$base?>/cadastro-usuario">Cadastrar Usuários</a>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</section>

<?= $render('footer'); ?>
