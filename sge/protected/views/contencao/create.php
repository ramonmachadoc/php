
<h3 id='tituloPagina'>
	<i class="fa fa-retweet"></i> Contenção - <?php echo $evento->codigo; ?>
    <div class="form-actions" style="float:right">
			<?php if( Yii::app()->user->getState('perfil') == Permissao::ADMINISTRADOR ) : ?>
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType' => 'link',
            'context'    => 'success',
            'label'      => 'Voltar',
            'url'        => Yii::app()->createUrl('evento/indexauditado'),
        )); ?>
			<?php endif; ?>
    </div>
</h3>

<?php $this->renderPartial('_form', array(
	'model'  => $model,
	'evento' => $evento,
)); ?>
