<?php

class login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database("admondb");
    }

    public function login_user($username, $password) {
        $claveAcceso = hash('sha256', $password);
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->join('tipoUsuarios', 'usuarios.idtipousuarios = tipoUsuarios.idtipoUsuarios');
        $this->db->where('usuario', $username);
        $this->db->where('contrasenia', $claveAcceso);
        $query = $this->db->get();
        //$query = $this->db->get('usuarios');
        if ($query->num_rows() == 1) {
            //return ($query->num_rows());
            return $query->row();
        } else {
            $this->session->set_flashdata('usuario_incorrecto', 'Los datos introducidos son incorrectos');
            redirect(base_url() . 'index.php', 'refresh');
        }
        /* $claveAcceso = hash('sha256', $password);
          $query = $this->db->get_where('usuarios', array('idusuario' => $username, 'claveacceso' => $claveAcceso));
         */
        //return ($query->num_rows());
    }

    public function set_user() {
        $username = $this->input->post('username');
        $nameuser = $this->input->post('nameuser');
        $password = $this->input->post('password');
        $passCifrado = hash('sha256', $password);

        $this->db->where('usuario', $username);
        //$this->db->where('claveacceso', $passCifrado); 
        $query = $this->db->get('usuarios');
        if ($query->num_rows() == 1) {
            $this->session->set_flashdata('usuario_existe', 'El usuario ya existe');
            redirect(base_url() . 'index.php/registro', 'refresh');
        } else {
            $data = array('nombre' => $nameuser,
                'usuario' => $username,
                'contrasenia' => $passCifrado,
                'idtipoUsuarios' => 2);
            return ($this->db->insert('usuarios', $data));
        }
    }

}

?>
