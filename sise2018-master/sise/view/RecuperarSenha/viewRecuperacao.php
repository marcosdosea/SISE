<?php
    /**
     * Autor: Gariel Santana
     * Date: 08/09/2017
     * Time: 12:28
     */
?>

<script>
    $.support.transition = true;
</script>
<div class="login-box">
    <div class="login-logo">
        <span class="logo-lg" style="padding: 5px"><img src="imagens/sise/sise.png" style="width: 200px;"></span>
    </div>
    <div class="login-box-body">

        <form action="usuario?action=alterarSenha" method="POST">
                <div class="form-group has-feedback">
                    <input readonly type="text" name="cpf" value="<?php echo $usuario->getCpfUsuario(); ?>" class="form-control" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="senha1" id="password" class="form-control" placeholder="Insira a nova senha" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="senha2" id="confirm_password" class="form-control" placeholder="Repita a nova senha" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" name="submeter" value='S' class="btn btn-primary btn-block btn-flat">Alterar Senha</button>
                </div>
            </div>
        </form>
    <div class="row">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                <p>Copyright © 2017 SISE. Todos os direitos reservados.</p>
                <p>Desenvolvido por <a href="http://www.itatechjr.com.br" target="_blank">Itatech Jr.</a></p>
            </div>
        </div>
    </div>
    </div>
</div>