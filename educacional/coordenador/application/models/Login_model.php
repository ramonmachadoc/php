<?php

class Login_model extends CI_Model {
# VALIDA USUÁRIO  

    function validate() {
        $this->db->where('usuario', $this->input->post('usuario'));
        $this->db->where('senha', $this->input->post('senha'));
        $this->db->where('status', 1); // Verifica o status do usuário      
        $query = $this->db->get('usuario');
        if ($query->num_rows == 1) {
            return true; // RETORNA VERDADEIRO  
        }
    }

# VERIFICA SE O USUÁRIO ESTÁ LOGADO  

    function logged() {
        $logged = $this->session->userdata('logged');
        if (!isset($logged) || $logged != true) {
            echo 'Voce nao tem permissao para entrar nessa pagina. Efetuar Login';
            die();
        }
    }

}
