
<script type="application/javascript">
	$( document ).ready(function() {

		//remove todos os itens do combo
	  	$("#Evento_nivel").empty();

	  	//retira o item QSMS do combo
		$('#evento_setor_id option').each(function() {
		    if ( $(this).text() == 'QSMS' ) {
		         $(this).remove();
		    }
		});

		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php if($model->hasErrors() or !$model->isNewRecord ): ?>
			mostraAnaliseRisco();
			preencherisco();
			mostraCamposSGSO();
		<?php endif; ?>

    	$('#sub-menu-adm-evento').addClass('active');
    	$('#admevento-cadastrar').addClass('active');

	});

	function abreForm(){
		var mostra = document.getElementById('formItem').style.display;

		if(mostra == 'none'){
			document.getElementById('formItem').style.display = 'block';
			document.getElementById('txItem').focus();
		}else{
			document.getElementById('txItem').value = '';
			document.getElementById('txDescItem').value = '';
			document.getElementById('txDescEvento').value = '';
			document.getElementById('numCheck').value = '';
			document.getElementById('txCriticidade').value = '1';
			document.getElementById('formItem').style.display = 'none';
		}
	}

	function preenchecodigoevento(){
		var sigla = $('#Evento_tipoauditoria_id option:selected').parent().attr('label');
		var ano   = $('#Evento_dataevento').val().substr(5,5);

		<?php if(!$model->isNewRecord): ?>
			var id    = $('#Evento_codigo').val();
			var aux1   = id.split('-');
			var aux2   = aux1[2].split('/');
		<?php endif; ?>

		if( sigla != '' && sigla != undefined && ano != '' )

			<?php if($model->isNewRecord): ?>
				// $('#Evento_codigo').val('PAC-' + sigla + '-●●●●●●' + ano);
				$('#Evento_codigo').val(sigla + '-??????' + ano);
			<?php elseif(!$model->isNewRecord): ?>
				$('#Evento_codigo').val(sigla + '-' + aux2[0] + ano);
			<?php endif; ?>

		else
			$('#Evento_codigo').val('');
  		/*if( probabilidade != '' &&  severidade != '' ){
  			$('#evento_codigo').val(nivel);
  			pintanivel(nivel);
  		} else {
  			$('#evento_codigo').val('');
  			$("#evento_codigo").empty();
  		}*/
  	}

	function mostraAnaliseRisco(){

		var escolha = $('#Evento_analisederisco option:selected').val();

		if(escolha == 'S')
			$('#divanaliserisco').show(400);
		else if(escolha == 'N' || escolha == ''){
			$('#divanaliserisco').hide(400);

			$('#Evento_probabilidade').val('');
			$('#Evento_severidade').val('');
			$('#Evento_nivel').val('');

			$("#Evento_nivel").empty();
			$('#Evento_risco').val('');
			$("#Evento_nivel").css("background", "#eee");
		}
	}

	function preencherisco(){
		var probabilidade = $('#Evento_probabilidade option:selected').val();
		var severidade    = $('#Evento_severidade option:selected').val();
		var nivel         = $('#Evento_probabilidade').val() + $('#Evento_severidade').val();

  		if( probabilidade != '' &&  severidade != '' ){
  			$('#Evento_risco').val(nivel);
  			pintanivel(nivel);
  		} else {
  			$('#Evento_risco').val('');
  			$("#Evento_nivel").empty();
  		}
  	}

  	function pintanivel(nivel){
  		var aceitavel   = ["1A","1B", "1C", "1D", "1E", "2D", "2E", "3E"];
  		var toleravel   = ["2A", "2B", "2C", "3B", "3C", "3D", "4C", "4D", "4E", "5D", "5E"];
  		var intoleravel = ["3A", "4A", "4B", "5A", "5B", "5C"];

		if( jQuery.inArray( nivel, aceitavel ) != -1){
			$("#Evento_nivel").empty();
			$("#Evento_nivel").append("<option value='AC'>Aceitável</option>");
			$("#Evento_nivel").css("background", "#5cb85c");
			$("#Evento_nivel").css("color", "white");
		} else if( jQuery.inArray( nivel, toleravel ) != -1){
			$("#Evento_nivel").empty();
			$("#Evento_nivel").append("<option value='TO'>Tolerável</option>");
			$("#Evento_nivel").css("background", "#f0ad4e");
			$("#Evento_nivel").css("color", "white");
		} else if( jQuery.inArray( nivel, intoleravel ) != -1){
			$("#Evento_nivel").empty();
			$("#Evento_nivel").append("<option value='IN'>Intolerável</option>");
			$("#Evento_nivel").css("background", "#c9302c");
			$("#Evento_nivel").css("color", "white");
		}

  	}

  	function mostraCamposSGSO(){
  		var area = $('#Evento_area_id option:selected').text();

  		if( area == 'SGSO'){
  			$('#divcamposSGSO').show(400);
  		}
  		else {
			$('#divcamposSGSO').hide(400);
			$('#Evento_equipamento_id').val('');
			$('#Evento_dataentregareporte').val('');
			$('#Evento_arquivo').val('');
  		}


  	}

