<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>Mapa"><i class="fa fa-list-alt"></i> LISTA MAPA DE NOTAS</a></li>
                    <li class="active"><i class="fa fa-map-marker"></i> MAPA DE NOTAS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">
            <aside class="profile-info col-lg-12">
                <section class="panel">
                    <header class="panel-heading summary-head" style="height: 40px; line-height: 50px;">
                        <!-- <h4>DADOS ALUNO</h4>-->
                        <p></p>
                    </header>

                    <div  class="panel-body" style="font-size: 15px; margin-left: 30px;">


                        <div class="row" id="teste" >
                            <div style='width: 890px; height: auto; margin-left: 15px;'>


                                <div style=" width: 700px; float: left;">

                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">MAPA DE NOTAS</div>
                                    <div style="width: 700px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;">CURSO : </div>
                                    <div style="width: 700px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">DISCIPLINA :</div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">PROFESSOR :</div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">TURMA : </div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">CH :  </div>

                                </div>

                                <div style=" width: 190px; float: left; height: 136px;">

                                    <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                </div>


                                <hr style="float: left; width: 890px;"/>


                                <div class="adv-table">
                                    <table style="font-size: 12px;"  class="display table table-bordered table-striped" id="example">
                                        <thead>
                                            <tr style="font-size: 14px;" >
                                                <th style="text-align: center; ">#</th>
                                                <th style="text-align: center;">MATRÍCULA</th>
                                                <th style="text-align: center;">NOME</th>
                                                <th style="text-align: center;">1BIM</th>
                                                <th style="text-align: center;">2BIM</th>
                                                <th style="text-align: center;">3BIM</th>
                                                <th style="text-align: center;">MÉDIA</th>
                                                <th style="text-align: center;">FALTAS</th>
                                                <th style="text-align: center;">SITUAÇÃO</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                                <tr style="text-align: justify;" class="gradeU">
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td></td>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;">
                                                       dsdsad
                                                    </td>
                                                    <td style="width: 8%; text-align: center;">

                                                    sddadas
                                                    </td>
                                                </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>

                                <div style="width: 890px;page-break-after: always; float: left; height: 20px;  border:1px solid #ddd; font-size: 12px; margin-top: 20px;">
                                    <b>AP</b> = APROVADO - <b>REP</b> = REPROVADO - <b>REPF</b> = REPROVADO POR FALTA


                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px; margin-left: 40px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR MAPA DE NOTAS </button>
                        </div>
                    </div>

                    <br/>
                </section>
            </aside>
        </div>  
    </section>
</section>

<script>

    function printDiv(divID)
    {
        //pega o Html da DIV
        var divElements = document.getElementById(divID).innerHTML;
        //pega o HTML de toda tag Body
        var oldPage = document.body.innerHTML;

        //Alterna o body 
        document.body.innerHTML =
                "<html><head><style></style></head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>

