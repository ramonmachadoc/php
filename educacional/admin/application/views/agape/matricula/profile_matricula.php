<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <aside class="profile-nav col-lg-2">
                <section class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <?php
                            $arquivo = "upload/aluno/" . $turma['cadastro_aluno_id'] . ".jpg";

                            if (file_exists($arquivo)) {
                                ?>
                                <img src="<?php echo base_url(); ?>upload/aluno/<?php echo $turma['cadastro_aluno_id']; ?>.jpg" alt="">
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url(); ?>template/img/sem-imagem.png" alt="">
                                <?php
                            }
                            ?>


                        </a>
                        <h1><?php
                            $temp = explode(" ", $turma['nome']);
                            echo $nomeNovo = $temp[0] . " " . $temp[count($temp) - 1];
                            ?></h1>
                        <p><?php echo $turma['email']; ?></p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="profile.html"> <i class="fa fa-user"></i> Ficha Aluno</a></li>
                        <li><a href="profile-activity.html"> <i class="fa fa-calendar"></i> Histórico<span class="label label-danger pull-right r-activity">9</span></a></li>
                        <li><a href="profile-edit.html"> <i class="fa fa-edit"></i> Situação Financeira</a></li>
                        <li><a href="<?php echo base_url(); ?>educacional/ficha_aluno_bolsa/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-camera"></i> Bolsas<span class="label label-danger pull-right r-activity">1</span></a></li>
                    </ul>
                </section>
            </aside>



            <aside class="profile-info col-lg-10">
                <section class="panel">
                    <header class="panel-heading summary-head" style="height: 40px; line-height: 50px;">
                        <!--                        <h4>DADOS ALUNO</h4>-->
                        <p></p>
                    </header>
                    <div class="panel-body" style="font-size: 15px;">

                        <?php
                        $dadosIngresso = $this->agape_model->PeriodLetivo($turma['matricula_aluno_id']);
                        $dadosMatriz = $this->agape_model->MatrizAtual($turma['matriz_id']);
                        if ($dadosIngresso['periodo_letivo_id']) {
                            $dadosPeriodo = $this->agape_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
                            $ano_igresso = $dadosPeriodo['periodo_letivo'];
                        } else {
                            $ano_igresso = $dadosIngresso['ano'] . '/' . $dadosIngresso['semestre'];
                        }
                        ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="bio-desk">
                                            <p><b>Nome:</b> <?php echo $turma['nome']; ?></p>
                                            <p><b>Curso:</b> <?php echo $turma['cur_tx_descricao']; ?></p>
                                            <p><b>Registro Academico:</b> <?php echo $turma['registro_academico']; ?></p>
                                            <p><b>Ano ingresso:</b> <?php echo $ano_igresso; ?></p>
                                            <p><b>Forma de ingresso:</b> <?php echo $turma['AlunoIngresso']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="bio-desk">
                                            <p><b>Matriz Atual:</b> <?php echo $dadosMatriz['mat_tx_ano'] ?>/ <?php echo $dadosMatriz['mat_tx_semestre']; ?></p>
                                            <p><b>Periodo Atual:</b> <?php echo $turma['periodoAtual']; ?></p>
                                            <p><b>Desperiodizado?</b> <?php echo $turma['AlunoBolsista']; ?></p>
                                            <p><b>Bolsista?</b> <?php echo $turma['SituacaoAluno']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>


                        <div class="row">
                            <div class="col-lg-12">
                                <header class="panel-heading">
                                    <b>INFORMAÇÕES (S)</b>
                                </header>
                            </div>
                        </div>
                        <br/>
                        <?php
                        $dadosPeriodos = $this->agape_model->PeriodCoursed($turma['matricula_aluno_id'],0);
                        ?>


                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <table class="table table-striped table-advance table-hover">
                                        <thead>
                                            <tr>
                                                <th><i class="fa fa-users"></i> Turma</th>
                                                <th><i class="fa fa-calendar"></i> Período Letivo</th>
                                                <th><i class="fa fa-bookmark"></i> Período</th>
                                                <th><i class=" fa fa-clock-o"></i> Turno</th>
                                                <th><i class=" fa fa-money"></i> Bolsas e Finan.</th>
                                                <th>AÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($dadosPeriodos as $rowPeriod):

                                                $periodo_letivo = $rowPeriod['periodo_letivo'];
                                                if ($periodo_letivo) {
                                                    $periodo_letivo = $rowPeriod['periodo_letivo'];
                                                } else {
                                                    $periodo_letivo = $rowPeriod['ano'] . '/' . $rowPeriod['semestre'];
                                                }
                                                $periodo = $rowPeriod['periodo'];
                                                if ($periodo) {
                                                    $periodo2 = $rowPeriod['periodo'];
                                                } else {
                                                    $periodo = $rowPeriod['periodo_mat'];
                                                }

                                                $dadosBolsa = $this->agape_model->CarregaBolsas($rowPeriod['matricula_aluno_turma_id']);
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowPeriod['tur_tx_descricao']; ?></td>
                                                    <td class="hidden-phone"><?php echo $periodo_letivo; ?></td>
                                                    <td><?php echo $periodo; ?> </td>
                                                    <td><?php echo $rowPeriod['turno'] ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($dadosBolsa as $rowBolsa):
                                                            ?>
                                                            <p><button type="button" class="btn btn-success btn-sm">  <?php echo $rowBolsa['bolsa'];?></button></p>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                                    </td>
                                                </tr>

                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                        <br/>
                    </div>
                </section>
            </aside>
        </div>
    </section>