</script>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'evento-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'enctype' => 'multipart/form-data',
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
  		<legend>Informações Sobre o Setor Auditado</legend>


		<?php if( Yii::app()->user->perfil == Permissao::ADMINISTRADOR ) : ?>

			<!-- AREA -->
			<?php echo $form->dropDownListGroup($model, 'area_id',
				array(
					'wrapperHtmlOptions' => array(
						//'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Area::model()->findAll('area_id <> 4'),'area_id','descricao'),
						'htmlOptions' => array(
							'empty'    => '...:: Selecione uma Área ::...',
							'onChange' => 'mostraCamposSGSO()',
						),
					)
				)
			); ?>

			<!-- EMPRESA -->
			<?php echo $form->dropDownListGroup($model, 'empresa_id',
				array(
					'wrapperHtmlOptions' => array(
						//'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Empresa::model()->findAll(),'empresa_id','nome'),
						'htmlOptions' => array(
							'empty' => '...:: Selecione uma Empresa ::...',
						),
					)
				)
			); ?>

		<?php else : ?>

			<!-- EMPRESA -->
			<?php echo $form->dropDownListGroup($model, 'empresa_id',
				array(
					'wrapperHtmlOptions' => array(
						//'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => Permissao::findAllEmpresasSessao(),
						'htmlOptions' => array(
							'empty' => '...:: Selecione uma Empresa ::...',
						),
					)
				)
			); ?>

		<?php endif; ?>



		<!-- SETOR -->
		<?php echo $form->dropDownListGroup($model, 'setor_id',
			array(
				'widgetOptions' => array(
					'data' => CHtml::listData(Setor::model()->findAll(array('order'=>'descricao')),'setor_id','descricao'),
					'htmlOptions' => array(
						'empty' => '...:: Selecione um Setor ::...',
					),
				)
			)
		); ?>

		<!-- ORIGEM AUDITADO -->
		<?php echo $form->dropDownListGroup($model, 'origemauditado_id',
			array(
				'widgetOptions' => array(
					'data' => CHtml::listData(Origemauditado::model()->findAll(array('order'=>'descricao')),'origemauditado_id','descricao'),
					'htmlOptions' => array(
						'empty' => '...:: Selecione a Origem de Auditado ::...',
					),
				)
			)
		); ?>

	<fieldset>

	<br>
  	<fieldset>
  		<legend>Informações sobre o Evento</legend>

		<!-- CODIGO -->
		<?php echo $form->textFieldGroup($model,'codigo',
			array('widgetOptions'=>array(
				'htmlOptions'=>array(
					//'class'     => 'col-sm-5',
					'maxlength' => 100,
					'readonly'  => true,
					//'display'		=> 'none',
				),
			),
			'prepend' => '<i class="fa fa-cog"></i>'
		)); ?>

		<!-- TIPO AUDITORIA -->
		<?php echo $form->dropDownListGroup($model, 'tipoauditoria_id',
			array(
				'wrapperHtmlOptions' => array(
					//'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => CHtml::listData(Tipoauditoria::model()->findAll(array("order"=>"descricao")),'tipoauditoria_id', "descricao" , "sigla"),
					'htmlOptions' => array(
						'empty' => '...:: Selecione um Tipo de Evento ::...',
						'onchange'=>'preenchecodigoevento(this.value)',
					),
				)
			)
		); ?>

		<!-- DATA DO EVENTO -->
		<?php echo $form->datePickerGroup($model, 'dataevento',
			array(
				'widgetOptions' => array(
					'options' => array(
						'format'     => 'dd/mm/yyyy',
						'viewformat' => 'yyyy-mm-dd',
						'autoclose'  => true,
					)
				),
				'wrapperHtmlOptions' => array(
					'onchange'=>'preenchecodigoevento(this.value);',
				),
				'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
			)
		); ?>

		<!-- AUDITOR / RELATOR -->
		<?php echo $form->dropDownListGroup($model, 'auditorrelator_id',
			array(
				'wrapperHtmlOptions' => array(
					//'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => CHtml::listData(Auditorrelator::model()->findAll(array("order"=>"nome")),'auditorrelator_id','nome'),
					'htmlOptions' => array(
						'empty' => '...:: Selecione um Auditor/Relator ::...',
					),
				)
			)
		); ?>

		<!-- ORIGEM AUDITOR -->
		<?php echo $form->dropDownListGroup($model, 'origemauditor_id',
			array(
				'wrapperHtmlOptions' => array(
					//'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => CHtml::listData(Origemauditor::model()->findAll(array("order"=>"descricao")),'origemauditor_id','descricao'),
					'htmlOptions' => array(
						'empty' => '...:: Selecione a Origem do Auditor ::...',
						//'onchange'=>'mostraSupervisores(this.value)',
					),
				)
			)
		); ?>

		<!-- INCLUIR NOVO ITEM -->
		<div class="form-actions">
			<button type="button" class="btn btn-primary" onclick="js:abreForm()">Não Conformidade +</button>
			<div id="formItem" style="display: none;">
				<form id="formNvItem">
						<div class="form-group">
							<label>Item do Check-List</label>
							<input type="text" class="form-control" id="txItem"/>
						</div>
						<div class="form-group">
							<label>Descricao do Item do Check-List</label>
							<textarea class="form-control" id="txDescItem"></textarea>
						</div>
						<div class="form-group">
							<label>Requisito</label>
							<input type="text" class="form-control" id="numCheck"/>
						</div>
						<div class="form-group">
							<label>Descrição do Evento</label>
							<textarea class="form-control" id="txDescEvento"></textarea>
						</div>
						<div class="form-group">
							<label>Nível de Criticidade</label>
							<select class="form-control" id="txCriticidade">
								<option value="CRITCD01">Crítica</option>
								<option value="CRITCD02">Documentado e Implementado</option>
								<option value="CRITCD03">Documentado e Implementado - Observação</option>
								<option value="CRITCD04">Documentado e Implementado - Recomendação</option>
								<option value="CRITCD05">Documentado e Não Implementado</option>
								<option value="CRITCD06">Implementado e Não Documentado</option>
								<option value="CRITCD07">Maior</option>
								<option value="CRITCD08">Menor</option>
								<option value="CRITCD09">Não Documentado e Não Implementado</option>
								<option value="CRITCD10">N/A</option>
								<option value="CRITCD11">Observação</option>
							</select>
						</div>
					<button type="button" class="btn btn-info" onclick="javascript:addItem(txItem.value,txDescItem.value,txDescEvento.value,numCheck.value,txCriticidade.value)">Incluir</button>
					<button type="button" class="btn btn-danger" onclick="js:abreForm()">Cancelar</button>
				</form>
			</div>
		</div>
		<div id="divLista"></div>

		<!-- QUANTIDADE DE ITENS -->
		<?php echo $form->textFieldGroup($model,'qntditens',
			array('widgetOptions'=>array(
				'htmlOptions'=>array(
					//'class'=>'span5',
					'maxlength'=>100
				),
			),
			//'prepend' => '<i class="fa fa-commenting-o"></i>'
		)); ?>

		<!-- PRAZO RESPOSTA DO PAC -->
		<?php
			$str_data = date('Y-m-d');
			$array_data = explode('-', $str_data);
			$count_days = 0;
			$int_qtd_dias_uteis = 0;
			while($int_qtd_dias_uteis < 10){
				$count_days++;
				$day = date('m-d',strtotime('+'.$count_days.'day',strtotime($str_data)));
				if(($dias_da_semana = gmdate('w', strtotime('+'.$count_days.' day', gmmktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '6') {

					$int_qtd_dias_uteis++;
				}
			}

			$model->prazoresposta = gmdate('d/m/Y',strtotime('+'.$count_days.' day',strtotime($str_data)));

		?>
		<?php echo $form->textfieldgroup($model, 'prazoresposta',
			array(
				'wrapperHtmlOptions' => array(

				),
				'widgetOptions' => array(
					'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important','readonly' => true),
				)
			)
		); ?>

	</fieldset>

	<?php if( (isset(Yii::app()->user->area) and Yii::app()->user->area == 'SGSO') or Yii::app()->user->perfil == Permissao::ADMINISTRADOR ) : ?>
		<div id="divcamposSGSO" style="display:block;">
			<br>
			<fieldset>
				<legend>Informações Restritas a Área SGSO</legend>

				<!-- EQUIPAMENTO / AERONAVE -->
				<?php echo $form->dropDownListGroup($model, 'equipamento_id',
					array(
						'wrapperHtmlOptions' => array(
							//'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
							'data' => CHtml::listData(Equipamento::model()->findAll(array("order"=>"descricao")),'equipamento_id','descricao'),
							'htmlOptions' => array(
								'empty' => '...:: Selecione um Equipamento/Aeronave ::...',
								//'onchange'=>'mostraSupervisores(this.value)',
							),
						)
					)
				); ?>

				<!-- DATA DA ENTREGA DO REPORTE -->
				<?php echo $form->datePickerGroup($model, 'dataentregareporte',
					array(
						'widgetOptions' => array(
							'options' => array(
								'format'     => 'dd/mm/yyyy',
								'viewformat' => 'yyyy-mm-dd',
								'autoclose'  => true,
							),
						),
						'wrapperHtmlOptions' => array(),
						'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
					)
				); ?>

				<!-- ARQUIVO -->
				<?php // echo $form->fileFieldGroup($model, 'arquivo',array('wrapperHtmlOptions' => array('class' => 'col-sm-5',),)); ?>
				<div class="form-group">
					<label class="col-sm-2 control-label required" for="Evento_arquivo">Documento Vinculado <span class="required">*</span>
					</label>
					<div class="col-sm-5 col-sm-9">
						<input id="ytEvento_arquivo" type="hidden" value="" name="Evento[arquivo][]">
						<input class="form-control" placeholder="Documento Vinculado" name="Evento[arquivo][]" id="Evento_arquivo" type="file" multiple="">
					</div>
				</div>

			</fieldset>



	<br>
  	<fieldset>
  		<legend>
  			Índice de Avaliação do Risco
			<span style="background:#bce8f1;" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">
				<span class="glyphicon glyphicon-new-window"></span> Metodologia de Análise de Risco
			</span>
  		</legend>

		<!-- NECESSARIO ANALISE DO RISCO?  -->
		<?php echo $form->dropDownListGroup($model, 'analisederisco',
			array(
				'wrapperHtmlOptions' => array(
					//'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => $model->getAnalisederiscoOptions(),
					'htmlOptions' => array(
						'empty'    => '...:: Selecione ::...',
						'onchange' => 'mostraAnaliseRisco()',
						//'class'  => 'form-control col-sm-4',
						//'style'    => 'width: 180px',
					),
				)
			)
		); ?>


		<div id="divanaliserisco" style="display:none">

			<!-- PROBABILIDADE -->
			<?php echo $form->dropDownListGroup($model, 'probabilidade',
				array(
					'wrapperHtmlOptions' => array(
						//'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => $model->getProbabilidadeOptions(),
						'htmlOptions' => array(
							'empty'    => '...:: Selecione ::...',
							'onchange' => 'preencherisco()',
							//'class'  => 'form-control col-sm-4',
							'style'    => 'width: 280px;',
						),
					)
				)
			); ?>

			<!-- SEVERIDADE -->
			<?php echo $form->dropDownListGroup($model, 'severidade',
				array(
					'wrapperHtmlOptions' => array(
						//'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => $model->getSeveridadeOptions(),
						'htmlOptions' => array(
							'empty'    => '...:: Selecione ::...',
							'onchange' => 'preencherisco()',
							//'class'  => 'form-control col-sm-4',
							'style'    => 'width: 280px;',
						),
					)
				)
			); ?>

			<!-- CLASSIFICACAO NIVEL DO RISCO  -->
			<?php echo $form->textFieldGroup($model,'risco',
				array('widgetOptions' => array(
					'htmlOptions' => array(
						//'class'       => 'span5',
						'maxlength'   => 2,
						'placeholder' => '',
						'readonly'    => 'true',
						'style'       => 'width:70px;'
					),
				),
				/*'prepend' => '<i class="fa fa-user"></i>'*/
			)); ?>

			<!-- NIVEL  -->
			<?php echo $form->dropDownListGroup($model, 'nivel',
				array(
					'wrapperHtmlOptions' => array(
						//'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => $model->getNivelOptions(),
						'htmlOptions' => array(
							//'empty'    => '',
							'readonly' => 'true',
							'style'    => 'width: 280px;',
						),
					)
				)
			); ?>
		</div>
	</fieldset>
</div>
<?php endif; ?>

	<!-- BOTAO -->
	<br><br>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'submit',
				'context'    => 'primary',
				'label'      => $model->isNewRecord ? 'Enviar' : 'Alterar',
				'id'				 => 'btn-send',
		)); ?>
		<input type="hidden" id="str" name="str" value="" />
	</div>
