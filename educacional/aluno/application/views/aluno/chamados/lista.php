<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span>Meus Chamados</h1>
        <hr style="border: 1px solid #333;">
        <div class="divider"></div>
        <div class="divider"></div>

        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('message') != ""): ?>

                    <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <?php echo $this->session->flashdata('message'); ?>

                    </div>
                <?php endif; ?>


                <section class="panel">

                    <header class="panel-heading">
                      <div class="row">
                        <div class="col-lg-9">
                        <a href="<?php echo base_url(); ?>chamado/abertura"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                        </span>CHAMADO</button>
                        </a>
                      </div>

                      <div class="col-lg-3">
                          <i class="fa fa-search"></i>
                          <input id="pesquisa" name="pesquisa" type="text" class="form-control"
                                onkeyup="myFunction()" placeholder="Pesquise por Status">
                      </div>
                        <script>
                            function myFunction() {
                              var input, filter, table, tr, td, i;
                              input = document.getElementById("pesquisa");
                              filter = input.value.toUpperCase();
                              table = document.getElementById("tabelaChamados");
                              tr = table.getElementsByTagName("tr");
                              for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[5];
                                if (td) {
                                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                  } else {
                                    tr[i].style.display = "none";
                                  }
                                }
                              }
                            }
                        </script>
                        <?php echo form_close(); ?>

                    </div>
                    </header>
                  </div>

                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="tabelaChamados">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">ID</th>
                                        <th>Serviço</th>
                                        <th>Observação</th>
                                        <th>Departamento</th>
                                        <th>Dt. Abertura</th>
                                        <th>Status</th>
                                        <th>Dt. Encerramento</th>
                                        
                                        <th>Satisfação</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    $cont2 = 1;
                                    $cont3 = 1;

                                    foreach ($chamados as $row):
                                        ?>
                                        <?php
                                        $button = "<td></td>";
                                        switch ($row['chamados_status']) {
                                          case 0:
                                            $status = 'Aguardando atendimento';
                                            break;

                                            case 1:
                                              $status = 'Em andamento';
                                              break;

                                            case 2:
                                                $status = 'Encerrado';
                                                if($row['chamados_satisfacao'] == 0){
                                                $button = '<td class="center hidden-phone">
                                                    <a href="edit/'.$row['chamados_id'].'"<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>';
                                                  }else{
                                                    $button = '<td class="center hidden-phone">
                                                    <a href="edit/'.$row['chamados_id'].'"<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>';
                                                  }
                                              break;

                                          default:
                                            $status = 'Aguardando atendimento';
                                            break;
                                        }
                                         ?>

                                        <tr class="gradeU">
                                            <td style="text-align: center;"><?php echo $row['chamados_id']; ?></td>
                                            <td><?php echo $row['servicos_descricao']; ?></td>
                                            <td><?php echo $row['chamados_obs']; ?></td>
                                            <td><?php echo $row['departamento_nome']; ?></td>
                                            <td><?php echo $row['chamados_abertura']; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $row['chamados_encerramento']; ?></td>

                                            <?php
                                                echo $button;
                                             ?>

                                        </tr>

                                <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
        });
    });
</script>
