<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiMiddle extends CI_Controller
{
	public function index()
	{
		$this->load->view('login');
	}

	protected function curlUrl($url, $param){
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $param);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($client, CURLOPT_SSL_VERIFYHOST, false);

		$response = curl_exec($client);
		curl_close($client);

		return $response;
	}
	public function nuevoUser(){
		$tipo = $this->input->post('flag');
		if($tipo){
			$dataPersonal = array(
				'reg_nombre' => $this->input->post('nombre'),
				'reg_ape_pat' => $this->input->post('paterno'),
				'reg_ape_may' => $this->input->post('materno'),
				'reg_correo' => $this->input->post('correo'),
				'reg_telefono' => $this->input->post('telefono'),
				'log_pass' => $this->input->post('password')
			);

			$url = "http://localhost/patricio_leon/Api/insertData";
			$result = $this->curlUrl($url, $dataPersonal);

			echo $result;

		}
	}

	public function loginUser(){
		$tipo = $this->input->post('flag');
		if($tipo){
			$dataLogin = array(
				'log_user' => $this->input->post('correoLogin'),
				'log_pass' => $this->input->post('passwordLogin')
			);
			$url = "http://localhost/patricio_leon/Api/login";
			$result = $this->curlUrl($url, $dataLogin);

			echo json_encode($result);


		}
	}
}
