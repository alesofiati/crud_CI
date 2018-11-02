<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $dados = array('title'=>"Editar Pessoa"); $this->load->view('inc/header', $dados); ?>
	
	<div class="container">
		<h1 class="page-header">Cadastro Pessoa <span class="glyphicon glyphicon-user"></span></h1>
		<form method="post" action="<?php echo base_url('update')?>">
			<input type="hidden" name="id" value="<?=$pessoa['idPessoa']?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nome</label>
				<input type="text" class="form-control" name="nome" placeholder="Ex: João" value="<?=$pessoa['nome'];?>" required>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">E-mail</label>
				<input type="email" class="form-control" name="email" placeholder="Ex: teste@teste.com" value="<?=$pessoa['email']?>" required>
			</div>
			<button type="submit" class="btn btn-primary">Salvar</button>
		</form>
	</div>

<?php $this->load->view('inc/footer'); ?>