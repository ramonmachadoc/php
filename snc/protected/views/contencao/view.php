<h3 id='tituloPagina'>
    <i class="fa fa-retweet"></i> Visualizar Contenção: <?php echo $evento->codigo; ?>
    <div class="form-actions" style="float:right">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType' => 'link',
            'context'    => 'success',
            'label'      => 'Voltar',
            'url'        => Yii::app()->createUrl('evento/indexauditado'),
        )); ?>
    </div>
</h3>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'administrador-contencao-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<!-- Acordeon -->
	<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$evento));  ?>


    <div class="panel-group" id="accordion" style="margin-top: -15px">
    

    
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#">
                        Contenção
                    </a>
                </h4>
            </div>


            <div class="panel-collapse collapse in">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="Contencao_prazo">Aplicável</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" value="<?php echo $model->getAplicavelText(); ?>" readonly='true' class="form-control ct-form-control" />
                            </div>
                        </div>
                    </div>

                    <?php if( $model->aplicavel == Contencao::SIM ) : ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="Contencao_prazo">Responsavel</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" value="<?php echo $model->responsavel->nome; ?>" readonly='true' class="form-control ct-form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contenção</label>
                            <div class="col-sm-9">
                                <textarea rows="4" style="width:100% !important" class="form-control" readonly="true"><?php echo $model->contencao; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Prazo</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" value="<?php echo $model->prazo; ?>" readonly='true' class="form-control ct-form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Documento</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <?php

                                        $arquivos = explode(";", $model->arquivo);
                                        $arquivos = array_filter($arquivos);

                                        foreach ($arquivos as $f) {
                                            echo CHtml::link($f, array("upload/{$f}"), array('target'=>'_blank'));
                                            echo "<br/>";
                                        }

                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" value="<?php echo $model->getStatusText(); ?>" readonly='true' class="form-control ct-form-control" />
                                </div>
                            </div>
                        </div>


                    <?php endif; ?>

                </div>
            </div>
        </div>




    </div>


	<!-- BOTAO VOLTAR
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'link',
				'context'    => 'success',
				'label'      => 'Voltar',
                'url'        => Yii::app()->createUrl('evento/indexauditado'),
			)); ?>
	</div>-->

<?php $this->endWidget(); ?>


<!--***   script    ***-->
<script type="application/javascript">
	$('#sub-menu-auditado').addClass('active');
	$('#auditado-contencao-aberto').addClass('active');
</script>