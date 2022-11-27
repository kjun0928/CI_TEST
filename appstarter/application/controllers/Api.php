<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
   public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
        $this->load->library('form_validation');
    }
    
    function index() {
        $data = $this->db->get('test_DB');//$this->api_model->fetch_all();
        echo json_encode($data->result_array());
    }
    
    public function post(){
        $data['ID'] = $_POST['ID'];
        $data['name'] = $_POST['name'];
        $data['age'] = $_POST['age'];
        $this->load->model('Api_model');
        $ret = false;
        if(!empty($data)){
            $ret = true;
            $this->apiModel->insert($data);
        }
        return $this->respond($ret);
    }
    
    public function get($id = false) {
        if ($id) {
            $data = $this->apiModel->find($id);
        } else {
            $data = $this->apiModel->findAll();
        }
        
        return $this->respond($data);
    }
    
    public function put($id = false) {
        $ret = false;
        if ($id && !empty($this->data)) {
            $ret = true;
            $this->apiModel->update($id, $this->data);
        }
        
        return $this->respond($ret);
    }
    
    public function delete($id = false) {
        $ret = false;
        
        if ($id) {
            $ret = true;
            $this->apiModel->delete($id);
        }
        
        return $this->respond($ret);
    }
    
}