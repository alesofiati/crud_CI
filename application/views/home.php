<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $dados = array('title'=>"CRUD - Lista") ?>
<?php $this->load->view('inc/header', $dados); ?>

<div class="container">
	<h1 class="text-uppercase">Crud com codegniter!</h1>
	<h2 class="page-header">Lista de Pessoas <span class="glyphicon glyphicon-user"></span></h2>
    <?php if($this->session->flashdata("error")): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Atenção!</strong> <?= $this->session->flashdata("error"); ?>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata("success")): ?>
        <div class="alert alert-success" role="alert">
            <strong>Atenção!</strong> <?= $this->session->flashdata("success"); ?>
        </div>
    <?php endif; ?>
    <a href="<?php echo base_url('addPessoa'); ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Pessoas</a><br><br>
	<table class="table table-hover">
  		<tr>
  			<td class="text-center">ID</td>
  			<td class="text-center">Nome</td>
  			<td class="text-center">E-mail</td>
  			<td class="text-center">Ações</td>
  		</tr>
  		<tbody>
            <?php if($pessoas): ?>
            <?php foreach($pessoas as $people):?>
  			<tr align="center">
  				<td><?=$people->idPessoa;?></td>
  				<td><?=$people->nome;?></td>
  				<td><?=$people->email?></td>
  				<td>
  					
  					<div class="dropdown">
					  <button class="btn btn-xs btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" title="Ações">
					    <span class="glyphicon glyphicon-list"></span>
					    <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					    <li><a href="<?php echo base_url('editPessoa/').$people->idPessoa; ?>" title="Editar">Editar <span class="glyphicon glyphicon-pencil"></span></a></li>
					    <li><a href="<?php echo base_url('delete/').$people->idPessoa;?>" title="Apagar">Deletar <span class="glyphicon glyphicon-trash"></span></a></li>
					  </ul>
					</div>

  				</td>
  			</tr>
            <?php endforeach; ?>
            <?php endif; ?>
  		</tbody>
	</table>
</div>

<?php $this->load->view('inc/footer'); ?>