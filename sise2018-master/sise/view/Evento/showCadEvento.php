<div class="content-wrapper">
    <section class="content-header">
        <h1>Cadastrar Evento<small>Cadastrar Evento</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="box-title"></h3>
                        <form action="evento?action=cadastrar" method="post" id="formCad" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nome do Evento*</label>
                                            <input type="text" name="nome" value="" class="form-control"
                                                   placeholder="Digite o nome do Evento" >
                                        </div>
                                    </div>
                                    <div class='col-md-2'>
                                        <div class='form-group'>
                                            <label for=''>Sigla do evento*</label>
                                            <input type='text' name='sigla' value='' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Capa do Evento*</label>
                                            <input type="file" name="imagem">


                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Descrição do evento*</label>
                                            <textarea rows="3" name="descricao" class="form-control"
                                                      placeholder="Descrição sobre o evento" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Inicio do evento*</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="dataInicio" class="form-control" id="dateIncio"
                                                       data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fim do evento*</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="dataFim" class="form-control"
                                                       data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Inicio das incrições*</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="dataInicioInsc" class="form-control"
                                                       id="dateInIncricoes" data-inputmask="'alias': 'dd/mm/yyyy'"
                                                       data-mask="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fim das incrições*</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="date" name="dataFimInsc" class="form-control"
                                                       id="dateFimIncricoes" data-inputmask="'alias': 'dd/mm/yyyy'"
                                                       data-mask="" >
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Estado*</label>
                                            <select name="estados" id="estado" class="form-control">
                                                <option id="" value="selecionar">Selecione um Estado</option>
                                                <?php
                                                 foreach ($data['Estados'] as $estado) {
                                                    echo "<option value='" . $estado->getIdEstado() . "'  id='" . $estado->getIdEstado() . "'>" . $estado->getNomeEstado() . " / " . $estado->getSiglaEstado() . "</option>";

                                                }

                                             ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Cidade*</label>
                                            <select name="cidades" id="cidade" class="form-control">
                                                <option data-cidade="selecionar" id="">Selecione o Estado antes</option>
                                                <?php
                                                foreach ($data['Cidades'] as $cidade) {
                                                    echo "<option data-cidade='" . $cidade->getIdEstado() . "' id='" . $cidade->getIdCidade() . "' value='" . $cidade->getIdCidade() . "'>" . $cidade->getNomeCidade() . "</option>";

                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">CEP*</label>
                                            <input type="text" name="cep" value="" class="form-control"
                                                   data-inputmask="'alias': '#####-###'"
                                                   placeholder="Ex.: 00000-000" data-mask="00000-000" maxlength="9">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            <label for=''>Logradouro*</label>
                                            <input type='text' name='endereco' value='' class='form-control'>
                                        </div>
                                    </div>
                                    <div class='col-md-2'>
                                        <div class='form-group'>
                                            <label for=''>Numero*</label>
                                            <input type='text' name='numero' value='' class='form-control'>
                                        </div>
                                    </div>
                                    <div class='col-md-2'>
                                        <div class='form-group'>
                                            <label for=''>Bairro*</label>
                                            <input type='text' name='bairro' value='' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Valor*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input type="text" name="valor" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Numero de parcelas</label>
                                            <select name="numParcelas" class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Participação Minima*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon ">%</span>
                                                <input type="text" name="partMin" class="form-control " placeholder='De 0% até 100%' >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <input type="submit" name="cadEvento" value="Cadastrar Evento" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
