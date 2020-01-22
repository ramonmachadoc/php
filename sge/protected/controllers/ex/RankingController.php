<?php

class RankingController extends Controller
{

	public $defaultAction = 'visualizar';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('visualizar', 'BuscaClientes', 'BuscaVendedores'),
				'users' => array('@'),
				'expression' => 'Yii::app()->user->perfil < Funcionario::VENDEDOR',
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionVisualizar()
	{

		$funcionario = new Funcionario();

		if(isset($_POST['Funcionario'])){
			$funcionario->dataComparacaoRanking = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['Funcionario']['dataComparacaoRanking'])));
		}
		else{
			$funcionario->dataComparacaoRanking = date('Y-m-d');
		}

		$criteria = new CDbCriteria;

		if(Yii::app()->user->perfil == Funcionario::SUPERVISOR){
			$criteria->condition = 'perfil > 1 and supervisor_id = ' . Yii::app()->user->id;

			$vendas = new Cliente('search');
			$vendas->filter_vendas_ranking = true;
			$vendas->filter_supervisor = Yii::app()->user->id;
			$vendas->dataComparacaoRanking = $funcionario->dataComparacaoRanking;
			$vendas = $vendas->search()->getData();
//			dbg($vendas);

		}else{
			$criteria->condition = 'perfil > 1';
			
			$criteria2 = new CDbCriteria;
			
			$criteria2->condition = "YEAR(data_venda) = '"
				. date('Y', strtotime($funcionario->dataComparacaoRanking))
				. "' and MONTH(data_venda) = '"
				. date('m', strtotime($funcionario->dataComparacaoRanking))
				. "' order by data_venda DESC";
			
			$pages = new CPagination(count(Cliente::model()->findAll($criteria2)));
			$pages->pageSize = 100;
			$pages->applyLimit($criteria2);
			$vendas = Cliente::model()->findAll($criteria2);
		}


//		$pages = new CPagination(Funcionario::model()->count($criteria));
//		$pages->pageSize = 5;
//		$pages->applyLimit($criteria);

		/*$sort = new CSort();
		$sort->applyOrder($criteria);*/

		$funcionarios = Funcionario::model()->findAll($criteria);

		foreach($funcionarios as $func){
			//dbg($func);
			if($func->perfil == 3){
				if(Yii::app()->user->perfil == Funcionario::SUPERVISOR){
					$func->getQtdeAgendamentosVend($func->id_funcionario, $funcionario->dataComparacaoRanking);
					$vendedores[] = $func;
				}else{
					$func->getQtdeAgendamentosVend($func->id_funcionario, $funcionario->dataComparacaoRanking);
					$vendedores[] = $func;
				}
			}
			else{
				$supervisores[] = $func;
				$func->getQtdeAgendamentosSup($func->id_funcionario, $funcionario->dataComparacaoRanking);
			}

		}

		if(count($supervisores) > 0){
			usort($supervisores, function ($a, $b) {
				return $a->qtdAgendamentosSup < $b->qtdAgendamentosSup;
			});
		}

		if(count($vendedores) > 0){
			usort($vendedores, function ($a, $b) {
				return $a->qtdAgendamentosVend < $b->qtdAgendamentosVend;
			});
		}

		$funcionario->dataComparacaoRanking = date('d/m/Y',
			strtotime(
				$funcionario->dataComparacaoRanking
			)
		);

		$this->render('application.views.ranking.visualizar',
			array(
				'supervisores' => $supervisores,
				'vendedores'   => $vendedores,
				'funcionario'  => $funcionario,
				'vendas'       => $vendas,
				'pages'        => $pages,
				//'sort'         => $sort,
			)
		);
	}

	public function actionBuscaClientes($id,$data)
	{
		$data = explode('/',$data);
		$data = $data[2].'-'.$data[1].'-'.$data[0];

		$clientes = Cliente::model()->findAll("(data_cadastro BETWEEN '" . $data . " 00:00:00' and '" . $data . " 23:59:59') and id_funcionario = " . $id);

		$data = explode('-', $data);
		$data = $data[2] . '/' . $data[1] . '/' . $data[0];

		$this->layout = '//layouts/semhead';
		$this->render('application.views.ranking._clientes_modal',
			array(
				'clientes' => $clientes,
				'data'     => $data
			)
		);
	}

	public function actionBuscaVendedores()
	{
		$id = $_GET['id'];
		$data = $_GET['data'];

		$data2 = explode('/', $data);
		$data2 = $data2[2] . '-' . $data2[1] . '-' . $data2[0];

		$vendedores = Funcionario::model()->findAllByAttributes(array('supervisor_id' => $id));

		$this->layout = '//layouts/semhead';
		$this->render('application.views.ranking._vendedores_modal',
			array(
				'vendedores' => $vendedores,
				'data' => $data,
				'data2' => $data2,
			)
		);
	}
}