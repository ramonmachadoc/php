<br>
<div style="display: table; margin: 0 auto; width: 95%; text-align: center;">
	

	<h3 id='tituloPagina'><i class="fa fa-retweet"></i> Escolha das causas mais prováveis (Hipóteses)</h3>

	<table width="100%" border="0">
		<tr>
			<td>Método</td>
			<td>Máquina</td>
			<td>Mensagem</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<?php echo $form->textField($ishikawa,'metodoA', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'maquinaA', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'mensagemA', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>
			</td>
			<td rowspan="6">
				Problema
				<?php echo $form->textArea($ishikawa, 'problema', array(
					'rows'        => 2,
					'placeholder' => '',
					'class'       => 'form-control',
					//'style'     => 'width:100% !important',
				)); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->textField($ishikawa,'metodoB', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>	</td>
			<td>
				<?php echo $form->textField($ishikawa,'maquinaB', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'mensagemB', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->textField($ishikawa,'metodoC', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>	
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'maquinaC', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>				
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'mensagemC', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
		</tr>

		<tr>
			<td colspan="3"><hr></td>
		</tr>

		<tr>
			<td>
				<?php echo $form->textField($ishikawa,'meioA', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
			<td>	
				<?php echo $form->textField($ishikawa,'materialA', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'maoA', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>	
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->textField($ishikawa,'meioB', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'materialB', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>				
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'maoB', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->textField($ishikawa,'meioC', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'materialC', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>			
			</td>
			<td>
				<?php echo $form->textField($ishikawa,'maoC', array(
					'class'     => 'form-control', 
					'maxlength' => 100,
				)); ?>
			</td>
		</tr>
		<tr>
			<td>Meio Físico</td>
			<td>Materiais</td>
			<td>Mão de Obra</td>
			<td></td>
		</tr>
	</table>

</div>
<br><br>
