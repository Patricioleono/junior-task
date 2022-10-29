<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertData($data)
    {
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['codigoIndicador'] == 'UF') {
                $dataInsert = array(
                    'nombreindicador' => $data[$i]['nombreIndicador'],
                    'codigoindicador' => $data[$i]['codigoIndicador'],
                    'unidadmedidaindicador' => $data[$i]['unidadMedidaIndicador'],
                    'valorindicador' => $data[$i]['valorIndicador'],
                    'fechaindicador' => $data[$i]['fechaIndicador'],
                    'tiempoindicador' => $data[$i]['tiempoIndicador'],
                    'origenindicador' => $data[$i]['origenIndicador'],
                );
                $this->db->insert('indices', $dataInsert);
            }
        }
       return $res ='Datos Ingresados Correctamente';
        
    }

    public function selectData(){
        $this->db->select('*');
        $this->db->from('indices');
        
        $result = $this->db->get();

        return $result->result_array();
    }

    public function insertDataForm($data){
        if(empty($data)){
            echo "error sin datos";
        }else{
            $this->db->insert('indices', $data);
            $res = 'datos insertados';
            return $res;
        }

    }

    public function deleteData($id){
        $this->db->where('id', $id);
        $this->db->delete('indices');
    }

    public function editData($edit, $id){
        $this->db->where('id', $id);
        $this->db->update('indices', $edit);
        return $res = 'Acutualizado OK';
    }

    public function graph(){
        $this->db->select('fechaindicador, valorindicador');
        $this->db->from('indices');
        $result = $this->db->get();
        return $result->result_array();
    }

}