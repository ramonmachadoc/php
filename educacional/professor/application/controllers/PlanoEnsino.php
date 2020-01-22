<?php

/**
 * Description of PlanoEnsino
 *
 * @author Karol Oliveira
 */
class PlanoEnsino extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginp') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['disciplinas'] = $this->professor_model->GetMinhasDisciplinas($this->session->userdata('login'));

        $page_data['page_name'] = 'plano_ensino/list';
        $page_data['page_title'] = 'Minhas Disciplinas';
        $this->load->view('index', $page_data);
    }

    public function PlanoEnsino($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {

        if ($this->input->post()) {

            $ementa['ement_tx_descricao'] = $this->input->post('ementa');
            if ($this->professor_model->UpdateWhere($ementa, 'ementa', 'disc_nb_codigo', $param2)) {

                $planoEnsino['pe_tx_objetivo_geral'] = $this->input->post('objetivoGeral');
                $planoEnsino['pe_tx_instrumento'] = $this->input->post('instrumento');

                if ($this->professor_model->UpdateWhere($planoEnsino, 'plano_ensino', 'pe_nb_codigo', $param4)) {

                    $objetivoEspecifico['oe_tx_descricao'] = $this->input->post('objetivoEspecifico');

                    if ($this->professor_model->UpdateWhere($objetivoEspecifico, 'objetivos_especificos', 'pe_nb_codigo', $param4)) {

                        $competenciasHabilidades['ch_tx_descricao'] = $this->input->post('competenciasHabilidades');
                        if ($this->professor_model->UpdateWhere($competenciasHabilidades, 'competencias_habilidades', 'pe_nb_codigo', $param4)) {

                            $avaliacao['ava_tx_descricao'] = $this->input->post('avaliacao');
                            if ($this->professor_model->UpdateWhere($avaliacao, 'avaliacao', 'pe_nb_codigo', $param4)) {

                                $referencias['ref_tx_descricao'] = $this->input->post('referencias');
                                if ($this->professor_model->UpdateWhere($referencias, 'referencias', 'emet_nb_codigo', $param5)) {

                                    //ATUALIZANDO AS AULAS

                                    $arrayAulas = $this->professor_model->GetWhere('aulas', 'pdt_nb_codigo', $param1);

                                    foreach ($arrayAulas as $row):



                                        $AulaId = $row['aul_nb_codigo'];
                                        $juntaTempo = "tempo" . $AulaId;
                                        $juntaData = "data" . $AulaId;
                                        $juntaDescricao = "descricao" . $AulaId;
                                        $juntaEstrategia = "estrategia" . $AulaId;
                                        $juntaRecurso = "recurso" . $AulaId;


                                        if ($_POST[$juntaData] == '') {

                                            $_POST[$juntaData] = '0000/00/00';
                                        }


                                        $NovaData = explode("/", $_POST[$juntaData]);
                                        $NovaData = $NovaData[2] . "-" . $NovaData[1] . "-" . $NovaData[0];


                                        $dados = array(
                                            "aul_dt_aula" => $NovaData,
                                            "aul_tx_tempo" => $_POST[$juntaTempo],
                                        );

                                        if ($this->professor_model->UpdateWhere($dados, 'aulas', 'aul_nb_codigo', $AulaId)) {

                                            $dadosPlanoC = array(
                                                "pec_tx_descricao" => $_POST[$juntaDescricao],
                                                "pec_tx_estrategia" => $_POST[$juntaEstrategia],
                                                "pec_tx_recurso" => $_POST[$juntaRecurso],
                                            );

                                            $resultFinal = $this->professor_model->UpdateWhere($dadosPlanoC, 'plano_ensino_conteudo', 'aul_nb_codigo', $AulaId, 'pe_nb_codigo', $param4);
                                        } else {

                                            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                            $this->session->set_flashdata('type', 'warning');
                                            redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                        }

                                    endforeach;

                                    if ($resultFinal) {
                                        $this->session->set_flashdata('message', '<strong>PLANO DE ENSINO</strong> preenchido com sucesso!');
                                        $this->session->set_flashdata('type', 'success');
                                        redirect(base_url() . 'PlanoEnsino/');
                                    } else {

                                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                        $this->session->set_flashdata('type', 'warning');
                                        redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                    }
                                } else {

                                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                    $this->session->set_flashdata('type', 'warning');
                                    redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                }
                            } else {

                                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                $this->session->set_flashdata('type', 'warning');
                                redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                            }
                        } else {

                            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                            $this->session->set_flashdata('type', 'warning');
                            redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                        }
                    } else {

                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                        $this->session->set_flashdata('type', 'warning');
                        redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                    }
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
            }
        } else {



            $count = count($this->professor_model->VerificaPlano($param1));

            if ($count == 0) {

                $data1['pdt_nb_codigo'] = $param1;
                $pe_codigo = $this->professor_model->save('plano_ensino', $data1);

                if ($pe_codigo) {

                    $data2['pe_nb_codigo'] = $pe_codigo;
                    $oe_id = $this->professor_model->save('objetivos_especificos', $data2);

                    if ($oe_id) {

                        $data3['pe_nb_codigo'] = $pe_codigo;
                        $ch_id = $this->professor_model->save('competencias_habilidades', $data3);

                        if ($ch_id) {

                            $data4['pe_nb_codigo'] = $pe_codigo;
                            $ava_id = $this->professor_model->save('avaliacao', $data4);

                            if ($ava_id) {

                                $data6['disc_nb_codigo'] = $param2;
                                $ementa_id = $this->professor_model->save('ementa', $data6);

                                if ($ementa_id) {

                                    $data7['emet_nb_codigo'] = $ementa_id;
                                    $ref_id = $this->professor_model->save('referencias', $data7);

                                    if ($ref_id) {

                                        //CRIA AS AULAS
                                        $numero_aula = $param3 / 2;
                                        for ($i = 1; $i <= $numero_aula; $i++) {

                                            $data_aula['pdt_nb_codigo'] = $param1;

                                            $aula_id = $this->professor_model->save('aulas', $data_aula);

                                            if ($aula_id) {


                                                $data_pec['aul_nb_codigo'] = $aula_id;
                                                $data_pec['pe_nb_codigo'] = $pe_codigo;
//                               
                                                $pec_id = $this->professor_model->save('plano_ensino_conteudo', $data_pec);
                                                if ($pec_id) {

                                                    $this->session->set_flashdata('message', '<strong>PREENCHA O SEU PLANO DE ENSINO </strong>');
                                                    $this->session->set_flashdata('type', 'warning');
                                                } else {

                                                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                                    $this->session->set_flashdata('type', 'warning');
                                                    redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                                }
                                            } else {

                                                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                                $this->session->set_flashdata('type', 'warning');
                                                redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                            }
                                        }
                                    } else {


                                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                        $this->session->set_flashdata('type', 'warning');
                                        redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                    }
                                } else {

                                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                    $this->session->set_flashdata('type', 'warning');
                                    redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                                }
                            } else {

                                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                                $this->session->set_flashdata('type', 'warning');
                                redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                            }
                        } else {

                            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                            $this->session->set_flashdata('type', 'warning');
                            redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                        }
                    } else {

                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                        $this->session->set_flashdata('type', 'warning');
                        redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                    }
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher PLANO DE ENSINO!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'PlanoEnsino/PlanoEnsino/' . $param1 . "/" . $param2 . "/" . $param3);
                }
            }

            $page_data['infoPlano'] = $this->professor_model->InfoPlanoEnsino($param1);
            $page_data['Ementa'] = $this->professor_model->EmentaPlano($param2);
            $page_data['OutrasPlano'] = $this->professor_model->OutrasPlano($param1);
            $resultadoOutros = $this->professor_model->OutrasPlano($param1);
            $page_data['Aulas'] = $this->professor_model->aulasPlano($resultadoOutros['pe_nb_codigo']);
            $page_data['page_name'] = 'plano_ensino/preencher_plano';
            $page_data['page_title'] = 'Minhas Disciplinas';
            $this->load->view('index', $page_data);
        }
    }

}
