<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividades extends CI_Controller {

	public function __construt()
	{
		parent::__construct();
	}
	public function index()
	{
		$status = $this->status_model->getAll();
		$data['status'] = $status;

		if($_POST['id_status']!=""){
			$this->db->where(array('id_status'=>$_POST['id_status']));
		}
		if($_POST['id_situacao']!=""){
			$this->db->where(array('id_situacao'=>$_POST['id_situacao']));
		}		
		$atividades = $this->atividades_model->getAll();
		$data['atividades'] = $atividades;

		$this->load->view('atividades_listagem',$data);
	}

	public function nova()
	{
		$status = $this->status_model->getAll();
		$data['status'] = $status;

		if($_POST){
			$post = $this->input->post();

			if($post['data_inicio']!=""){
				$post['data_inicio'] = Data2bd($post['data_inicio']);
			}
			if($post['data_fim']!=""){
				$post['data_fim'] = Data2bd($post['data_fim']);
			}
			$result = $this->atividades_model->Insert($post);
			if(!$result){
				$this->session->set_flashdata('error', 'Não foi possível inserir a atividade.');
			}else{
				$this->session->set_flashdata('success', 'Operação realizada com sucesso.');
				redirect();
			}
		}

		$this->load->view('form_atividade',$data);
	}

	public function editar($id)
	{
		$status = $this->status_model->getAll();
		$data['status'] = $status;

		if($_POST){
			$post = $this->input->post();
			if($post['data_inicio']!=""){
				$post['data_inicio'] = Data2bd($post['data_inicio']);
			}
			if($post['data_fim']!=""){
				$post['data_fim'] = Data2bd($post['data_fim']);
			}

			$result = $this->atividades_model->Update($id,$post);
			if(!$result){
				$this->session->set_flashdata('error', 'Não foi possível atualizar a atividade.');
			}else{
				$this->session->set_flashdata('success', 'Operação realizada com sucesso.');
				//redirect();
			}
		}

		$atividade = $this->atividades_model->getById($id);
		$data['atividade'] = $atividade;

		$this->load->view('form_atividade',$data);
	}
}
