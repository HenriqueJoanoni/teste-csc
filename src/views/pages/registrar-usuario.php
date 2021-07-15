<?= $render('header'); ?>
<section>
    <div class="my-5">
        <div class="col-md-12 text-center">
            <h2>Cadastro de Usuários</h2>
        </div>
    </div>
    <div class="container card mb-3">
        <div class="card-body">
            <form method="post" action="<?=$base;?>/cadastrar-usuario">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nomeUsuario">Nome</label>
                        <input type="text" name="nomeUsuario" class="form-control" id="nome-usuario">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sobrenomeUsuario">Sobrenome</label>
                        <input type="text" name="sobrenomeUsuario" class="form-control" id="sobrenome-usuario">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="emailUsuario">Email</label>
                        <input type="email" name="emailUsuario" class="form-control" id="email-usuario">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefoneUsuario">Telefone</label>
                        <input type="text" name="telefoneUsuario" class="form-control" onkeyup="phoneMask(this)" id="telefone-usuario">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cpfUsuario">CPF</label>
                        <input type="text" name="cpfUsuario" class="form-control" onkeyup="cpfMask(this)" id="cpf-usuario">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="dataNascimento">Data de Nascimento</label>
                        <input type="text" name="dataNascimento" class="form-control" onkeyup="mascaraData(this)" id="data-nascimento">
                    </div>
                </div>
                <hr>
                <!-- ENDERECO -->
                <div class="my-5">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="cep">Cep</label>
                            <input name="cep" type="text" class="form-control" id="cep"
                                   onblur="pesquisacep(this.value);"
                                   onkeypress="somenteNumeros(this,8)">
                            <small class="form-text text-muted">Somente Números</small>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="rua">Rua</label>
                            <input name="rua" type="text" class="form-control" id="rua" readonly>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="estado">UF</label>
                            <input name="uf" type="text" class="form-control" id="uf" readonly>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="numero">Número:</label>
                            <input name="numero" type="text" class="form-control" id='numero'
                                   onkeypress="somenteNumeros(this,4)">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="complemento">Complemento:</label>
                            <input type="text" class="form-control" name="complemento" id='complemento'>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="bairro">Bairro</label>
                            <input name="bairro" type="text" class="form-control" id="bairro" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="cidade">Cidade</label>
                            <input name="cidade" type="text" class="form-control" id="cidade" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="selectTipoEndereco">Tipo de Endereço</label>
                            <select name="selectTipoEndereco" class="form-control" id="selectTipoEndereco">
                                <?php foreach ($tipoEndereco as $tipo): ?>
                                    <option value="<?= $tipo['id_tipo_endereco']; ?>"><?= $tipo['tipo_endereco']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- ENDERECO -->
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</section>
<?= $render('footer'); ?>

