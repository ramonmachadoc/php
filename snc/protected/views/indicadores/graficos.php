<?php
	$d = DIRECTORY_SEPARATOR;
	$pathFC = join ($d, array(Yii::app()->basePath, 'extensions', "fusioncharts", "fusioncharts.php"));
	include_once($pathFC);
?>


<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->request->baseUrl.'/js/fusioncharts/fusioncharts.js'); ?>

<h3 id='tituloPagina'><i class="fa fa-retweet"></i> Indicadores</h3>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'indicadores-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<?php echo $form->errorSummary($evento); ?>

	<!-- DATA INICIO -->
	<?php echo $form->datePickerGroup($evento, '_dtInicialFilter',
		array(
			'widgetOptions' => array(
				'options' => array(
					'format'     => 'dd/mm/yyyy',
					'viewformat' => 'yyyy-mm-dd',
					'autoclose'  => true,
				)
			),
			'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
		)
	); ?>

	<!-- DATA FIM -->
	<?php echo $form->datePickerGroup($evento, '_dtFinalFilter',
		array(
			'widgetOptions' => array(
				'options' => array(
					'format'     => 'dd/mm/yyyy',
					'viewformat' => 'yyyy-mm-dd',
					'autoclose'  => true,
				)
			),
			'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
		)
	); ?>

	<!-- EMPRESA -->
	<?php echo $form->dropDownListGroup($evento, 'empresa_id',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'data' => CHtml::listData(Empresa::model()->findAll(),'empresa_id','nome'),
				'htmlOptions' => array(
					'empty' => '...:: Todas as Empresa ::...',
				),
			)
		)
	); ?>

	<!-- CRITICIDADE -->
	<?php echo $form->dropDownListGroup($evento, 'criticidade',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'data' => $evento->getCriticidadeOptions(),
				'htmlOptions' => array(
					'empty'    => '...:: Todas Criticidades ::...',
					//'style'    => 'width: 400px;',
				),
			)
		)
	); ?>

	<?php echo $form->dropDownListGroup($evento, 'tipoauditoria_id',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'data' => CHtml::listData(Tipoauditoria::model()->findAll(array("order"=>"sigla")),'tipoauditoria_id', "descricao" , "sigla"),
				'htmlOptions' => array(
					'empty' => '...:: Todos os Tipos de Evento ::...',
					'onchange'=>'preenchecodigoevento(this.value)',
				),
			)
		)
	); ?>

	<!-- BOTAO -->
	<br>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'    => 'primary',
			'label'      => 'Pesquisar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>


<!-- Alerta de SUCESSO -->
<?php $this->widget('booster.widgets.TbAlert', array(
    'fade'            => true,
    'closeText'       => false,
    'events'          => array(),
    'htmlOptions'     => array('id'=>'flash-success'),
    'userComponentId' => 'user',
));

