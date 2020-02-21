<?php include_once '../View/Layout_inc/inicio_arquivo.inc.php'; ?>
<div class="panel-body">
	<div class="form">
		<form id="form_edit_tp_unidade" name="form_edit_tp_unidade" class="form-validate form-horizontal" method="POST" action="tipo-unidade">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo $model->getCodigo(); ?>">
				<input type="hidden" name="action" value="edit">
			</div>
			<div class="form-group">
				<label for="descricao" class="control-label col-lg-2">Descrição<span class="required">*</span></label>
				<div class="col-lg-6">
					<input id="descricao" name="descricao" type="text" class="form-control" value="<?php echo $model->getDescricao(); ?>" minlength="5" required />
				</div>
			</div>
			<div align="center">
				<button type="submit" class="btn btn-default">Alterar</button>
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