<script type="text/javascript">

	var itemArray = [];

	function addItem(item,descItem,descEvento,numCheck,criticidade){

		if(item && descItem && descEvento){

			itemArray.push(item);
			itemArray.push(descItem);
			itemArray.push(descEvento);
			itemArray.push(numCheck);
			itemArray.push(criticidade);

			abreForm();

		}
			if(itemArray.length > 0){

				escreveTab();
		  }
		}
		function escreveTab(){
			var dados = "";
			var contador = 0;
			dados += `<div class="table table-responsive">
									<table class="table table-striped table-bordered table-hover table-sm">
										<thead class="thead-dark">
											<tr>
												<th>Cod.</th>
												<th>Check-List</th>
												<th>Descrição Check-List</th>
												<th>Requisito</th>
												<th>Evento</th>
												<th>Criticidade</th>
												<th></th>
											</tr>
										</thead>
										<tbody>`;

			for (var i = 0; i < itemArray.length; i++) {
				contador++;
				dados += '<tr><td>' + contador + '</td><td>' + itemArray[i] + '</td><td>' + itemArray[i = i + 1] + '</td><td>' + itemArray[i = i + 1] + '</td><td>' + itemArray[i = i + 1] +'</td><td>' + itemArray[i = i + 1] + '</td>';
				dados += '<td><button type="button" class="btn btn-danger btn-excluir" data-id="' + contador +'">Excluir</button></td></tr>';

			}
			dados += `</tbody></table></div>`;

			document.getElementById('divLista').innerHTML = dados;

			var btnsExcluir = document.querySelectorAll('.btn-excluir');

			btnsExcluir.forEach(function(item) {
				item.addEventListener("click", event => {
					var id = event.target.getAttribute('data-id');

					itemArray.splice((id-1)*5,5);
					escreveTab();
				});
			});
		}
</script>
<script>
$(document).ready(function(){
		$('#btn-send').click(function(){ // prepare button inserts the JSON string in the hidden element
			$('#str').val(JSON.stringify(itemArray));
		});
	});
</script>
<?php $this->endWidget(); ?>



<!-- Modal -->
<?php echo $this->renderPartial('_metodologiaModal');  ?>
