
<script>
	$( document ).ready(function() {
		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php if($model->hasErrors() or !$model->isNewRecord ): ?>
			mostraempresaarea();
			
			//jQuery('#permissao-grid').yiiGridView('update');
			//afterDelete(th, true, data);

		<?php endif; ?>

		$("tr.filters").remove();
		$("span.caret").remove();
		$('a.sort-link').removeAttr('href');
		//$('a.sort-link').attr('disabled', true);

	});

	function mostraempresaarea() {			
		var perfil = $('#Permissao_perfil option:selected').val();
		
		$('#divempresaarea').hide(400);
		$('#divempresasetor').hide(400);
		$('#Permissao_empresa_id').val('');
		$('#Permissao_area_id').val('');

		if( perfil == <?php echo Permissao::ADMINISTRADOR; ?> || perfil == "" ) {

/*			$('#divempresaarea').hide(400);
			$('#divempresasetor').hide(400);
			$('#Permissao_empresa_id').val('');
			$('#Permissao_area_id').val('');
*/
		} else if( perfil == <?php echo Permissao::GERENTE; ?> || perfil == <?php echo Permissao::AUDITOR; ?> ) {
			
			$('#divempresaarea').show(400);

		} else if( perfil == <?php echo Permissao::GERENTE_AUDITADO; ?> ) {
			
			$('#divempresasetor').show(400);

		}
	}

	function buscaPermissoesAJAX(){
		var usuario_id = $('#Permissao_usuario_id option:selected').val();
		
		if(usuario_id != '') {
			$.ajax({
				url:   '<?php echo Yii::app()->baseUrl; ?>/permissao/buscatodaspermissoesajax',
				data:  'usuario_id=' + usuario_id,    
				type:  'POST',    
				cache: false,

				beforeSend: function() { /*mostrarIcone(area_id, area, 'request');*/ },
				success: function(response) { /*alert(response);*/ },
				complete: function() {         
					/*setTimeout(function() {
						mostrarIcone(area_id, area, 'response');   
					}, 500);*/
					
				}           
			});
		}
		
	}
</script>


