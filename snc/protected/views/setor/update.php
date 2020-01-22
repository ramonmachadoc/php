<h3>
    <i class="glyphicon glyphicon-user"></i> Alterar Setor
    
    <div class="btn-group" style="float:right">
        <button type="button" class="btn btn-warning">Acões</button>
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo Yii::app()->createUrl('setor/admin'); ?>">Listar</a></li>
        </ul>
    </div>
</h3>

<?php $this->renderPartial(
	'_form', 
	array('model'=>$model)
); ?>


