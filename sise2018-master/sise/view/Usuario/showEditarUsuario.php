<div class="content-wrapper">
    <section class="content-header">
        <h1>Dados Pessoais<small>Alterar Dados</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <form action="usuario?action=edit" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nome*</label>
                                            <!-- Adição do UTF-8 para o nome. -->
                                            <input type="text" name="nome" value="<?php echo utf8_encode($usuario->getNomeUsuario()); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CPF*</label>
                                            <input readonly type="text" name="cpf" value="<?php echo $usuario->getCpfUsuario(); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <!--div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">RG</label>
                                            <input type="text" name="rg" value="<?php //echo $usuario->getRgUsuario(); ?>" class="form-control">
                                        </div>
                                    </div-->
                                </div>

                                <div-- class="row">
                                    <!--div-- class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Sexo*</label>
                                            <select class="form-control" name="sexo" required>
                                                <option value="M" <?php //if ($usuario->getSexoUsuario() == 'M') echo "selected"; ?>>Masculino</option>
                                                <option value="F" <?php //if ($usuario->getSexoUsuario() == 'F') echo "selected"; ?>>Feminino</option>
                                                <option value="O" <?php //if ($usuario->getSexoUsuario() == 'O') echo "selected"; ?>>Não declarar</option>
                                            </select>
                                        </div>
                                    </div-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <!-- Adição do UTF-8 para o email. -->
                                            <input type="email" name="email" value="<?php echo utf8_encode($usuario->getEmailUsuario()); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <!--div class="col-md-3">
                                        <div-- class="form-group">
                                            <label for="">Telefone 1</label>
                                            <input type="text" name="telefone1" value="<?php// echo $usuario->getTel1Usuario(); ?>" class="form-control">
                                        </div>
                                    </div-->
                                    <!--div class="col-md-3">
                                        <!--div-- class="form-group">
                                            <label for="">Telefone 2</label>
                                            <input type="text" name="telefone2" value="<?php //echo $usuario->getTel2Usuario(); ?>" class="form-control">
                                        </div>
                                    </div-->
                                </div>


                                <!--div-- class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <input type="text" name="estado" value="<?php ?>" class="form-control" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Cidade</label>
                                            <input type="text" name="cidade" value="" class="form-control" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CEP</label>
                                            <input type="text" name="cep" value="<?php //if ($endereco != null) { echo $endereco->getCepEndereco(); } ?>" class="form-control">
                                        </div>
                                    </div>
                                </div-->

                                <!--div-- class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Logradouro</label>
                                            <input type="text" name="logradouro" value="<?php //if ($endereco != null) { echo utf8_encode($endereco->getLogradouroEndereco()); } ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Número</label>
                                            <input type="text" name="numero" value="<?php //if ($endereco != null) { echo $endereco->getNumeroEndereco(); } ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Bairro</label>
                                            <input type="text" name="bairro" value="<?php //if ($endereco != null) { echo utf8_encode($endereco->getBairroEndereco()); } ?>" class="form-control">
                                        </div>
                                    </div>
                                </div-->

                               <!--div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Imagem de Perfil</label>
                                            <input type="file" name="imagem">
                                        </div>
                                    </div>
                                </div-->
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="editar">Salvar Dados</button>
                            </div>
                        </form>
                        <?php if (isset($_GET["msg"]) && $_GET["msg"]="sucess") { ?>
                            <div class="col-md-12">
                                <div class="callout callout-success">
                                    <h4>Dados Alterados com sucesso!</h4>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>