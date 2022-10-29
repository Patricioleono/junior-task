<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Welcome_Model');
	}

	public function index()
	{
		
		$this->load->view('home');

	}

	public function tokenC(){
		$credential = $this->input->post('credential');

		$token = self::getToken($credential);
		
		echo json_encode($token);
	}
	private static function getToken($credentials){
		$url = 'https://postulaciones.solutoria.cl/api/acceso';
		$result = json_decode(self::apiData($url, $credentials));
		$token = $result->token;
		//echo $result;
		return $token;
	}
	private static function apiData($url, $credentials){
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
				"userName": "'.$credentials.'",
				"flagJson": true
			}',
			CURLOPT_HTTPHEADER => array( 
				'Content-type: application/json'
			),
		));

		$result = curl_exec($curl);
		return $result;
	}

	public function allData(){
		$token = $this->input->post('token');
		//var_dump($cdt);

		$url = 'https://postulaciones.solutoria.cl/api/indicadores';
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer '.$token ,
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);
		
		$newData = json_decode($response, true);
		$fRes = $this->Welcome_Model->insertData($newData);
		echo json_encode($fRes);		
	}

	public function datatable(){
		$data = $this->Welcome_Model->selectData();
		echo json_encode($data);
	}

	public function insertData(){
		$dataToInsert = array(
			'nombreindicador' => $this->input->post('nombreindice'),
			'codigoindicador' => $this->input->post('codigoindice'),
			'unidadmedidaindicador' => $this->input->post('unidadmedida'),
			'valorindicador' => $this->input->post('valorindice'),
			'fechaindicador' => $this->input->post('fechaindice'),
			'tiempoindicador' => $this->input->post('tiempoindice'),
			'origenindicador' => $this->input->post('origenindice')
		);
		$response = $this->Welcome_Model->insertDataForm($dataToInsert);
		echo json_encode($response);

	}
	public function deleteIndice(){
		$id = $this->input->post('id');

		$this->Welcome_Model->deleteData($id);
	}
	public function editData(){
		$id = $this->input->post('id');
		$editData = array(
			'nombreindicador' => $this->input->post('nombreindice'),
			'codigoindicador' => $this->input->post('codigoindice'),
			'unidadmedidaindicador' => $this->input->post('unidadmedida'),
			'valorindicador' => $this->input->post('valorindice'),
			'fechaindicador' => $this->input->post('fechaindice'),
			'tiempoindicador' => $this->input->post('tiempoindice'),
			'origenindicador' => $this->input->post('origenindice')
		);

		$response = $this->Welcome_Model->editData($editData, $id);
		echo json_encode($response);

	}
	public function graph(){
		$res = $this->Welcome_Model->graph();
		echo json_encode($res);
	}
	
}
