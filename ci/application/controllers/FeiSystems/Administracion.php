<?php

class Administracion extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('FeiSystems/Login_model', 'login');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'form'));
    }
    
    public function index(){
        $data['title'] = 'Administrador';
        $this->load->view('templates/headers',$data);
        $this->load->view('FeiSystems/Administracion/welcome');
        $this->load->view('templates/footer');
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php');
        //$this->index();
    }
}

?>
