<?php
/**
 * Created by PhpStorm.
 * User: John Hed
 * Date: 15/07/2017
 * Time: 16:48
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="height: auto">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-size: 45px">
            Todos Certificado
        </h1>
    </section>
    <ol class="breadcrumb" style="margin:0 20px;background: #c9cccf">
        <li><a href="../sise/"><i class="fa fa-home"></i></a></li>
        <li><a href="certificado">Home Certificado</a></li>
    </ol>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">

            <form role="form" name="form-certificado" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <?=$mensagem;?>
                    <div class="form-group">
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control" name="nomeEvento"
                                   placeholder="Digite o nome do evento que deseja buscar">
                            <span class="input-group-btn">
                                <button type="text" name="buscarEvento"
                                        class="btn btn-default" value="">Procurar por Evento
                                </button>
                            </span>
                        </div>
                      <!--  <div class="form-group col-sm-6">
                            <label for="status" class="col-sm-4 control-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Cadastrado</option>
                                    <option value="2">Cadastrado e liberado</option>
                                </select>
                            </div>
                        </div>-->
                    </div>
              <!--      <div class="form-group">
                        <div class="col-md-3 ">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="pai" checked>
                                    Evento pai
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <button type="submit" name="filtrar" class="btn btn-facebook">
                                <i class="fa fa-filter"></i>
                                Filtrar
                            </button>
                        </div>
                        <div class="col-md-3 ">
                            <a href="certificado?action=cad" type="button" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                Cadastrar um novo
                            </a>
                        </div>
                    </div>-->
                </div>
            </form>

            <div class="box-header">
                <h3 class="box-title">Últimos Certificados</h3>
           <!--     <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Certificado</th>
                        <th></th>
                        <th style="width: 80px"></th>
                    </tr>
                    <?php
                    for ($i = 0; $i < sizeOf($certificadosList); $i++) {
                        $e = $persistenciaEvento->obterById($certificadosList[$i]->getIdEvento());
                        ?>
                        <tr>
                            <td><?= $i + 1; ?>.</td>
                            <td><?= 'Certificado do Evento - ' . $e->getNomeEvento(); ?></td>
                            <td>
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="certificado?action=edit&certificado=<?= $certificadosList[$i]->getIdCertificado(); ?>"
                                       type="button" class="btn btn-success">
                                        <i class="fa fa-pencil"></i>
                                        Editar
                                    </a>
                                    <a href="certificado?action=del&certificado=<?= $certificadosList[$i]->getIdCertificado(); ?>"
                                       type="button" class="btn btn-danger">
                                        <i class="fa fa-times"></i>
                                        Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
</div>
</section>
</div>
