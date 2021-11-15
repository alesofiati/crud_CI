<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('inc/header', ['title' => 'CRUD - Lista']); ?>

<div class="container">
	<h1 class="text-uppercase">Crud com codegniter!</h1>
	<h2 class="page-header">Lista de Pessoas <span class="glyphicon glyphicon-user"></span></h2>
    <a href="<?=base_url('pessoa/create'); ?>" class="btn btn-xs btn-success ajax-modal" title="Adicionar nova pessoa"><span class="glyphicon glyphicon-plus"></span> Pessoas</a>
	<a href="<?=base_url('pessoas/trash')?>" class="btn btn-xs btn-default">Lixeira</a>
	<br><br>
	<table class="table table-hover table-bordered">
  		<tr>
  			<td class="text-center">ID</td>
  			<td class="text-center">Nome</td>
  			<td class="text-center">E-mail</td>
  			<td class="text-center" colspan="3">Ações</td>
  		</tr>
  		<tbody class="text-center">
            <?php if(count($pessoas) > 0): ?>
            <?php foreach($pessoas as $people):?>
  			<tr>
  				<td><?=$people->idPessoa;?></td>
  				<td><?=$people->nome;?></td>
  				<td><?=$people->email?></td>
  				<td>
					<a href="<?=base_url("pessoa/{$people->idPessoa}/edit"); ?>" class="btn btn-success btn-xs ajax-modal" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="<?=base_url("pessoa/{$people->idPessoa}/delete");?>" class="btn btn-danger btn-xs ajax-delete" title="Apagar"><span class="glyphicon glyphicon-trash"></span></a>
  				</td>
  			</tr>
            <?php endforeach; ?>
            <?php endif; ?>
  		</tbody>
	</table>
</div>

<?php $this->load->view('inc/footer'); ?>
