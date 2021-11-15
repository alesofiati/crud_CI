<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('inc/header', ['title' => 'CRUD - Lixeira']); ?>

<div class="container">
	<h1 class="text-uppercase">Lixeira com codegniter!</h1>
	<h2 class="page-header">Lista de Pessoas <span class="glyphicon glyphicon-user"></span></h2>
	<a href="<?=base_url()?>" class="btn btn-xs btn-default">Lista de Pessoas</a>
	<br><br>
	<table class="table table-hover table-bordered">
		<tr>
			<td class="text-center">ID</td>
			<td class="text-center">Nome</td>
			<td class="text-center">Removido</td>
			<td class="text-center" colspan="3">Ações</td>
		</tr>
		<tbody class="text-center">
			<?php if(count($trash) > 0):?>
			<?php foreach($trash as $t):?>
			<tr>
				<td><?=$t->idPessoa?></td>
				<td><?=$t->nome?></td>
				<td><?=date('d/m/Y H:i:s', strtotime($t->deleted_at))?></td>
				<td>
					<a href="<?=base_url("pessoa/{$t->idPessoa}/restore")?>" class="btn btn-xs btn-success ajax-restore">Restaurar</a>
					<a href="<?=base_url("pessoa/{$t->idPessoa}/force-delete")?>" class="btn btn-xs btn-danger ajax-delete">Remover</a>
				</td>
			</tr>
			<?php endforeach;?>
			<?php endif;?>
		</tbody>
	</table>
</div>

<?php $this->load->view('inc/footer'); ?>
