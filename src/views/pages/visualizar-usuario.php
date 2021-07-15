<?= $render('header'); ?>
<section>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-12 text-center">
                <h2>Visualizar Usuário</h2>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6" name="nomeUsuario">
                        <label for="nomeUsuario"><b>Nome:</b></label>
                        <?= $dados['nome'] . $dados['sobrenome'] ?>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <label for="nomeUsuario"><b>Email:</b></label>
                        <?= $dados['email'] ?>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nomeUsuario"><b>Telefone:</b></label>
                        <?= $dados['telefone'] ?>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <label for="nomeUsuario"><b>CPF:</b></label>
                        <?= $dados['cpf'] ?>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nomeUsuario"><b>Data de Nascimento:</b></label>
                        <?= $dados['dataNascimento'] ?>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <label for="nomeUsuario"><b>Tipo de Endereço:</b></label>
                        <?= ($dados['tipoEndereco'] === 1) ? 'Residencial' : 'Comercial' ?>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row my-5">
            <div class="col-md-12 text-center">
                <h3>Endereço</h3>
            </div>
        </div>
        <div>
            <iframe
                    width="100%"
                    height="450"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=<?= \src\Config::GOOGLE_API_KEY ?>&q=<?= $dados['rua'] . '+' . $dados['numero'] . '+' . $dados['bairro'] . '+' . $dados['cidade']; ?>">
            </iframe>
        </div>
        <a href="<?=$base?>" class="btn btn-primary my-5">Voltar à Home</a>
    </div>
</section>
<?= $render('footer'); ?>
