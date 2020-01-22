<?php

class IndicadoresController extends Controller
{

	public function init()
	{
		//Yii::import('ext.fusioncharts.fusioncharts');
		Yii::import('ext.fusioncharts.FusionCharts');
	}

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 *
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				  'actions'    => array('gerar'),
				  'users'      => array('@'),
				  'expression' => 'isset(Yii::app()->user->perfil) and
				                   ( Yii::app()->user->perfil == Permissao::ADMINISTRADOR or
				                     Yii::app()->user->perfil == Permissao::GERENTE       or
				                     Yii::app()->user->perfil == Permissao::AUDITOR )',
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGerar()
	{
		$evento = new Evento();
		$evento->scenario = 'INDICADORES-PIZZA';

		if(isset($_POST['Evento'])){

			$evento->attributes = $_POST['Evento'];

			if($evento->validate()){
				/*$result = Evento::model()->searchIndicadores($evento);

				if(!empty($result))
					$configChart = $this->calculaCriticidade($result);
				else
					Yii::app()->user->setFlash('warning', "Não existe indicador para o filtro selecionado!");*/


				$queryCompany 		= !empty($evento->empresa_id) 		? " evento.empresa_id  = ".$evento->empresa_id 					: " 1 = 1";
				$queryCriticidade 	= !empty($evento->criticidade) 		? " evento.criticidade = '".$evento->criticidade."'" 			: " 1 = 1";
				$queryTipoAuditoria = !empty($evento->tipoauditoria_id) ? " evento.tipoauditoria_id = '".$evento->tipoauditoria_id."'" 	: " 1 = 1";

				$iosa 		= !empty($evento->tipoauditoria_id) ? " evento.tipoauditoria_id = '".$evento->tipoauditoria_id."'" : " evento.tipoauditoria_id = 10";
				$sgq 		= !empty($evento->tipoauditoria_id) ? " evento.tipoauditoria_id = '".$evento->tipoauditoria_id."'" : " evento.tipoauditoria_id = 6";

				$audInterna = !empty($evento->tipoauditoria_id) ? " evento.tipoauditoria_id = '".$evento->tipoauditoria_id."'" : " evento.tipoauditoria_id IN (6,10,14,15)";

				$nameTpAuditoriaIosa = "IOSA (GERAL)";
				if(!empty($evento->tipoauditoria_id)){
					$tpAuditoria = Tipoauditoria::model()->findByPk($evento->tipoauditoria_id);
					$nameTpAuditoriaIosa = $tpAuditoria->descricao;
				}

				// % POR TIPO DE NÃO CONFORMIDADE
				// RAMON MACHADO
				$sqlTipo = "SELECT tipoauditoria.descricao, count(evento.tipoauditoria_id) qntd,
				count(evento.tipoauditoria_id) / (select count(*) as total
				FROM evento) as percent
				FROM evento INNER JOIN tipoauditoria ON evento.tipoauditoria_id = tipoauditoria.tipoauditoria_id
				WHERE evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
				AND {$queryCompany}
				GROUP BY evento.tipoauditoria_id";

				$tipoNConformidade = Yii::app()->db->createCommand($sqlTipo)->queryAll();
				$pieTipoNC = array();

				foreach ($tipoNConformidade as $key => $value) {
					$pieTipoNC[] = array(
						"label" => $value['descricao'],
						"value" => $value['qntd']
					);
				}

				// TIPO DE NÃO CONFORMIDADE - IOSA (GERAL)
				$sql = "SELECT criticidade.*, COUNT(evento.evento_id) as num_evento
						FROM evento
						INNER JOIN criticidade ON criticidade.id_criticidade = evento.criticidade_id
						WHERE evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
						AND {$queryCompany}
						AND {$queryCriticidade}
						AND {$iosa}
						GROUP BY criticidade.id_criticidade
						ORDER BY criticidade.descricao";

				$nConformidadeIosa = Yii::app()->db->createCommand($sql)->queryAll();
				$chart1 = array();
				foreach ($nConformidadeIosa as $key => $value) {
					$chart1[] = array(
						"label" => $value['descricao'],
						"value" => $value['num_evento'],
					);
				}

				if(trim($sgq) == trim("evento.tipoauditoria_id = 6")){

					// TIPO DE NÃO CONFORMIDADE  - SGQ
					$sql = "SELECT criticidade.*, COUNT(evento.evento_id) as num_evento
							FROM evento
							INNER JOIN criticidade ON criticidade.id_criticidade = evento.criticidade_id
							WHERE  evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
							AND {$queryCompany}
							AND {$queryCriticidade}
							AND {$sgq}
							GROUP BY criticidade.id_criticidade
							ORDER BY criticidade.descricao";

					$nConformidadeSGQ = Yii::app()->db->createCommand($sql)->queryAll();
					$chart2 = array();
					foreach ($nConformidadeSGQ as $key => $value) {
						$chart2[] = array(
							"label" => $value['descricao'],
							"value" => $value['num_evento'],
						);
					}
				}

				// TIPOS DE AUDITORIA GERAL
				$sql = "SELECT tipoauditoria.*, COUNT(evento.evento_id) as num_evento
						FROM evento
						INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
						AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
						AND {$queryCompany}
						AND {$queryCriticidade}
						GROUP BY tipoauditoria.tipoauditoria_id
						ORDER BY tipoauditoria.descricao";

				$tipoAuditoriaGeral = Yii::app()->db->createCommand($sql)->queryAll();
				$chart3 = array();
				foreach ($tipoAuditoriaGeral as $key => $value) {
					$chart3[] = array(
						"label" => $value['descricao'],
						"value" => $value['num_evento'],
					);
				}

				//-------------------------------------------------------------------------------------------------------------------------------//

				//TIPO DE NÃO CONFORMIDADE POR SETOR - IOSA
				$sqlSetores = " SELECT DISTINCT setor.*
								FROM setor
								INNER JOIN evento ON evento.setor_id = setor.setor_id
								INNER JOIN criticidade ON criticidade.id_criticidade = evento.criticidade_id
								WHERE  evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
								AND {$queryCompany}
								AND {$queryCriticidade}
								AND {$iosa};";

				$sqlCriticidade = " SELECT DISTINCT criticidade.*
									FROM criticidade
									INNER JOIN evento ON evento.criticidade_id = criticidade.id_criticidade
									WHERE  evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
									AND {$queryCompany}
									AND {$queryCriticidade}
									AND {$iosa};";

				$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();
				$criticidades 	= Yii::app()->db->createCommand($sqlCriticidade)->queryAll();



				$datasetChart4 = array();
				$categoryChart4 = array();
				$cont = 0;
				foreach ($criticidades as $key1 => $c) {

					$datasetChart4[$cont]["seriesname"] = $c['descricao'];

					foreach ($setores as $key2 => $s) {
						$sql = "SELECT criticidade.*, COUNT(evento.evento_id) as num_evento
								FROM evento
								INNER JOIN criticidade ON criticidade.id_criticidade = evento.criticidade_id
								WHERE  evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
								AND {$iosa}
								AND {$queryCompany}
								AND evento.setor_id = $s[setor_id]
								AND evento.criticidade_id = $c[id_criticidade]

								GROUP BY criticidade.id_criticidade
								ORDER BY criticidade.descricao;";
						$r = Yii::app()->db->createCommand($sql)->queryAll();

						if($cont == 0){
							$categoryChart4[] = array(
								"label" => $s['descricao'],
							);
						}

						$datasetChart4[$cont]["data"][] = array("value" => @$r[0]['num_evento'], "setor" => $s['descricao']);

					}

					$cont++;

				}

				//TIPO DE NÃO CONFORMIDADE POR SETOR - SGQ
				if(trim($sgq) == trim("evento.tipoauditoria_id = 6")){

					$sqlSetores = " SELECT DISTINCT setor.*
									FROM setor
									INNER JOIN evento ON evento.setor_id = setor.setor_id
									WHERE evento.tipoauditoria_id = 6
									AND {$queryCompany}
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";

					$sqlCriticidade = " SELECT DISTINCT criticidade.*
										FROM criticidade
										INNER JOIN evento ON evento.criticidade_id = criticidade.id_criticidade
										WHERE evento.tipoauditoria_id = 6
										AND {$queryCompany}
										AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";

					$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();
					$criticidades 	= Yii::app()->db->createCommand($sqlCriticidade)->queryAll();

					$datasetChart5 = array();
					$categoryChart5 = array();
					$cont = 0;
					foreach ($criticidades as $key1 => $c) {

						$datasetChart5[$cont]["seriesname"] = $c['descricao'];

						foreach ($setores as $key2 => $s) {
							$sql = "SELECT criticidade.*, COUNT(evento.evento_id) as num_evento
									FROM evento
									INNER JOIN criticidade ON criticidade.id_criticidade = evento.criticidade_id
									WHERE evento.tipoauditoria_id = 6
									AND {$queryCompany}
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
									AND evento.setor_id = $s[setor_id]
									AND evento.criticidade_id = $c[id_criticidade]
									GROUP BY criticidade.id_criticidade
									ORDER BY criticidade.descricao;";
							$r = Yii::app()->db->createCommand($sql)->queryAll();

							if($cont == 0){
								$categoryChart5[] = array(
									"label" => $s['descricao'],
								);
							}

							$datasetChart5[$cont]["data"][] = array("value" => @$r[0]['num_evento'], "setor" => $s['descricao']);

						}

						$cont++;
					}

				}


				// STATUS GERAL AUDITORIA INTERNA POR SETOR - SGQ
				$arrayStatus = array(
					"Encerrado" => "AND evento.`status` = 'F'
									AND evento.acompanhado IS NULL",
					"Em dia"	=> "AND evento.prazoresposta >= DATE(NOW())",
					"Atrasado"  => "AND evento.prazoresposta < DATE(NOW())"
				);

				$sqlSetores = " SELECT DISTINCT setor.*
								FROM setor
								INNER JOIN evento ON evento.setor_id = setor.setor_id
								WHERE evento.tipoauditoria_id IN (6,10,14,15)
								AND {$queryCompany}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
				$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();

				$datasetChart6 = array();
				$categoryChart6 = array();
				$cont = 0;

				foreach ($arrayStatus as $key1 => $stat) {

					$datasetChart6[$cont]["seriesname"] = $key1;

					foreach ($setores as $key2 => $s) {
						$sql = "SELECT COUNT(evento.evento_id) as total_evento
								FROM evento
								WHERE evento.setor_id = $s[setor_id]
								AND {$queryCompany}
								AND {$audInterna}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
								{$stat};";
						$r = Yii::app()->db->createCommand($sql)->queryAll();

						if($cont == 0){
							$categoryChart6[] = array(
								"label" => $s['descricao'],
							);
						}

						$datasetChart6[$cont]["data"][] = array("value" => @$r[0]['total_evento']);

					}

					$cont++;

				}

				//STATUS ENVIO PAC AUDITORIA INTERNA - SGQ
				$arrayStatus = array(
					"Encerrado" => "AND evento.`status` = 'F'",
					"Em dia"	=> "AND evento.status <> 'F' AND evento.prazoresposta >= DATE(NOW()) AND evento.statusplanoacao <> 'F'",
					"Atrasado"  => "AND evento.status <> 'F' AND evento.prazoresposta < DATE(NOW())"
				);

				$sqlSetores = " SELECT DISTINCT setor.*
								FROM setor
								INNER JOIN evento ON evento.setor_id = setor.setor_id
								INNER JOIN planoacao ON planoacao.evento_id = evento.evento_id
								WHERE evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
								AND {$audInterna}
								AND {$queryCompany};";
				$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();

				$datasetChart7 = array();
				$categoryChart7 = array();
				$cont = 0;

				foreach ($arrayStatus as $key1 => $stat) {

					$datasetChart7[$cont]["seriesname"] = $key1;

					foreach ($setores as $key2 => $s) {
						$sql = "SELECT COUNT(evento.evento_id) as total_evento
								FROM evento
								INNER JOIN planoacao ON planoacao.evento_id = evento.evento_id
								WHERE evento.setor_id = $s[setor_id]
								AND {$queryCompany}
								AND {$audInterna}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
								{$stat};";
						$r = Yii::app()->db->createCommand($sql)->queryAll();

						if($cont == 0){
							$categoryChart7[] = array(
								"label" => $s['descricao'],
							);
						}

						$datasetChart7[$cont]["data"][] = array("value" => @$r[0]['total_evento']);
					}

					$cont++;

				}


				//STATUS DA AÇÃO DE CONTENÇÃO POR SETOR - IOSA GERAL
				$arrayStatus = array(
					"EM DIA" 		=> "AND contencao.prazo >= DATE(NOW()) AND contencao.aplicavel = 'S'",
					"NÃO APLICÁVEL"	=> "AND contencao.aplicavel = 'N'",
					"ATRASADO"		=> "AND contencao.prazo < DATE(NOW()) AND contencao.aplicavel = 'S' and evento.statusplanoacao = null",
				);

				$sqlSetores = " SELECT DISTINCT setor.*
								FROM setor
								INNER JOIN evento ON evento.setor_id = setor.setor_id
								INNER JOIN contencao ON contencao.evento_id = evento.evento_id
								WHERE {$iosa}
								AND {$queryCompany}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
				$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();

				$datasetChart8 = array();
				$categoryChart8 = array();
				$cont = 0;

				foreach ($arrayStatus as $key1 => $stat) {

					$datasetChart8[$cont]["seriesname"] = $key1;

					foreach ($setores as $key2 => $s) {
						$sql = "SELECT COUNT(evento.evento_id) as total_evento
								FROM evento
								INNER JOIN contencao ON contencao.evento_id = evento.evento_id
								WHERE evento.setor_id = $s[setor_id]
								AND {$queryCompany}
								AND {$iosa}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
								{$stat};";
						$r = Yii::app()->db->createCommand($sql)->queryAll();

						if($cont == 0){
							$categoryChart8[] = array(
								"label" => $s['descricao'],
							);
						}

						$datasetChart8[$cont]["data"][] = array("value" => @$r[0]['total_evento']);

					}

					$cont++;

				}




				if(trim($sgq) == trim("evento.tipoauditoria_id = 6")){

					//STATUS DA AÇÃO DE CONTENÇÃO POR SETOR - SGQ GERAL
					$arrayStatus = array(
						"EM DIA" 		=> "AND contencao.prazo >= DATE(NOW()) AND contencao.aplicavel = 'S'",
						"NÃO APLICÁVEL"	=> "AND contencao.aplicavel = 'N'",
					);

					$sqlSetores = " SELECT DISTINCT setor.*
									FROM setor
									INNER JOIN evento ON evento.setor_id = setor.setor_id
									INNER JOIN contencao ON contencao.evento_id = evento.evento_id
									WHERE {$sgq}
									AND {$queryCompany}
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
					$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();

					$datasetChart9 = array();
					$categoryChart9 = array();
					$cont = 0;

					foreach ($arrayStatus as $key1 => $stat) {

						$datasetChart9[$cont]["seriesname"] = $key1;

						foreach ($setores as $key2 => $s) {
							$sql = "SELECT COUNT(evento.evento_id) as total_evento
									FROM evento
									INNER JOIN contencao ON contencao.evento_id = evento.evento_id
									WHERE evento.setor_id = $s[setor_id]
									AND {$queryCompany}
									AND {$sgq}
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."'
									{$stat};";
							$r = Yii::app()->db->createCommand($sql)->queryAll();

							if($cont == 0){
								$categoryChart9[] = array(
									"label" => $s['descricao'],
								);
							}

							$datasetChart9[$cont]["data"][] = array("value" => @$r[0]['total_evento']);

						}

						$cont++;

					}
				}

				//STATUS DA AÇÃO DE CORREÇÃO POR SETOR - IOSA GERAL
				$arrayStatus = array(
					"Encerrado" => "AND p2.`status` = 'F'",
					"Em dia"	=> "AND p2.prazo >= DATE(NOW()) AND p2.status <> 'F'",
					"Atrasado"  => "AND p2.prazo < DATE(NOW()) AND p2.status NOT IN ('F', 'E', 'I')"
				);

				$sqlSetores = " SELECT DISTINCT CONCAT( setor.descricao,' - ' ,tipoauditoria.descricao) as setor, setor.setor_id, setor.descricao
								FROM setor
								INNER JOIN evento ON evento.setor_id = setor.setor_id
								INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
								INNER JOIN planoacao ON planoacao.evento_id = evento.evento_id
								WHERE {$iosa}
								AND {$queryCompany}
								/*AND planoacao.planoacao_id = (SELECT p2.planoacao_id
															  FROM planoacao p2
															  WHERE evento_id = evento.evento_id
															  ORDER BY planoacao_id DESC LIMIT 1)*/
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";


				$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();




				$datasetChart10 = array();
				$categoryChart10 = array();
				$cont = 0;

				foreach ($arrayStatus as $key1 => $stat) {

					$datasetChart10[$cont]["seriesname"] = $key1;

					foreach ($setores as $key2 => $s) {
						$sql = "SELECT COUNT(evento.evento_id) as total_evento
								FROM evento
								INNER JOIN planoacao ON planoacao.evento_id = evento.evento_id
								INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
								WHERE evento.setor_id = $s[setor_id]
								AND {$queryCompany}
								AND {$iosa}
								AND planoacao.planoacao_id = (SELECT p2.planoacao_id
															  FROM planoacao p2
															  WHERE evento_id = evento.evento_id
															  {$stat}
															  ORDER BY planoacao_id DESC LIMIT 1)

								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
						$r = Yii::app()->db->createCommand($sql)->queryAll();

						if($cont == 0){
							$categoryChart10[] = array(
								"label" => $s['descricao'],
							);
						}

						$datasetChart10[$cont]["data"][] = array("value" => @$r[0]['total_evento']);
					}

					$cont++;

				}





				if(trim($sgq) == trim("evento.tipoauditoria_id = 6")){
					//STATUS DA AÇÃO DE CORREÇÃO POR SETOR - SGQ GERAL
					$arrayStatus = array(
						"Encerrado" => "AND p2.`status` = 'F'",
						"Em dia"	=> "AND p2.prazo >= DATE(NOW()) AND p2.status <> 'F'",
						"Atrasado"  => "AND p2.prazo < DATE(NOW()) AND p2.status NOT IN ('F', 'E', 'I')"
					);

					$sqlSetores = " SELECT DISTINCT CONCAT( setor.descricao,' - ' ,tipoauditoria.descricao) as setor, setor.setor_id, setor.descricao
									FROM setor
									INNER JOIN evento ON evento.setor_id = setor.setor_id
									INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
									INNER JOIN planoacao ON planoacao.evento_id = evento.evento_id
									WHERE {$sgq}
									AND {$queryCompany}
									/*AND planoacao.planoacao_id = (SELECT p2.planoacao_id
																  FROM planoacao p2
																  WHERE evento_id = evento.evento_id
																  ORDER BY planoacao_id DESC LIMIT 1)*/
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";


					$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();




					$datasetChart11 = array();
					$categoryChart11 = array();
					$cont = 0;

					foreach ($arrayStatus as $key1 => $stat) {

						$datasetChart11[$cont]["seriesname"] = $key1;

						foreach ($setores as $key2 => $s) {
							$sql = "SELECT COUNT(evento.evento_id) as total_evento
									FROM evento
									INNER JOIN planoacao ON planoacao.evento_id = evento.evento_id
									INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
									WHERE evento.setor_id = $s[setor_id]
									AND {$queryCompany}
									AND {$sgq}
									AND planoacao.planoacao_id = (SELECT p2.planoacao_id
																  FROM planoacao p2
																  WHERE evento_id = evento.evento_id
																  {$stat}
																  ORDER BY planoacao_id DESC LIMIT 1)

									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
							$r = Yii::app()->db->createCommand($sql)->queryAll();

							if($cont == 0){
								$categoryChart11[] = array(
									"label" => $s['descricao'],
								);
							}

							$datasetChart11[$cont]["data"][] = array("value" => @$r[0]['total_evento']);
						}

						$cont++;

					}
				}



				//STATUS DA AÇÃO DO ENCERRAMENTO POR SETOR - IOSA GERAL (QTD EVENTOS COM ACOMPANHAMENTO AGUARDANDO)
				$arrayStatus = array(
					"Concluido" => "evento.status = 'F' AND evento.acompanhado = 'S'",
					"Pendente Acompanhamento"	=> "evento.acompanhado <> 'S' ",
				);

				$sqlSetores = " SELECT DISTINCT CONCAT( setor.descricao,' - ' ,tipoauditoria.descricao) as setor, setor.setor_id, setor.descricao
								FROM setor
								INNER JOIN evento ON evento.setor_id = setor.setor_id
								INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
								WHERE {$iosa}
								AND {$queryCompany}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
				$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();

				$datasetChart12 = array();
				$categoryChart12 = array();
				$cont = 0;

				foreach ($arrayStatus as $key1 => $stat) {

					$datasetChart12[$cont]["seriesname"] = $key1;

					foreach ($setores as $key2 => $s) {
						$sql = "SELECT COUNT(evento.evento_id) as total_evento
								FROM evento
								INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
								WHERE evento.setor_id = $s[setor_id]
								AND {$queryCompany}
								AND {$iosa}
								AND {$stat}
								AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
						$r = Yii::app()->db->createCommand($sql)->queryAll();

						if($cont == 0){
							$categoryChart12[] = array(
								"label" => $s['descricao'],
							);
						}

						$datasetChart12[$cont]["data"][] = array("value" => @$r[0]['total_evento']);
					}

					$cont++;

				}

				if(trim($sgq) == trim("evento.tipoauditoria_id = 6")){
					//STATUS DA AÇÃO DO ENCERRAMENTO POR SETOR - IOSA GERAL (QTD EVENTOS COM ACOMPANHAMENTO AGUARDANDO)
					$arrayStatus = array(
						"Concluido" => "evento.status = 'F' AND evento.acompanhado = 'S'",
						"Pendente Acompanhamento"	=> "evento.acompanhado <> 'S' ",
					);

					$sqlSetores = " SELECT DISTINCT CONCAT( setor.descricao,' - ' ,tipoauditoria.descricao) as setor, setor.setor_id, setor.descricao
									FROM setor
									INNER JOIN evento ON evento.setor_id = setor.setor_id
									INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
									WHERE {$sgq}
									AND {$queryCompany}
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
					$setores 		= Yii::app()->db->createCommand($sqlSetores)->queryAll();

					$datasetChart13 = array();
					$categoryChart13 = array();
					$cont = 0;

					foreach ($arrayStatus as $key1 => $stat) {

						$datasetChart13[$cont]["seriesname"] = $key1;

						foreach ($setores as $key2 => $s) {
							$sql = "SELECT COUNT(evento.evento_id) as total_evento
									FROM evento
									INNER JOIN tipoauditoria ON tipoauditoria.tipoauditoria_id = evento.tipoauditoria_id
									WHERE evento.setor_id = $s[setor_id]
									AND {$queryCompany}
									AND {$sgq}
									AND {$stat}
									AND evento.dataevento BETWEEN '".Utils::converte($evento->_dtInicialFilter)."'   AND '".Utils::converte($evento->_dtFinalFilter)."';";
							$r = Yii::app()->db->createCommand($sql)->queryAll();

							if($cont == 0){
								$categoryChart13[] = array(
									"label" => $s['descricao'],
								);
							}

							$datasetChart13[$cont]["data"][] = array("value" => @$r[0]['total_evento']);
						}

						$cont++;

					}
				}

			}

		}

		$this->render('graficos',
			array(
				'evento' => $evento,

				'chart1' => CJSON::encode(@array("chart" => $chart1, "subtitle"=>$nameTpAuditoriaIosa)),
				'chart2' => CJSON::encode(@$chart2),
				'chart3' => CJSON::encode(@$chart3),
				'pieTipoNC' => CJSON::encode(@$pieTipoNC),
				"categoryChart4"	=> CJSON::encode(@$categoryChart4),
				"datasetChart4" 	=> CJSON::encode(@$datasetChart4),
				"categoryChart5"	=> CJSON::encode(@$categoryChart5),
				"datasetChart5" 	=> CJSON::encode(@$datasetChart5),
				"categoryChart6"	=> CJSON::encode(@$categoryChart6),
				"datasetChart6" 	=> CJSON::encode(@$datasetChart6),
				"categoryChart7"	=> CJSON::encode(@$categoryChart7),
				"datasetChart7" 	=> CJSON::encode(@$datasetChart7),
				"categoryChart8"	=> CJSON::encode(@$categoryChart8),
				"datasetChart8" 	=> CJSON::encode(@$datasetChart8),
				"categoryChart9"	=> CJSON::encode(@$categoryChart9),
				"datasetChart9" 	=> CJSON::encode(@$datasetChart9),
				"categoryChart10"	=> CJSON::encode(@$categoryChart10),
				"datasetChart10" 	=> CJSON::encode(@$datasetChart10),
				"categoryChart11"	=> CJSON::encode(@$categoryChart11),
				"datasetChart11" 	=> CJSON::encode(@$datasetChart11),
				"categoryChart12"	=> CJSON::encode(@$categoryChart12),
				"datasetChart12" 	=> CJSON::encode(@$datasetChart12),
				"categoryChart13"	=> CJSON::encode(@$categoryChart13),
				"datasetChart13" 	=> CJSON::encode(@$datasetChart13),
			)
		);

		/*$this->render('index',array(
			'evento'      => $evento,
			'configChart' => $configChart,
		));*/
	}