Yii::app()->clientScript->registerScript('myHideEffect', '$("#flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY); ?>

<?php


if (isset($_POST['Evento'])) {

	$jsonDecode = json_decode($chart1);
	$chart1     = json_encode($jsonDecode->chart);
	$subtitle   = $jsonDecode->subtitle;

	// % POR TIPO DE NÃO CONFORMIDADE
	// RAMON MACHADO
	$pie3dChartNC = new FusionCharts("pie3d", "ex1", "100%", 400, "chart-1", "json", '{   "chart": {
	        "caption": "% TIPO DE NÃO CONFORMIDADE",
	        "palette": "2",
	        "startingangle": "125",
	        "showlabels": "0",
	        "showlegend": "1",
	        "showborder": "0",
	        "showpercentvalues": "0",
	        "showpercentintooltip": "1",
	        "plottooltext": "$label: $datavalue",
	        "animation": "1",
	        "formatnumberscale": "1",
	        "decimals": "0",
	        "pieslicedepth": "30",
	        "dataEmptyMessage" : "Nenhum resultado Encontrado",
	    },
	    "data": '.$pieTipoNC.'
	}');
	// Render the chart
	$pie3dChartNC->render();

	$pie3dChart = new FusionCharts("pie3d", "ex1", "100%", 400, "chart-1", "json", '{   "chart": {
	        "caption": "TIPO DE NÃO CONFORMIDADE",
	        "subcaption": "'.$subtitle.'",
	        "palette": "2",
	        "startingangle": "125",
	        "showlabels": "0",
	        "showlegend": "1",
	        "showborder": "0",
	        "showpercentvalues": "0",
	        "showpercentintooltip": "1",
	        "plottooltext": "$label: $datavalue",
	        "animation": "1",
	        "formatnumberscale": "1",
	        "decimals": "0",
	        "pieslicedepth": "30",
	        "dataEmptyMessage" : "Nenhum resultado Encontrado",
	    },
	    "data": '.$chart1.'
	}');
	// Render the chart
	$pie3dChart->render();

	if($chart2 != "null"){
		$pie3dChart = new FusionCharts("pie3d", "ex2", "100%", 400, "chart-2", "json", '{   "chart": {
		        "caption": "TIPO DE NÃO CONFORMIDADE",
		        "subcaption": "SGQ (GERAL)",
		        "palette": "2",
		        "startingangle": "125",
		        "showlabels": "0",
		        "showlegend": "1",
		        "showborder": "0",
		        "showpercentvalues": "0",
		        "showpercentintooltip": "1",
		        "plottooltext": "$label: $datavalue",
		        "animation": "1",
		        "formatnumberscale": "1",
		        "decimals": "0",
		        "pieslicedepth": "30",

		    },
		    "data": '.$chart2.'
		}');
		// Render the chart
		$pie3dChart->render();
	}

	$pie3dChart = new FusionCharts("pie3d", "ex3", "100%", 400, "chart-3", "json", '{   "chart": {
	        "caption": "TIPOS DE AUDITORIA GERAL",
	        "palette": "2",
	        "startingangle": "125",
	        "showlabels": "0",
	        "showlegend": "1",
	        "showborder": "0",
	        "showpercentvalues": "0",
	        "showpercentintooltip": "1",
	        "plottooltext": "$label: $datavalue",
	        "animation": "1",
	        "formatnumberscale": "1",
	        "decimals": "0",
	        "pieslicedepth": "30",

	    },
	    "data": '.$chart3.'
	}');
	// Render the chart
	$pie3dChart->render();

	$stackedBar2d = new FusionCharts("stackedbar2d", "ex4", "100%", 400, "chart-4", "json", '{   "chart": {
	        "caption": "TIPO DE NÃO CONFORMIDADE POR SETOR - '.$subtitle.'",
	        "xAxisname": "Setor",
	        "yAxisName": "Qtd. Eventos",
	        "bgColor": "#ffffff",
	        "borderAlpha": "20",
	        "showborder": "0",
	        "showCanvasBorder": "0",
	        "usePlotGradientColor": "0",
	        "plotBorderAlpha": "10",
	        "legendBorderAlpha": "0",
	        "legendShadow": "0",
	        "valueFontColor": "#ffffff",
	        "showXAxisLine": "1",
	        "xAxisLineColor": "#999999",
	        "divlineColor": "#999999",
	        "divLineDashed": "1",
	        "showAlternateVGridColor": "0",
	        "subcaptionFontBold": "0",
	        "subcaptionFontSize": "14",
	        "showHoverEffect": "1"
	    },
	    "categories": [
	        {
	            "category": '.$categoryChart4.'
	        }
	    ],
	    "dataset": '.$datasetChart4.'

	}');
	// Render the chart
	$stackedBar2d->render();


	if($datasetChart5 != "null"){


		$stackedBar2d = new FusionCharts("stackedbar2d", "ex5", "100%", 400, "chart-5", "json", '{   "chart": {
		        "caption": "TIPO DE NÃO CONFORMIDADE POR SETOR -  SGQ",
		        "xAxisname": "Setor",
		        "yAxisName": "Qtd. Eventos",
		        "bgColor": "#ffffff",
		        "borderAlpha": "20",
		        "showborder": "0",
		        "showCanvasBorder": "0",
		        "usePlotGradientColor": "0",
		        "plotBorderAlpha": "10",
		        "legendBorderAlpha": "0",
		        "legendShadow": "0",
		        "valueFontColor": "#ffffff",
		        "showXAxisLine": "1",
		        "xAxisLineColor": "#999999",
		        "divlineColor": "#999999",
		        "divLineDashed": "1",
		        "showAlternateVGridColor": "0",
		        "subcaptionFontBold": "0",
		        "subcaptionFontSize": "14",
		        "showHoverEffect": "1"
		    },
		    "categories": [
		        {
		            "category": '.$categoryChart5.'
		        }
		    ],
		    "dataset": '.$datasetChart5.'

		}');
		// Render the chart
		$stackedBar2d->render();
	}

	$nameInterna = $subtitle == 'IOSA (GERAL)' ? "AUDITORIA INTERNA" : $subtitle;

	$stackedBar2d = new FusionCharts("stackedbar2d", "ex6", "100%", 400, "chart-6", "json", '{   "chart": {
	        "caption": "STATUS GERAL '. strtoupper($nameInterna).'  POR SETOR",
	        "xAxisname": "Setor",
	        "yAxisName": "Qtd. Eventos",
	        "bgColor": "#ffffff",
	        "borderAlpha": "20",
	        "showborder": "0",
	        "showCanvasBorder": "0",
	        "usePlotGradientColor": "0",
	        "plotBorderAlpha": "10",
	        "legendBorderAlpha": "0",
	        "legendShadow": "0",
	        "valueFontColor": "#ffffff",
	        "showXAxisLine": "1",
	        "xAxisLineColor": "#999999",
	        "divlineColor": "#999999",
	        "divLineDashed": "1",
	        "showAlternateVGridColor": "0",
	        "subcaptionFontBold": "0",
	        "subcaptionFontSize": "14",
	        "showHoverEffect": "1"
	    },
	    "categories": [
	        {
	            "category": '.$categoryChart6.'
	        }
	    ],
	    "dataset": '.$datasetChart6.'

	}');
	// Render the chart
	$stackedBar2d->render();

	$stackedBar2d = new FusionCharts("mscolumn2d", "ex7", "100%", 400, "chart-7", "json", '{   "chart": {
	        "caption": "STATUS  ENVIO PAC '. strtoupper($nameInterna).'",
	        "xAxisname": "Setor",
	        "yAxisName": "Qtd. Eventos",
	        "bgColor": "#ffffff",
	        "borderAlpha": "20",
	        "showborder": "0",
	        "showCanvasBorder": "0",
	        "usePlotGradientColor": "0",
	        "plotBorderAlpha": "10",
	        "legendBorderAlpha": "0",
	        "legendShadow": "0",
	        "valueFontColor": "#333",
	        "showXAxisLine": "1",
	        "xAxisLineColor": "#999999",
	        "divlineColor": "#999999",
	        "divLineDashed": "1",
	        "showAlternateVGridColor": "0",
	        "subcaptionFontBold": "0",
	        "subcaptionFontSize": "14",
	        "showHoverEffect": "1",

	    },
	    "categories": [
	        {
	            "category": '.$categoryChart7.'
	        }
	    ],
	    "dataset": '.$datasetChart7.'

	}');
	// Render the chart
	$stackedBar2d->render();

	$stackedBar2d = new FusionCharts("mscolumn2d", "ex8", "100%", 400, "chart-8", "json", '{   "chart": {
	        "caption": "STATUS DA AÇÃO DE CONTENÇÃO POR SETOR - '.$subtitle.'",
	        "xAxisname": "Setor",
	        "yAxisName": "Qtd. Eventos",
	        "bgColor": "#ffffff",
	        "borderAlpha": "20",
	        "showborder": "0",
	        "showCanvasBorder": "0",
	        "usePlotGradientColor": "0",
	        "plotBorderAlpha": "10",
	        "legendBorderAlpha": "0",
	        "legendShadow": "0",
	        "valueFontColor": "#333",
	        "showXAxisLine": "1",
	        "xAxisLineColor": "#999999",
	        "divlineColor": "#999999",
	        "divLineDashed": "1",
	        "showAlternateVGridColor": "0",
	        "subcaptionFontBold": "0",
	        "subcaptionFontSize": "14",
	        "showHoverEffect": "1"
	    },
	    "categories": [
	        {
	            "category": '.$categoryChart8.'
	        }
	    ],
	    "dataset": '.$datasetChart8.'

	}');

	// Render the chart
	$stackedBar2d->render();

	if($datasetChart9 != "null"){
		$stackedBar2d = new FusionCharts("mscolumn2d", "ex9", "100%", 400, "chart-9", "json", '{   "chart": {
		        "caption": "STATUS DA AÇÃO DE CONTENÇÃO POR SETOR - SGQ GERAL",
		        "xAxisname": "Setor",
		        "yAxisName": "Qtd. Eventos",
		        "bgColor": "#ffffff",
		        "borderAlpha": "20",
		        "showborder": "0",
		        "showCanvasBorder": "0",
		        "usePlotGradientColor": "0",
		        "plotBorderAlpha": "10",
		        "legendBorderAlpha": "0",
		        "legendShadow": "0",
		        "valueFontColor": "#333",
		        "showXAxisLine": "1",
		        "xAxisLineColor": "#999999",
		        "divlineColor": "#999999",
		        "divLineDashed": "1",
		        "showAlternateVGridColor": "0",
		        "subcaptionFontBold": "0",
		        "subcaptionFontSize": "14",
		        "showHoverEffect": "1"
		    },
		    "categories": [
		        {
		            "category": '.$categoryChart9.'
		        }
		    ],
		    "dataset": '.$datasetChart9.'

		}');
		// Render the chart
		$stackedBar2d->render();
	}

	$stackedBar2d = new FusionCharts("mscolumn2d", "ex10", "100%", 400, "chart-10", "json", '{   "chart": {
	        "caption": "STATUS DA AÇÃO DE CORREÇÃO POR SETOR - '.$subtitle.'",
	        "xAxisname": "Setor",
	        "yAxisName": "Qtd. Eventos",
	        "bgColor": "#ffffff",
	        "borderAlpha": "20",
	        "showborder": "0",
	        "showCanvasBorder": "0",
	        "usePlotGradientColor": "0",
	        "plotBorderAlpha": "10",
	        "legendBorderAlpha": "0",
	        "legendShadow": "0",
	        "valueFontColor": "#333",
	        "showXAxisLine": "1",
	        "xAxisLineColor": "#999999",
	        "divlineColor": "#999999",
	        "divLineDashed": "1",
	        "showAlternateVGridColor": "0",
	        "subcaptionFontBold": "0",
	        "subcaptionFontSize": "14",
	        "showHoverEffect": "1"
	    },
	    "categories": [
	        {
	            "category": '.$categoryChart10.'
	        }
	    ],
	    "dataset": '.$datasetChart10.'

	}');

	$stackedBar2d->render();

	if($datasetChart11 != "null"){

		$stackedBar2d = new FusionCharts("mscolumn2d", "ex11", "100%", 400, "chart-11", "json", '{   "chart": {
		        "caption": "STATUS DA AÇÃO DE CONTENÇÃO POR SETOR - SGQ GERAL",
		        "xAxisname": "Setor",
		        "yAxisName": "Qtd. Eventos",
		        "bgColor": "#ffffff",
		        "borderAlpha": "20",
		        "showborder": "0",
		        "showCanvasBorder": "0",
		        "usePlotGradientColor": "0",
		        "plotBorderAlpha": "10",
		        "legendBorderAlpha": "0",
		        "legendShadow": "0",
		        "valueFontColor": "#333",
		        "showXAxisLine": "1",
		        "xAxisLineColor": "#999999",
		        "divlineColor": "#999999",
		        "divLineDashed": "1",
		        "showAlternateVGridColor": "0",
		        "subcaptionFontBold": "0",
		        "subcaptionFontSize": "14",
		        "showHoverEffect": "1"
		    },
		    "categories": [
		        {
		            "category": '.$categoryChart11.'
		        }
		    ],
		    "dataset": '.$datasetChart11.'

		}');
		// Render the chart
		$stackedBar2d->render();
	}

	$stackedBar2d = new FusionCharts("mscolumn2d", "ex12", "100%", 400, "chart-12", "json", '{   "chart": {
	        "caption": "STATUS DA AÇÃO DO ENCERRAMENTO POR SETOR  - '.$subtitle.'",
	        "xAxisname": "Setor",
	        "yAxisName": "Qtd. Eventos",
	        "bgColor": "#ffffff",
	        "borderAlpha": "20",
	        "showborder": "0",
	        "showCanvasBorder": "0",
	        "usePlotGradientColor": "0",
	        "plotBorderAlpha": "10",
	        "legendBorderAlpha": "0",
	        "legendShadow": "0",
	        "valueFontColor": "#333",
	        "showXAxisLine": "1",
	        "xAxisLineColor": "#999999",
	        "divlineColor": "#999999",
	        "divLineDashed": "1",
	        "showAlternateVGridColor": "0",
	        "subcaptionFontBold": "0",
	        "subcaptionFontSize": "14",
	        "showHoverEffect": "1"
	    },
	    "categories": [
	        {
	            "category": '.$categoryChart12.'
	        }
	    ],
	    "dataset": '.$datasetChart12.'

	}');

	$stackedBar2d->render();

	if(@$datasetChart13 != "null"){

		$stackedBar2d = new FusionCharts("mscolumn2d", "ex13", "100%", 400, "chart-13", "json", '{   "chart": {
		        "caption": "STATUS DA AÇÃO DO ENCERRAMENTO POR SETOR  - SGQ GERAL",
		        "xAxisname": "Setor",
		        "yAxisName": "Qtd. Eventos",
		        "bgColor": "#ffffff",
		        "borderAlpha": "20",
		        "showborder": "0",
		        "showCanvasBorder": "0",
		        "usePlotGradientColor": "0",
		        "plotBorderAlpha": "10",
		        "legendBorderAlpha": "0",
		        "legendShadow": "0",
		        "valueFontColor": "#333",
		        "showXAxisLine": "1",
		        "xAxisLineColor": "#999999",
		        "divlineColor": "#999999",
		        "divLineDashed": "1",
		        "showAlternateVGridColor": "0",
		        "subcaptionFontBold": "0",
		        "subcaptionFontSize": "14",
		        "showHoverEffect": "1"
		    },
		    "categories": [
		        {
		            "category": '.@$categoryChart13.'
		        }
		    ],
		    "dataset": '.@$datasetChart13.'

		}');
		// Render the chart
		$stackedBar2d->render();
	}

}

