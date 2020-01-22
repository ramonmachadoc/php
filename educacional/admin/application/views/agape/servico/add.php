<section id="main-content">
    <section class="wrapper">
      <script>
      function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
           var sep = 0;
           var key = '';
           var i = j = 0;
           var len = len2 = 0;
           var strCheck = '0123456789';
           var aux = aux2 = '';
           var whichCode = (window.Event) ? e.which : e.keyCode;
           if (whichCode == 13 || whichCode == 8) return true;
           key = String.fromCharCode(whichCode); // Valor para o código da Chave
           if (strCheck.indexOf(key) == -1) return false; // Chave inválida
           len = objTextBox.value.length;
           for(i = 0; i < len; i++)
               if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
           aux = '';
           for(; i < len; i++)
               if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
           aux += key;
           len = aux.length;
           if (len == 0) objTextBox.value = '';
           if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
           if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
           if (len > 2) {
               aux2 = '';
               for (j = 0, i = len - 3; i >= 0; i--) {
                   if (j == 3) {
                       aux2 += SeparadorMilesimo;
                       j = 0;
                   }
                   aux2 += aux.charAt(i);
                   j++;
               }
               objTextBox.value = '';
               len2 = aux2.length;
               for (i = len2 - 1; i >= 0; i--)
               objTextBox.value += aux2.charAt(i);
               objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
           }
           return false;
       }
 </script>
        <div class="col-lg-8">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-users"></span> NOVO SERVIÇO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('servico/add/', array('enctype' => 'multipart/form-data', 'id' => 'FormAddServicos')); ?>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input name="descricao" required="required" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>SLA</label>
                                                <input type="number" min="0" name="sla" required="required" class="form-control" >
                                              </input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>Departamento</label>
                                              <select class="form-control" required="required" name="departamento">
                                                  <option value="">Selecione o Departamento</option>

                                                  <?php
                                                  foreach ($departamentos as $row):
                                                      ?>
                                                      <option value="<?php echo $row['departamento_id']; ?>"><?php echo $row['departamento_nome']; ?></option>
                                                      <?php
                                                  endforeach;
                                                  ?>

                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>Valor R$</label>
                                              <input type="text" name="valor" required="required" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                                            </input>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br/>
                                            <button type="submit" class="btn btn-info">Cadastrar</button>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_close(); ?>
                            </section>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </section>
</section>

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>
