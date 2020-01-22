<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<br>

  <?php $this->widget('booster.widgets.TbGridView', array(
      'id'              => 'causaraiz-grid',
      'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
      'dataProvider'    => $causaraiz->search(),
      'columns'         => array(
          'tipo',
          'categoria',
          'codigo',
          'subcategoria',
          /*array(
              'class'           => 'booster.widgets.TbButtonColumn',
              'header'          => 'Ações',
              'htmlOptions'     => array('style' => 'width: 100px;text-align:center'),
              'template'        => '{view}{update}',
              'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("id"=>$data->primaryKey))',
              'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',

          ),*/


      ),
  )); ?>

<br>
<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-causaraiz').addClass('active');
</script>
