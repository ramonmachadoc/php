<?php

class ExportarController extends Controller
{
	public function accessRules()
	{
		return array(
			array('allow',
				  'actions'    => array('excel'),
				  'users'      => array('@'),
				  'expression' => 'isset(Yii::app()->user->perfil) and
				  ( Yii::app()->user->perfil == Permissao::ADMINISTRADOR or
					Yii::app()->user->perfil == Permissao::GERENTE       or
					Yii::app()->user->perfil == Permissao::AUDITOR )',
			),
			array('deny',
				'users'=>array('*'),
			),

		);
	}

	/*public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }*/

	public function actionExcel()
	{
	    // Load data with a CActiveDataProvider (note that we can easily apply conditions over the result set)
			$filtro = "";
			$area = Yii::app()->user->area_id;
			if($area <> 3){
				$filtro = 'area_id <> 3';
			}
	   	$eventos = Evento::model()->findAll($filtro);
	 	//dbg(count($eventos));
		/*$data = array(
            1 => array ('Sequencia'),
            $linhas
            //array('1111', '222'),
        );*/


        $cabecalho = array(
            1 => array(
            	'Sequência',
            	'Código',
	           	'Área',
            	'Empresa',
				'Setor',
            	'Data do Evento/Auditoria',
            	'Mes',
            	'Ano',
            	'Tipo de Evento',
            	'Origem Auditado',
            	'Auditor/Relator',
            	'Origem Auditor',
            	'Envio do PAC',
				'Prazo de Resposta',
				'Requisito',
				'Descrição do Requisito',
				'Descrição do Evento',
				'Criticidade',
				'Análise e Risco',
				'Probabilidade',
				'Severidade',
				'Risco',
				'Nível',
				'Responsável',
				'Contenção',
				'Prazo',
				'Status',





            ),
        );

		foreach ($eventos as $key => $evento) {
			//$linhas[] = Array($evt->evento_id);
			$linhas[] = array(
            		$evento->evento_id,
            		$evento->codigo,
            		$evento->area->descricao,
            		$evento->empresa->nome,
					$evento->setor->descricao,
            		$evento->dataevento,
					substr($evento->dataevento, 3, 2),
					substr($evento->dataevento, 6, 4),
            		$evento->tipoauditoria->descricao,
            		$evento->origemauditado->descricao,
					$evento->auditorrelator->nome,
					$evento->origemauditor->descricao,
					$evento->datacadastro,
					$evento->prazoresposta,
					$evento->requisito,
					$evento->descricaorequisito,
					$evento->descricaoevento,
					$evento->Criticidade->descricao,
					$evento->analisederisco,
					$evento->probabilidade,
					$evento->severidade,
					$evento->risco,
					$evento->nivel,



//$evento->contencao->responsavel,
//$evento->contencao->contencao,
//$evento->contencao->prazo,
//$evento->contencao->status,




        	);
		}







        Yii::import('application.extensions.phpexcel.JPhpExcel');

        $xls = new JPhpExcel('UTF-8', false, 'Eventos');
        //$xls->addArray($data);
        $xls->addArray($cabecalho);
        $xls->addArray($linhas);
        //$xls->generateXML('SGE-TODOS-OS-EVENTOS-'.date('d-m-Y'));
        $xls->generateXML('SGE');
	}

}
