<?php

class Importacao extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
    }

    public function gerar_arquivo($param1 = '') {

        $arrayAlunos = $this->agape_model->SelectImportacao($param1);

        $arquivo = fopen("aluno.txt", "w+");



        /***********PRIMEIRA PARTE 40 FIXO ************ */
        $dados = '40';
        $dados .='|3397';
        $dados .= '|4';
        $dados .= "\r\n";


        foreach ($arrayAlunos as $row):


            /*************SEGUNDA PARTE 41 ******************** */

            $dados .='41'; //TIPO 
            $dados .='||'; //ID DO ALUNO
            $dados .=  $row['nome']; //NOME
            $dados .= "|" . limpaCPF_CNPJ($row['cpf']); //CPF
            $dados .='||'; //DOCUMENTO ESTRANGEIRO
            $dataNasc = str_replace("/", "", $row['data_nascimento']);
            $dados .= $dataNasc; //DATA NASCIMENTO
            $dados .= "|" . $row['sexo']; //SEXO

            if ($row['cor'] == 99) {
                $cor = 0;
            } else {

                $cor = $row['cor'];
            }

            $dados .= "|" . $cor; //COR
            $dados .= "|" . strtoupper($row['mae']); //NOME MAE


            if ($row['nacionalidade'] == 0) {
                $dados .= $nacionalidade = '|1'; //NACIONALIDADE
            } else {
                $dados .= "|" . $row['nacionalidade']; //NACIONALIDADE
            }

            $dados .= "|" . $row['uf_nascimento']; //UF NASCIMENTO
            $dados .= "|" . $row['municipio_nascimento']; //MUNICIPIO NASCIMENTO
            $dados .= "|BRA"; //UF NASCIMENTO

            $dados .= "|" . $row['aluno_deficiencia']; //SE ALUNO TEM DEFICIENCIA
            if ($row['aluno_deficiencia'] == 0 || $row['aluno_deficiencia'] == 2) {
                $dados .='|||||||||||||'; //OUTRAS DEFICICIAS = 0
            }
            $dados .= "\r\n";


            /*************TERCEIRA PARTE 42 ******************** */

            $dados .='42'; // TIPO
            $dados .='||'; //SEMESTRE REFERENCIA

            if ($row['cursos_id'] == '0000000003') {

                $codigoCurso = 112959;
            } else if ($row['cursos_id'] == '0000000001') {

                $codigoCurso = 80750;
            } else if ($row['cursos_id'] == '0000000002') {
                $codigoCurso = 87925;
            } else if ($row['cursos_id'] == '0000000004') {

                $codigoCurso = 110650;
            } else if ($row['cursos_id'] == '0000000009') {
                $codigoCurso = 87926;
            }


            $dados .= $codigoCurso; // CODIGO DO CURSO
            $dados .= "||"; // CODIGO CURSO A DISTANCIA
            $dados .= "|"; // ID DO ALUNO NA IES
            $dados .= $row['turno_id']; // TURNO
            $dados .= "|" . $row['situacao']; // SITUACAO ALUNO
            $dados .= "||"; // CODIGO DO CURSO

            if ($row['situacao'] == 6) {
                $dados .= "|2"; // SEMESTRE CONCLUSAO
            } else {
                $dados .= "|";
            }

            if ($row['cursos_id'] == '0000000004') {
                $dados .= "|0"; // ALUNO PARFOR
            } else {
                $dados .= "|";
            }

            if ($row['semestre_ano_ingresso']) {
                $dados .= "0" . $row['semestre_ano_ingresso'];
            } else {
                $Anoingresso = $this->agape_model->AnoingressoImpo($row['matricula']);

                if ($Anoingresso['semestre'] == 'I') {

                    $semestre = '01';
                } else {
                    $semestre = '02';
                }
                $dados .= $semestre . $Anoingresso['ano']; //SEMESTRE DE INGRESSO NO CURSO.
            }


            if($row['tipo_escola'] == 2){
                $tipo_escola = 0;
            }else{
                
                $tipo_escola = $row['tipo_escola'];
            }
            

            $dados .= "|" .$tipo_escola; //TIPO ESCOLA

            if ($row['forma_ingresso'] == 0) {

                $dados .= "|1"; //FORMA DE INGRESSO
            } else {
                $dados .= "|" . $row['forma_ingresso'];  //FORMA DE INGRESSO
            }

            if ($row['forma_ingresso'] == 1 || $row['forma_ingresso'] == 0) {

                $dados .= "|0"; // ENEM
                $dados .= "|0"; //AVALIÇÃO SERIADA
                $dados .= "|0"; //SELEÇÃO SIMPLIFICADA
                $dados .= "|0"; //EGRESSO BI/LI
                $dados .= "|0"; //PEC-G
                $dados .= "|0"; //TRANSFERENCIA DE EX OFICIO
                $dados .= "|0"; //DECISÃO JUDICIAL
                $dados .= "|0"; //SELEÇÃO PARA VAGAS REMANESCENTES
                $dados .= "|0"; //SELEÇÃO PARA VAGAS DE PROGRAMAS ESPECIAIS
            }

            $dados .= "|0"; //MOBILIDADE ACADEMICA
            $dados .= "||"; //TIPO MOBILIDADE
            $dados .= "|"; //IES DESTINO
            $dados .= "|"; //TIPO MOBILIDADE ACADEMICA INTERNACIONAL
            $dados .= "|"; //PAIS DESTINO
            $dados .= "0"; //PROGRAMA DE RESERVA DE VAGAS
            $dados .= "||"; //PROGRAMA DE RESERVA DE VAGAS (ETNICO)
            $dados .= "|"; //PROGRAMA DE RESERVA DE VAGAS (PESSOAS COM DEFICIENCIA)
            $dados .= "|"; //PROGRAMA DE RESERVA DE VAGAS (ESTUDANTE DE ESCOLA PUBLICA)
            $dados .= "|"; //PROGRAMA DE RESERVA DE VAGAS (SOCIAL/ RENDA FAMILIAR)
            $dados .= "|"; //PROGRAMA DE RESERVA DE VAGAS (OUTROS)


            if ($row['bolsista'] == 1) {

                $dados .= "1"; //FINANCIAMENTO ESTUDANTIL
                $DadosBolsa = $this->agape_model->SelectBolsaImportacao('0000021092');

                if ($DadosBolsa['bolsas_id'] == 4) {

                    $dados .= "|1"; //FIES
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //GOVERNO MUNICIPAL
                    $dados .= "|0"; //FINANCIAMENTO IES
                    $dados .= "|0"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //PRO UNI
                    $dados .= "|0"; //PRO UNI PARCIAL
                    $dados .= "|0"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //IES
                    $dados .= "|0|"; //GOVERNO MUNICIPAL
                } else if ($DadosBolsa['bolsas_id'] == 5) {


                    $dados .= "|0"; //FIES
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //GOVERNO MUNICIPAL
                    $dados .= "|0"; //FINANCIAMENTO IES
                    $dados .= "|0"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //PRO UNI
                    $dados .= "|0"; //PRO UNI PARCIAL
                    $dados .= "|0"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //IES
                    $dados .= "|1|"; //GOVERNO MUNICIPAL
                } else if ($DadosBolsa['bolsas_id'] == 6) {


                    $dados .= "|0"; //FIES
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //GOVERNO MUNICIPAL
                    $dados .= "|0"; //FINANCIAMENTO IES
                    $dados .= "|0"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //PRO UNI
                    $dados .= "|0"; //PRO UNI PARCIAL
                    $dados .= "|1"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //IES
                    $dados .= "|1|"; //GOVERNO MUNICIPAL
                } else if ($DadosBolsa['bolsas_id'] == 9) {
                    
                } else if ($DadosBolsa['bolsas_id'] == 11) {

                    $dados .= "|0"; //FIES
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //GOVERNO MUNICIPAL
                    $dados .= "|0"; //FINANCIAMENTO IES
                    $dados .= "|0"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //PRO UNI
                    $dados .= "|0"; //PRO UNI PARCIAL
                    $dados .= "|1"; //ENTIDADES EXTERNAS
                    $dados .= "|0"; //GOVERNO ESTADUAL
                    $dados .= "|0"; //IES
                    $dados .= "|1|"; //GOVERNO MUNICIPAL
                }
            } else {

                $dados .= "0"; //FINANCIAMENTO ESTUDANTIL
                $dados .= "||"; //FIES
                $dados .= "|"; //GOVERNO ESTADUAL
                $dados .= "|"; //GOVERNO MUNICIPAL
                $dados .= "|"; //FINANCIAMENTO IES
                $dados .= "|"; //ENTIDADES EXTERNAS
                $dados .= "|"; //PRO UNI
                $dados .= "|"; //PRO UNI PARCIAL
                $dados .= "|"; //ENTIDADES EXTERNAS
                $dados .= "|"; //GOVERNO ESTADUAL
                $dados .= "|"; //IES
                $dados .= "|"; //GOVERNO MUNICIPAL
            }

            $dados .= "0"; //APOIO SOCIAL
            $dados .= "||"; //TIPO APOIO ALIMENTACAO
            $dados .= "|"; //TIPO APOIO MORADIA
            $dados .= "|"; //TIPO APOIO TRANSPORTE
            $dados .= "|"; //TIPO APOIO MATERIAL DIDATICO
            $dados .= "|"; //BOLSA TRABALHO
            $dados .= "|"; //BOLSA PERMANENCIA

            $dados .= "0"; //ATIVIDADE EXTRACURRICULAR
            $dados .= "||"; //ATIVIDADE EXTRACURRICULAR PESQUISA
            $dados .= "|"; //BOLSA REMUNERAÇAO REFERENTE A ATIVIDADE EXTRACURRICULAR PESQUISA
            $dados .= "|"; //Atividade extracurricular- Extensão
            $dados .= "|"; //Bolsa/remuneração referente à atividade extracurricular- Extensão
            $dados .= "|"; //Atividade extracurricular - Monitoria
            $dados .= "|"; //Bolsa/remuneração referente à atividade extracurricular- Monitoria
            $dados .= "|"; //Atividade extracurricular- Estágio não obrigatório
            $dados .= "|"; //Bolsa/remuneração referente à atividade extracurricular- Estágio não obrigatório


            $dados .= "3020"; //CARGA HORARIA TOTAL DO CURSO POR ALUNO
            $dados .= "|1510"; //CARGA HORARIA INTEGRALIZADA PELO ALUNO.
            $dados .= "\r\n";


            /* a função fwrite escreve o valor da variável $texto no arquivo.txt se o arquivo não existe o php cria o arquivo */

        endforeach;

        fwrite($arquivo, $dados);

        /* a função fclose retira o arquivo.txt da memória o servidor */
        fclose($arquivo);


        $file = "aluno.txt";
        header("Content-type: application/save");
        header("Content-Length:" . filesize($file));
        header('Content-Disposition: attachment; filename=' . $file);
        header('Expires: 0');
        header('Pragma: no-cache');

        readfile("$file");
    }

}
