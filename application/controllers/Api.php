<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ApiModel', 'api');
	}

	public function index()
	{
		$data = $this->api->allData();

		echo json_encode($data->result_array());
	}

	public function insertData()
	{

		$dataPersonal = array(
			'reg_nombre' => $_POST['reg_nombre'],
			'reg_ape_pat' => $_POST['reg_ape_pat'],
			'reg_ape_may' => $_POST['reg_ape_may'],
			'reg_correo' => $_POST['reg_correo'],
			'reg_telefono' => $_POST['reg_telefono']
		);
		$logData = array(
			'log_user' => $dataPersonal['reg_correo'],
			'log_pass' => $_POST['log_pass']
		);


		$result = $this->api->insertData($dataPersonal, $logData);
		if($result){
			$response = array(
				'status' => 'Success',
				'code' => 200,
				'message' => 'datos insertados con exito'
			);
		}else{
			$response = array(
				'status' => 'Error',
				'code' => 400,
				'message' => 'vuelva a intentar, revise la solicitud'
			);
		}

		echo json_encode($response);
	}

	public function deleteData()
	{
		if($this->post->input('id')){
			$result = $this->api->deleteUser($this->input->post('id'));
			if($result){
				$response = array(
					'status' => 'Success',
					'code' => 200,
					'message' => 'datos eliminados con exito'
				);
			}else{
				$response = array(
					'status' => 'Error',
					'code' => 400,
					'message' => 'vuelva a intentar, revise la solicitud'
				);
			}
		}
		echo json_encode($response);
	}

	public function onlyOneUser()
	{
		if($this->input->post('id')){
			$data = $this->api->onlyOne($this->input->post('id'));
			if(count($data) > 0){
				foreach($data as $row){
					$response['reg_nombre']   = $row['reg_nombre'];
					$response['reg_ape_pat']  = $row['reg_ape_pat'];
					$response['reg_ape_may']  = $row['reg_ape_may'];
					$response['reg_correo']   = $row['reg_correo'];
					$response['reg_telefono'] = $row['reg_telefono'];
				}
				echo json_encode($response);
			}
		}
	}

	public function login(){
		$logData = array(
			'log_user' => $_POST['log_user'],
			'log_pass' => $_POST['log_pass']);
		$result = $this->api->login($logData);

		if(count($result) > 0){
			$response = array(
				'status' => 'Success',
				'code' => 200,
				'message' => 'Acceso habilitado'
			);
		}else{
			$response = array(
				'status' => 'Error',
				'code' => 400,
				'message' => 'error en credenciales ingrese denuevo'
			);
		}
		var_dump($response);
		//echo json_encode($response);
	}

	public function updateData()
	{
		$dataPersonal = array(
			'reg_nombre' => $this->input->post('nombre'),
			'reg_ape_pat' => $this->input->post('paterno'),
			'reg_ape_may' => $this->input->post('materno'),
			'reg_correo' => $this->input->post('correo'),
			'reg_telefono' => $this->input->post('telefono')
		);
		if($this->input->post('correo')){
			$logData = array(
				'log_user' => $dataPersonal['reg_correo']
			);
		}
		$result = $this->api->updateData($this->input->post('id'), $dataPersonal, $logData);
		echo json_encode($result);
	}
}