	private function calculaCriticidade($result){
		for( $i = 0; $i < count($result); $i++ ) {

			switch ($result[$i]['label']) {
				case 'CRITCD01':
					$result[$i]['label'] = 'Maior';
				break;
				case 'CRITCD02':
					$result[$i]['label'] = 'Menor';
				break;
				case 'CRITCD03':
					$result[$i]['label'] = 'Observação';
				break;
				case 'CRITCD04':
					$result[$i]['label'] = 'Crítica';
				break;
				case 'CRITCD05':
					$result[$i]['label'] = 'Documentado e Não Implementado';
				break;
				case 'CRITCD06':
					$result[$i]['label'] = 'Implementado e Não Documentado';
				break;
				case 'CRITCD07':
					$result[$i]['label'] = 'Documentado e Implementado';
				break;
				case 'CRITCD08':
					$result[$i]['label'] = 'Não Documentado e Não Implementado';
				break;
				case 'CRITCD09':
					$result[$i]['label'] = 'N/A';
				break;
				case 'CRITCD10':
					$result[$i]['label'] = 'Documentado e Implementado - Observação';
				break;
				case 'CRITCD11':
					$result[$i]['label'] = 'Documentado e Implementado - Recomendação';
				break;
			}
		}

		return $result;
	}


}