</section>

<script>
    $(function () {
        $('#default').stepy({
            backLabel: 'Anterior',
            validate: false,
            block: true,
            nextLabel: 'Próximo',
            titleClick: true,
            titleTarget: '.stepy-tab'
        });
    });
    // busca turmas, conforme curso selecioando
    function buscar_turma_matricula() {
        var curso = $('#curso').val(); //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = '../educacional/carrega_turma_matricula/' + curso; //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_matricula').html(dataReturn); //coloco na div o retorno da requisicao
            });
        }
    }

    //busca aluno desperiorizado
    function buscar_desperiorizado_matricula() {
        var url = '../educacional/carrega_div_desperiorizado/'; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_desperiozado_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
        });
        buscar_disciplina_desperiodizado_tabela_mn();
    }

    function buscar_disciplina_desperiodizado_tabela_mn() {
        //  var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        //se encontrou o estado
        var url = '../educacional/carrega_disciplina_desperiodizado_tabela_mn/'; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_desperiodizado_tabela_mn').html(dataReturn); //coloco na div o retorno da requisicao

        });
    }

    function buscar_disciplina_matricula_nova() {

        var curso = $('#curso').val();
        var turma = $('#turma').val(); //codigo do estado escolhido

        //se encontrou o estado
        var url = '../educacional/carrega_disciplina_matricula_nova/' + curso + '/' + turma; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_disciplina_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
        });
    }
    function adicionar_disciplina_desperiodizado_mn() {
        // var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        var turma = $('#turma').val(); //codigo da turma selecionada
        var matriz_disciplina_id = $('#matriz_disciplina_id_mn').val(); //codigo do id da tabela matriz_disciplina, onde chega no id da disciplina

        //se encontrou o estado
        var url = '../educacional/insert_disciplina_desperiodizado_mn/' + turma + '/' + matriz_disciplina_id; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_add_disciplina_desperiodizado_mn').html(dataReturn); //coloco na div o retorno da requisicao
        });
        buscar_disciplina_desperiodizado_tabela_mn();
        // buscar_ficha_periodizado(matricula_aluno_id);
    }

    function apagar_disciplina_desperiodizado(disciplina_desperiodizado_id) {
        var id_disciplina_desperiodizado = disciplina_desperiodizado_id; //$('#disciplina_desperiodizado_id').val(); //codigo do id da tabela matricula_aluno
        // var matricula_aluno_id = $('#matricula_aluno_id').val();
        //se encontrou o estado
        var url = '../educacional/delete_disciplina_desperiodizado_mn/' + id_disciplina_desperiodizado; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_desperiozado_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
        });
        buscar_disciplina_desperiodizado_tabela_mn();
        //buscar_ficha_periodizado_um();
    }


    function buscar_municipio() {

        var uf = $('#uf_nascimento').val(); //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = '../educacional/carrega_municipio_matricula_nova/' + uf; //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
            });
        }
    }


    function buscar_cidade() {

        var uf2 = $('#uf').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf2) {
            var url = '../educacional/carrega_cidade/' + uf2;  //caminho do arquivo php que irÃ¡ buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_cidade').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }


</script>

<script type="text/javascript" >

    $(document).ready(function () {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }
        //Quando o campo cep perde o foco.
        $("#cep").blur(function () {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...")
                    $("#bairro").val("...")
                    $("#cidade").val("...")
                    $("#uf").val("...")
                    $("#ibge").val("...")

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });

</script>