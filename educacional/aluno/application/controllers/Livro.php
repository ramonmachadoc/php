<?php

/**
 * Description of Livro
 *
 * @author Karol Oliveira
 */
class Livro extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function livro($param1 = '') {

        $this->load->library('pagination');
        $offset = $this->uri->segment(3, 0);
        $limit = 10;

        $config['base_url'] = base_url() . "livro/livro/";
        $config['total_rows'] = $this->aluno_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', null, null, 'liv_tx_titulo');
        $config['per_page'] = 10;


        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();


        $page_data['data_list'] = $this->aluno_model->getJoinLike('COUNT(liv_tx_titulo) as quantidade, livro_id, liv_tx_titulo, liv_tx_autor, nome, palavra_chave', 'livro', 'categoria_livro', 'liv_tx_titulo', null, null, null, 'liv_tx_titulo, liv_tx_autor', $limit, $offset);
        $page_data['pagination'] = $pagination;


        $page_data['total'] = $this->aluno_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', null, null, 'liv_tx_titulo, liv_tx_autor');
        $page_data['page_name'] = '/livro/list';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function search($param1 = '') {

        if ($param1 == '' && $this->input->post('nome') == '') {
            redirect(base_url() . 'livro/livro');
        }

        $this->load->library('pagination');

        if ($this->input->post('nome') == '') {

            $nome = $param1;
        } else {
            $nome = $this->input->post('nome');
        }


        $offset = $this->uri->segment(4, 0);
        $limit = 10;

        $lista = $this->aluno_model->getJoinLike('COUNT(liv_tx_titulo) as quantidade, livro_id, liv_tx_titulo, liv_tx_autor, nome, palavra_chave', 'livro', 'categoria_livro', 'liv_tx_titulo', 'liv_tx_titulo', $nome, $nome, 'liv_tx_titulo, liv_tx_autor', $limit, $offset);


        $page_data['nome'] = $nome;
        $config['base_url'] = base_url() . "livro/search/$nome";
        $config['total_rows'] = $this->aluno_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', 'liv_tx_titulo', $nome, 'liv_tx_titulo, liv_tx_autor');
        $config['per_page'] = 10;


        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        $page_data['data_list'] = $lista;
        $page_data['pagination'] = $pagination;


        $page_data['total'] = $this->aluno_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', 'liv_tx_titulo', $nome, 'liv_tx_titulo, liv_tx_autor');
        $page_data['page_name'] = 'livro/list';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

}