?>

<div class="row">
	<?php $colSize = ($chart2 != "null") ? 4 :6; ?>

	<div class="col-md-<?php echo $colSize ?>  col-sm-<?php echo $colSize ?>" >
		<div class="" id="chart-1"></div>
	</div>

	<?php if ($chart2 != "null"): ?>
		<div class="col-md-4 col-sm-4">
			<div class="" id="chart-2"></div>
		</div>
	<?php endif; ?>

	<div class="col-md-<?php echo $colSize ?>  col-sm-<?php echo $colSize ?>">
		<div class="" id="chart-3"></div>
	</div>
</div>

<br>
<div class="clearfix"></div>

<div class="row">
	<?php $colSize = (@$datasetChart5 != "null") ? 6 : 12; ?>

	<div class="col-md-<?php echo $colSize ?>  col-sm-<?php echo $colSize ?>" >
		<div class="" id="chart-4"></div>
	</div>

	<?php if (@$datasetChart5 != "null"): ?>
		<div class="col-md-6 col-sm-6">
			<div class="" id="chart-5"></div>
		</div>
	<?php endif; ?>

</div>

<br>
<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="" id="chart-6"></div>
	</div>
</div>

<br>
<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="" id="chart-7"></div>
	</div>
</div>

<br>
<div class="clearfix"></div>

