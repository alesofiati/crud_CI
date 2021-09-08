<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	// Construção da classe pai
	public function __construct(){	
		parent:: __construct();
		$this->load->model('crud_model', 'crud');
		$this->idTable = "idPessoa";
		$this->table = "pessoa";
		$this->campo = "idPessoa, nome, email";
	}

	public function index(){
		$dados['pessoas'] = $this->crud->all('pessoa');
		$this->load->view('home', $dados);
	}

	public function newPeople(){
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|min_length[5]', array('required'=>'Preencha o campo %s.', 'min_length'=>'O campo %s precisa ter no minimo 5 caracteres.'));
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email', array('required'=>'Preencha o campo %s.', 'valid_email'=>'O %s não é valido'));
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('people');
		}else{
			$data = array(
				"nome" => $this->input->post('nome'),
				"email" => $this->input->post('email')
			);
			if ($this->crud->store('pessoa', $this->idTable, $this->input->post('id'), $data)) {
				$this->session->set_flashdata("success", "Cadastro realizado com sucesso.");
				redirect(base_url('/'));
			}else{
				$this->session->set_flashdata("error", "Não foi possivel cadastrar a pessoa.");
				redirect(base_url('/'));
			}//else
		}//else	
	}//funtion

	public function editPeople($id){
		$dados['pessoa'] = $this->crud->find($this->table, $this->idTable, $id, $this->campo);
		$this->load->view('editarPessoa', $dados);
	}
	
	public function updatePessoa(){
		$id = $this->input->post('id');
		$dados = array(
			"nome"=> $this->input->post('nome'),
			"email"=> $this->input->post('email')
		);
		if ($this->crud->store($this->table, $this->idTable, $id, $dados)) {
			$this->session->set_flashdata("success", "Pessoa alterada com sucesso.");
			redirect(base_url('/'));
		}else{
			$this->session->set_flashdata("error", "Não foi possivel realizar a alteração da pessoa");
			redirect(base_url('/'));
		}
	}	

	public function pessoaJoin(){
		echo "<pre>";
		print_r($this->crud->join('pessoa as p', 'p.nome, e.rua', [
				[
					'table' => 'endereco as e',
					'condition' => 'e.pessoa_id=p.idPessoa',
					'type_join' => 'inner'
				]
			]
		));
	}

	public function deletePessoa($id){
		$id = $this->uri->segment('2');
		if ($this->crud->destroy($this->table, $this->idTable, $id)) {
			$this->session->set_flashdata("success", "Pessoa apagada com sucesso.");
			redirect('/');
		}else{
			$this->session->set_flashdata("error", "Não possivel excluir a pessoa.");
			redirect('/');
		}
	}

}
