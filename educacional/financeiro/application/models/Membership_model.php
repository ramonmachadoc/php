<?php

/**
 * Description of Membership_model
 *
 * @author karol
 */
class Membership_model extends CI_Model {
    # VALIDA USUÁRIO    

    function validate($name, $password) {
        $this->db->where('usuario', 'karol');
        $this->db->where('senha', '123');
        $this->db->where('status', '1');       
        $query = $this->db->get('usuario');
        echo $query->num_rows;
        exit;
        if ($query->num_rows == 1) {
            echo $query->num_rows;
            
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
