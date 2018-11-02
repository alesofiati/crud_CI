<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $dados = array('title'=>"Adicionar Pessoa"); $this->load->view('inc/header', $dados); ?>
	
	<div class="container">
		<h1 class="page-header">Cadastro Pessoa <span class="glyphicon glyphicon-user"></span></h1>
		<form method="post">
			<input type="hidden" name="id">
			<div class="form-group">
				<label for="exampleInputEmail1">Nome</label>
				<input type="text" class="form-control" name="nome" placeholder="Ex: João" value="<?php echo set_value('nome'); ?>">
				<?php echo form_error('nome'); ?>
			</div>
				<div class="form-group">
				<label for="exampleInputPassword1">E-mail</label>
				<input type="text" class="form-control" name="email" placeholder="Ex: teste@teste.com" value="<?php echo set_value('email')?>">
				<?php echo form_error('email'); ?>
			</div>
			<button type="submit" class="btn btn-primary">Salvar</button>
		</form>
	</div>

<?php $this->load->view('inc/footer'); ?>