<?php include_once '../View/Layout_inc/inicio_arquivo.inc.php'; ?>
		<?php if(empty($lista)){ ?>
			<div class="panel panel-warning">
				<div align="center" class="panel-heading"><strong>Não existem tipos de unidade cadastrados!</strong></div>
			</div>
		<?php } else { ?>
			<table class="table table-striped table-advance table-hover">
				<tbody>
					<tr>
						<th>Descrição</th>
						<th>Ações</th>
					</tr>
					<?php foreach($lista as $model){ ?>
						<tr>
							<td><?php echo $model->getDescricao(); ?></td>
							<td>
								<div class="btn-group">
									<a class="btn btn-default" href="tipo-unidade?id=<?php echo $model->getCodigo(); ?>&action=show_edit"><i class="icon_pencil"></i><br>Alterar</a>
									<a class="btn btn-default" href="tipo-unidade?id=<?php echo $model->getCodigo(); ?>&action=del"><i class="icon_trash_alt"></i><br>Remover</a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>
		</section>
		<form method="POST" action="tipo-unidade">
			<input type="hidden" name="action" value="show_cad" />
			<input type="submit" class="btn btn-primary" value="Novo" />
		</form>
	</div>
</div>
<?php include_once '../View/Layout_inc/fim_arquivo.inc.php'; ?>