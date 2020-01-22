<h3>
    <i class="fa fa-list-alt"></i> Cadastrar Causas Raiz
    <div class="btn-group" style="float:right">
        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
        </a>
        <ul class="dropdown-menu">
            <!--
            <li>
                <a href="<?php echo Yii::app()->createUrl('causaraiz/create'); ?>"><i class="fa fa-plus"></i> Novo</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('causaraiz/create'); ?>"><i class="fa fa-pencil fa-fw"></i> Editar</a>
            </li>
            -->
            <li><a href="<?php echo Yii::app()->createUrl('causaraiz/admin'); ?>"><i class="fa fa-list"></i> Listar</a></li>
            <!--
            <li class="divider"></li>
            <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Deletar</a></li>
            -->
        </ul>
    </div>
</h3>

<?php $this->renderPartial(
	'_form',
	array('model'=>$model)
); ?>
