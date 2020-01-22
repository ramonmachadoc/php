<!DOCTYPE html>

<html lang="pt-br">

    <?php include Yii::app()->getLayoutPath() . DIRECTORY_SEPARATOR . 'main-head.php' ?>

    <body>

        <section id="container" >



            <!-- BARRA SUPERIOR & NOTIFICAÇÕES -->

            <?php  
               //echo Yii::app()->getLayoutPath() . DIRECTORY_SEPARATOR . 'main-header.php';
                 include Yii::app()->getLayoutPath() . DIRECTORY_SEPARATOR . 'main-header.php'
            ?>

            <!-- MENU LATERAL -->
            <?php include Yii::app()->getLayoutPath() . DIRECTORY_SEPARATOR . 'main-menu.php' ?>



            <!-- CONTENT -->

            <section id="main-content">

                <section class="wrapper site-min-height">

                    <div class="row mt">

                        <div class="col-lg-12">

                            <?php if (isset($this->breadcrumbs)): ?>

                                <?php $this->widget('zii.widgets.CBreadcrumbs',

                                    array(

                                        'links' => $this->breadcrumbs,

                                    )); ?><!-- breadcrumbs -->

                            <?php endif ?>

                            <?php echo $content; ?>

                        </div>

                    </div>

                </section><! --/wrapper -->

            </section>



            <!-- FOOTER -->

            <?php include Yii::app()->getLayoutPath() . DIRECTORY_SEPARATOR . 'main-footer.php' ?>



        </section>



        <!-- JS DO SISTEMA -->

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/dashgum/assets/js/jquery.ui.touch-punch.min.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/dashgum/assets/js/jquery.dcjqaccordion.2.7.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/dashgum/assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/dashgum/assets/js/jquery.nicescroll.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/dashgum/assets/js/common-scripts.js"></script>



    </body>

</html>

