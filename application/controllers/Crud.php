<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	// Construção da classe pai
	public function __construct(){	
		parent:: __construct();
		$this->load->model('crud_model');
		$this->idTable = "idPessoa";
		$this->table = "pessoa";
		$this->order = "asc";
		$this->camp = "nome";
	}

	public function index(){
		$dados['pessoas'] = $this->crud_model->listAll($this->table, $this->camp, $this->order);
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
			if ($this->crud_model->store($this->table, $this->idTable, $this->input->post('id'), $data)) {
				$this->session->set_flashdata("success", "Cadastro realizado com sucesso.");
				redirect(base_url('/'));
			}else{
				$this->session->set_flashdata("error", "Não foi possivel cadastrar a pessoa.");
				redirect(base_url('/'));
			}//else
		}//else	
	}//funtion

	public function editPeople($id){
		$id = $this->uri->segment(2);
		$dados['pessoa'] = $this->crud_model->getOne($this->table, $this->idTable, $id);
		$this->load->view('editarPessoa', $dados);
	}
	
	public function updatePessoa(){
		$id = $this->input->post('id');
		$dados = array(
			"nome"=> $this->input->post('nome'),
			"email"=> $this->input->post('email')
		);
		if ($this->crud_model->store($this->table, $this->idTable, $id, $dados)) {
			$this->session->set_flashdata("success", "Pessoa alterada com sucesso.");
			redirect(base_url('/'));
		}else{
			$this->session->set_flashdata("error", "Não foi possivel realizar a alteração da pessoa");
			redirect(base_url('/'));
		}
	}	

	public function deletePessoa($id){
		$id = $this->uri->segment('2');
		if ($this->crud_model->delete($this->table, $this->idTable, $id)) {
			$this->session->set_flashdata("success", "Pessoa apagada com sucesso.");
			redirect('/');
		}else{
			$this->session->set_flashdata("error", "Não possivel excluir a pessoa.");
			redirect('/');
		}
	}

}
