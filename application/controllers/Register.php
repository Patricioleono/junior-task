<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function index()
	{
		$this->load->view('register');
	}

	public function ingreso(){
		$data = array(
			'reg_nombre' => $this->input->post('nombre'),
			'reg_ape_pat' => $this->input->post('paterno'),
			'reg_ape_may' => $this->input->post('materno'),
			'reg_correo' => $this->input->post('correo'),
			'reg_telefono' => $this->input->post('telefono')
		);
		echo json_encode($data);
	}
}
