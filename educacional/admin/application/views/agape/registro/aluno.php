<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-search"></span> CONSULTAR SITUAÇÃO ALUNO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Curso</label>

                                                <select name="curso"  class="form-control" id="curso" onchange="buscar_periodo_letivo()">
                                                    <option value="">Selecione o Curso</option>
                                                    <?php
                                                    foreach ($cursos as $rowCurso) {
                                                        ?>
                                                        <option value="<?php echo $rowCurso['cursos_id']; ?>"><?php echo $rowCurso['cur_tx_descricao']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group" id="load_periodo_letivo">
                                                <label>Período Letivo</label>
                                                <select  class="form-control" name='periodo_letivo' id='periodo_letivo' name="periodo_letivo">
                                                    <option value="">Selecione o Período Letivo</option>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>


                                    <div class="row">

                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Matricula</label>
                                                <input type="text" name="matricula_busca" id="matricula_busca" class="form-control">
                                            </div>
                                        </div> 


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" name="aluno_busca" id="aluno_busca" class="form-control">
                                            </div>
                                        </div> 

                                        <div class="col-lg-6">
                                            <div class="form-group" id="load_turma">
                                                <label>Turma</label>
                                                <select  class="form-control" name='turma_busca' id='periodo_letivo' name="turma_busca">
                                                    <option value="">Selecione a Turma</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button onclick="buscar_paginacao_receber_pagamento();"  class="btn btn-info">PESQUISAR ALUNO</button>
                                        </div>
                                    </div>
                                </div>


                            </section>
                        </div>

                    </div>
                </div>
            </section>

            <br/>
            <div class="divider"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12" id="load_paginacao_rp">


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</section>




<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>


<script>
                                                function buscar_periodo_letivo() {
                                                    var curso = $('#curso').val();  //codigo do estado escolhido
                                                    //se encontrou o estado
                                                    if (curso) {
                                                        var url = '../Registro/carregaPeriodoLetivo/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                                                        $.get(url, function (dataReturn) {
                                                            $('#load_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
                                                        });
                                                    } else {
                                                        alert('Erro ao Selecionar Curso');
                                                    }
                                                }

                                                function buscar_turma() {
                                                    var curso = $('#curso').val();  //codigo do estado escolhido
                                                    var periodo_letivo = $('#periodo_letivo').val();

                                                    //se encontrou o estado
                                                    if (curso) {
                                                        var url = '../Registro/carregaTurma/' + curso + '/' + periodo_letivo;  //caminho do arquivo php que irá buscar as cidades no BD
                                                        $.get(url, function (dataReturn) {
                                                            $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
                                                        });
                                                    }
                                                }




                                                function buscar_paginacao_receber_pagamento() {

                                                    var matricula = $('#matricula_busca').val();
                                                    var aluno = $('#aluno_busca').val();
                                                    var curso = $('#curso').val();
                                                    var turma = $('#turma_busca').val();
                                                    var periodo = $('#periodo_letivo').val();

                                                    if (matricula === '') {
                                                        matricula = 'null';
                                                    }

                                                    if (curso === '') {
                                                        curso = 'null';
                                                    }

                                                    if (turma === 'undefined' || turma == '') {
                                                        turma = 'null';
                                                    }

                                                    if (periodo === '') {
                                                        periodo = 'null';
                                                    }

                                                    if (aluno === '') {
                                                        aluno = 'null';
                                                    }


                                                    //se encontrou o estado
                                                    if ((aluno) || (curso != '0') || (turma != '0')) {
                                                        var url = '../Registro/PesquisaAlunos/' + curso + '/' + turma + '/' + aluno + '/' + periodo + '/' + matricula;  //caminho do arquivo php que irá buscar as cidades no BD
                                                        $.get(url, function (dataReturn) {
                                                            $('#load_paginacao_rp').html(dataReturn);  //coloco na div o retorno da requisicao
                                                        });
                                                    } else {
                                                        alert('Selecione um curso e turma');
                                                    }
                                                }
</script>