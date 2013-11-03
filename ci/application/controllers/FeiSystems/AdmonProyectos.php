<?php

class AdmonProyectos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('FeiSystems/Login_model', 'login');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'form'));
    }

    public function loadPage($data, $page = 'AdmonProyectos') {
        $this->load->view('templates/headers', $data);
        $this->load->view('FeiSystems/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function index() {
        if ($this->session->userdata("logueado") == '0') {
            $data['token'] = $this->token();
            $data['title'] = 'Bienvenido a FeiSystems';
            $this->loadPage($data);
        } else {
            switch ($this->session->userdata('tipoUsuario')) {

                case 'Administrador':
                    redirect(base_url().'index.php/Administracion');
                    //redirect(base_url() . 'FeiSystems/Administracion');
                    break;
                case 'Maestro':
                    //redirect(base_url().'editor');
                    $data['title'] = 'Bienvenido a FeiSystems';
                    $data['nombre'] = $this->session->userdata('nombre');
                    $this->loadPage($data, 'welcome');
                    break;
            }
        }
        /*
          if ($this->session->userdata("logueado") == '0') {
          $data['token'] = $this->token();
          $data['title'] = 'Bienvenido a FeiSystems';
          $this->loadPage($data);
          } else {
          $data['title'] = 'Bienvenido a FeiSystems';
          $this->loadPage($data,'welcome');
          } */
    }

    public function autentica() {
        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {
            $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');

            //lanzamos mensajes de error si es que los hay
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
            $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $check_user = $this->login->login_user($username, $password);

                if ($check_user == TRUE) {
                    $data = array(
                        'logueado' => $check_user,
                        'nombre' => $check_user->nombre,
                        'usuario' => $check_user->usuario,
                        'tipoUsuario' => $check_user->tipo,
                    );
                }
                //$data['logueado'] = $check_user;
                $this->session->set_userdata($data);
                $this->index();
            }
        } else {
            redirect(base_url() . 'index.php');
        }
    }

    public function registro() {
        $data['title'] = 'Registro FeiSystems';
        $this->loadPage($data, 'addUser');
    }

    public function token() {
        $token = md5(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

    public function agregaUser() {
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('nameuser', 'nombre', 'required|trim|min_length[5]|max_length[150]|xss_clean');

        //lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
        if ($this->form_validation->run() == FALSE) {
            $this->registro();
        } else {
            $this->login->set_user();
            $data['title'] = 'Registro Completo';
            $this->loadPage($data, 'newUserSucess');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php');
        //$this->index();
    }

}

?>
