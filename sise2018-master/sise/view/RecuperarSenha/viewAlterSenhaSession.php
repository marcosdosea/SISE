<div class="content-wrapper">
    <section class="content-header">
        <h1>Dados Pessoais<small>Alterar Senha</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <form action="usuario?action=alterarSenha" method="post">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nome*</label>
                                            <!-- Adição do UTF-8 para o nome. -->
                                            <input readonly type="text" name="nome" value="<?php echo utf8_encode($usuario->getNomeUsuario()); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CPF*</label>
                                            <input readonly type="text" name="cpf" value="<?php echo $usuario->getCpfUsuario(); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <!-- Adição do UTF-8 para o email. -->
                                            <input readonly type="email" name="email" value="<?php echo utf8_encode($usuario->getEmailUsuario()); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nova senha*</label>
                                            <input type="password" name="senha1" id="password" class="form-control" placeholder="Insira a nova senha" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Repetir a senha*</label>
                                            <input type="password" name="senha2" id="confirm_password" class="form-control" placeholder="Repita a nova senha" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
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