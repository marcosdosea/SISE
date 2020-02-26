<?php include_once '../View/Layout_inc/inicio_arquivo.inc.php'; ?>
<div class="panel-body">
	<div class="form">
		<form id="form_cad_tp_unidade" name="form_cad_tp_unidade" class="form-validate form-horizontal" method="POST" action="tipo-unidade">
			<div class="form-group">
				<label for="descricao" class="control-label col-lg-2">Descrição<span class="required">*</span></label>
				<div class="col-lg-6">
					<input id="descricao" name="descricao" type="text" class="form-control" minlength="5" required />
					<input type="hidden" name="action" value="cad"/>
				</div>
			</div>
			<div align="center">
				<button type="submit" class="btn btn-default">Cadastrar</button>
				<button type="reset" class="btn btn-default">Limpar</button>
			</div>
		</form>
	</div>
</div>
</section>
<a href="tipo-unidade">Voltar</a>
</div>
</div>
<?php include_once '../View/Layout_inc/fim_arquivo.inc.php'; ?>