<!-- Alerta de SUCESSO -->
<?php $this->widget('booster.widgets.TbAlert', array(
    'fade'            => true,
    'closeText'       => false,
    'events'          => array(),
    'htmlOptions'     => array('id'=>'flash-success'),
    'userComponentId' => 'user',
));  
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$("#flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
    CClientScript::POS_READY
); ?>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'permissao-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<div class="form-group">
		<label class="col-sm-2 control-label">Usuário</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" readonly="true" value="<?php echo $usuario->nome; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Login</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" readonly="true" value='<?php echo $usuario->login; ?>' />
		</div>
	</div>


	<!-- USUARIO -->
	<?php echo $form->hiddenField($model,'usuario_id',array('value'=>$usuario->usuario_id)); ?>


	<!-- USUARIO -->
	<?php /*echo $form->dropDownListGroup($model, 'usuario_id', array(
		'widgetOptions' => array(
			'data' => CHtml::listData(Usuario::model()->findAllByAttributes(Array(
				'auditado' => 'N',
				'status'   => 'A'
			)),'usuario_id','nome'),
			'htmlOptions' => array(
				'empty' => '...:: Selecione uma Usuário ::...',
				'onchange' => 'buscaPermissoesAJAX()',
			),
		)
	)); */?>	

	<!-- PERFIL -->
	<?php echo $form->dropDownListGroup($model, 'perfil', array(
		'widgetOptions' => array(
			'data' => $model->getPerfilOptions(),
			'htmlOptions' => array(
				'empty'    => '...:: Selecione um Perfil ::...',
				'onchange' => 'mostraempresaarea()',
			),	
		)
	)); ?>
	

	<div id="divempresasetor" style="display: none;">
		<!-- EMPRESA E SETOR -->
		<div class="form-group">
			<label class="col-sm-2 control-label" for="Permissao_setor_id">Empresa</label>
		
			<div class="col-sm-9">

				<select class="form-control" placeholder="Empresa" name="Permissao[empresa_id_setor]" id="Permissao_empresa_id">
					<option value="">...:: Selecione uma Empresa ::...</option>
					<?php foreach (CHtml::listData(Empresa::model()->findAll(),'empresa_id','nome') as $key => $value): ?>
						<option value="<?php echo $key ?>"><?php echo $value ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		
		<?php
			/*echo $form->dropDownListGroup($model, 'empresa_id', array(
				'widgetOptions' => array(
					'data' => CHtml::listData(Empresa::model()->findAll(),'empresa_id','nome'),
					'htmlOptions' => array(
						'empty' => '...:: Selecione uma Empresa ::...',
					),
				)
			));*/

			echo $form->dropDownListGroup($model, 'setor_id', array(
				'widgetOptions' => array(
				'data' => CHtml::listData(Setor::model()->findAll(array('order'=>'descricao')),'setor_id','descricao'),
				'htmlOptions' => array(
					'empty' => '...:: Selecione um Setor ::...',
				),
			)
		));
		?>

	</div>

	<div id="divempresaarea" style="display:none">
		<!-- EMPRESA -->
		<?php echo $form->dropDownListGroup($model, 'empresa_id', array(
			'widgetOptions' => array(
				'data' => CHtml::listData(Empresa::model()->findAll(),'empresa_id','nome'),
				'htmlOptions' => array(
					'empty' => '...:: Selecione uma Empresa ::...',
				),
			)
		)); ?>	

		<!-- AREA -->
		<?php echo $form->dropDownListGroup($model, 'area_id', array(
			'widgetOptions' => array(
				'data' => CHtml::listData(Area::model()->findAll(),'area_id','descricao'),
				'htmlOptions' => array(
					'empty' => '...:: Selecione uma Área ::...',
				),
			)
		)); ?>
	</div>




	<!-- BOTAO -->
	<br>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'    => 'primary',
			'label'      => $model->isNewRecord ? 'Cadastrar' : 'Alterar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<br>
<h3><i class="fa fa-lock"></i> Permissões</h3>
<hr style="margin-top: -10px; margin-bottom: -15px">
<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'permissao-grid',
    'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchUsuario($usuario->usuario_id),
    'filter'          => $model,
    'afterAjaxUpdate' => "function(link,success,data){ $('tr.filters').remove(); $('span.caret').remove(); $('a.sort-link').removeAttr('href'); }",
    'columns' => array(
		array(
            'name'   => '_filterUsuarioId',
            'filter' => CHtml::listData(Usuario::model()->findAll(array('order'=>'nome')), 'usuario_id', 'nome'),
            //'value'  => 'Empresa::Model()->FindByPk($data->empresa_id)->nome',
			'value'  => '$data->usuario->nome',
        ),
        /*array(
            'name'   => '_filterLogin',
			'value'  => '$data->usuario->login',
        ),*/
        array(
            'name'   => 'perfil',
            'filter' => $model->perfilOptions,
            'value'  => '@$data->perfilText',
        ),
        array(
            'name'   => 'empresa_id',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'empresa_id', 'nome'),
			'value'  => '@$data->empresa->nome',
        ),
        array(
        	'name' => 'setor_id',
        	'filter' => CHtml::listData(Setor::model()->findAll(), 'setor_id', 'descricao'),
        	'value' => '@$data->setor->descricao'
        ),
        
		array(
            'name'   => 'area_id',
            'filter' => CHtml::listData(Area::model()->findAll(), 'area_id', 'descricao'),
            'value'  => '@$data->area->descricao',
        ),

        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 85px;text-align:center'),
            'template'        => '{delete}',
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                'update' => array('options' => array('style' => 'margin-left:5px;'),),
                'delete' => array('options'=>  array('style' => 'margin-left:5px;'),),
            ),
        ),
    ),
)); ?>
