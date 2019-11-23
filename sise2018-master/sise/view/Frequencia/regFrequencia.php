<div class="content-wrapper">
    <section class="content-header">
        <h1>Registrar Frequência<small>usuários</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <form action="frequencia?action=buscaInscritos" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Selecione o evento</label><br>
                                            <select name="Evento" id="listEventos">
                                                <?php
                                                    foreach($eventos as $evento) {
                                                        echo "<option value=".$evento->getIdEvento().">".$evento->getNomeEvento()."</option>";
                                                    }
                                                ?>
                                            </select>
                                            
                                            <button style="float:right" type="submit" class="btn btn-primary" name="editar">Buscar inscritos</button>
                                            
                                        </div>
                                    </div>
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