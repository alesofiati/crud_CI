<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title"><?=isset($pessoa) ? 'Atualizar Pessoa' : 'Adicionar Pessoa'?></h4>
</div>
<form method="POST" action="<?=isset($pessoa) ? base_url("pessoa/{$pessoa->idPessoa}/update") : base_url('pessoa/store')?>" id="form-ajax">
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" placeholder="Ex: João" value="<?=$pessoa->nome ?? ''?>">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="text" class="form-control" name="email" id="email" placeholder="Ex: teste@teste.com" value="<?=$pessoa->email ?? ''?>">
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-success">Salvar</button>
	<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
</div>
</form>