<div class="row">
	<?php $colSize = (@$datasetChart9 != "null") ? 6 : 12; ?>
	<div class="col-md-<?php echo $colSize ?>  col-sm-<?php echo $colSize ?>" >
		<div class="" id="chart-8"></div>
	</div>

	<?php if (@$datasetChart9 != "null"): ?>
		<div class="col-md-6 col-sm-6">
			<div class="" id="chart-9"></div>
		</div>
	<?php endif; ?>
</div>

<br>
<div class="clearfix"></div>


<div class="row">
	<?php $colSize = (@$datasetChart11 != "null") ? 6 : 12; ?>
	<div class="col-md-<?php echo $colSize ?>  col-sm-<?php echo $colSize ?>" >
		<div class="" id="chart-10"></div>
	</div>

	<?php if (@$datasetChart11 != "null"): ?>
		<div class="col-md-6 col-sm-6">
			<div class="" id="chart-11"></div>
		</div>
	<?php endif; ?>
</div>

<br>
<div class="clearfix"></div>


<div class="row">
	<?php $colSize = (@$datasetChart13 != "null") ? 6 : 12; ?>
	<div class="col-md-<?php echo $colSize ?>  col-sm-<?php echo $colSize ?>" >
		<div class="" id="chart-12"></div>
	</div>

	<?php if (@$datasetChart13 != "null"): ?>
		<div class="col-md-6 col-sm-6">
			<div class="" id="chart-13"></div>
		</div>
	<?php endif; ?>
</div>
