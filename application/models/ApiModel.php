<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function allData()
	{
		$this->db->order_by('reg_id','DESC');

		return $this->db->get('registrousuarios');
	}

	public function insertData($dataPersonal, $logData)
	{
		$this->db->insert('registrousuarios', $dataPersonal);
		$this->db->insert('login', $logData);
		$result = $this->db->affected_rows();
		if($result > 0){
			return true;
		}else{
			return false;
		}
	}

	public function deleteUser($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('login');

		if($this->db->affected_row()){
			$this->db->where('id', $id);
			$this->db->delete('registrousuarios');
			return true;
		}else{
			return false;
		}
	}

	public function login($correoPass)
	{
		$this->db->where('log_user', $correoPass['log_user']);
		$this->db->where('log_pass', $correoPass['log_pass']);
		$this->db->from('login');
		$this->db->select('*');
		$result = $this->db->get();

		return $result->result_array();
	}

	public function updateData($id, $dataPersonal, $logData = null)
	{
		if($logData){
			$this->db->where('id', $id);
			$result = $this->db->update('login',$logData);
			if($result){
				$this->db->where('id', $id);
				$this->db->update('registrousuarios',$dataPersonal);
				$response = array(
					'status' => 'Success',
					'code' => 200,
					'message' => 'Usuario y Credenciales Actualizadas'
				);
			}else{
				 $response = array(
					'status' => 'Error',
					'code' => 400,
					'message' => 'Error al realizar la actualizacion'
				);
			}
		}else{
			$this->db->where('id', $id);
			$this->db->update('registrousuarios',$dataPersonal);
			 $response = array(
				'status' => 'Success',
				'code' => 200,
				'message' => 'Usuario Actualizado'
			);
		}
		return $response;
	}
}
