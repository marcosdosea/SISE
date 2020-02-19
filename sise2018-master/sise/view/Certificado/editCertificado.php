<?php
/**
 * Created by PhpStorm.
 * User: John Hed
 * Date: 17/07/2017
 * Time: 15:30
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="height: auto">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-size: 45px">
            Editar Certificado

        </h1>
    </section>
    <ol class="breadcrumb" style="margin:0 20px;background: #c9cccf">
        <li><a href="../sise/"><i class="fa fa-home"></i></a></li>
        <li><a href="certificado">Home Certificado</a></li>
    </ol>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Certifico do Evento - <?= $evento->getNomeEvento(); ?></h3>

            </div>
             <!-- form start -->
            <form role="form" name="form-certificado" method="post" enctype="multipart/form-data">

                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="carga-horaria">Carga Horaria</label>
                                <input type="number" class="form-control" name="cargahoraria"
                                       placeholder="Carga Horaria" value="<?= $certificado->getChCertificado(); ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Status Certificado</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?=( $certificado->getStatusCertificado() == 1 ? "selected" : "");?>>Cadastrado</option>
                                    <option value="2" <?=( $certificado->getStatusCertificado() == 2 ? "selected" : "");?>>Cadastrado e liberado</option>
                                </select>
                            </div>
                            <label style="margin-left: 15px">Tipo Certificado</label>
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <div class="input-group">
							<span class="input-group-addon">
							  <input type="radio" name="tipo" value="1" <?=( $certificado->getTipoCertificado() == 1 ? "checked" : "");?>>
							</span>
                                        <input type="text" class="form-control" value="Ouvinte" readonly="readonly">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
							<span class="input-group-addon">
							  <input type="radio" name="tipo" value="2" <?=( $certificado->getTipoCertificado() == 2 ?  "checked" : "");?>>
							</span>
                                        <input type="text" class="form-control" value="Organizador(a)" readonly="readonly">
                                    </div>
                                    <!-- /input-group -->
                                </div>

                            </div>

                        </div>
                        <label for="img-certificado">Imagem</label>
                        <input type="file" id="img-certificado" name="imagem">
                        <p class="help-block">Escolha uma imagem que será utilizada no cabeçalho do certificado.</p>

                        <input type="submit" name="cadCertificado" value="Editar" class="btn btn-primary">
            </form>
        </div><!--Box do formulario-->
        <div class="form-group col-sm-6">
            <div class="callout callout-success">
                <h4>Instruções!</h4>
                <?php for ($i = 0; $i < 4; $i++) { ?>
                    <p>There is a problem that we need to fix. A wonderful serenity has taken possession of
                        my entire soul, like these sweet mornings of spring which I enjoy with my whole
                        heart.</p>
                <?php } ?>
            </div>
        </div>

</div>

</div>
</section>
<!-- /.content -->
</div>