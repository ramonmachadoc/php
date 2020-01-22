
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
        		<h4 id="myModalLabel">Metodologia de Análise de Risco</h4>
      		</div>
      		<div class="modal-body">
				    

				<table class="table  table-condensed text-center table-hover table-striped fundoBranco table">
					<thead>
						<tr>
							<th colspan="3" align="center">
								<h4>SEVERIDADE DO RISCO</h4>
							</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Definições na Avaliação</th>
							<th>Significado</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Catastrófico</td>
							<td>Destruição dos Equipamentos, Multiplas Mortes</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Crítico</td>
							<td>
								Uma redução Importante das margens de segurança operacional, dano 
								físico ou uma carga de trabalhotal que os operadores não podem 
								desempenhar suas tarefas de formar precisa e completa - Lesões 
								Sérias e Graves Danos ao equipamento
							</td>
							<td>B</td>
						</tr>
						<tr>
							<td>Significativo</td>
							<td>
								Uma redução significativa das margens de segurança operacional, 
								uma redução na habilidade do operador em responder a condições 
								operacionais adversas como resultado do aumento de trabalho  - 
								Incidente Sério - Lesões as pessoas
							</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Pequeno</td>
							<td>Interferência - Limitações Operacionais - Utilização de Procedimentos de Emergências - Incidentes Menores</td>
							<td>D</td>
						</tr>
						<tr>
							<td>Insignificante</td>
							<td>Consequências Leves</td>
							<td>E</td>
						</tr>
					</tbody>
				</table>


				<br><br><br>
				<table class="table  table-condensed text-center table-hover table-striped fundoBranco table">
					<thead>
						<tr>
							<th colspan="3" align="center">
								<h4>PROBABILIDADE DO EVENTO</h4>
							</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Definições Qualitativa</th>
							<th>Significado</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Frequente</td>
							<td>É Provável que ocorra muitas vezes ( Tem ocorrido frequentemente)</td>
							<td>5</td>
						</tr>
						<tr>
							<td>Ocasional</td>
							<td>É Provável que ocorra algumas vezes ( Tem Ocorrido com pouca Frequência)</td>
							<td>4</td>
						</tr>
						<tr>
							<td>Remoto</td>
							<td>Improvável, mas é possível que venha ocorrer (Ocorre raramente)</td>
							<td>3</td>
						</tr>
						<tr>
							<td>Improvável</td>
							<td>Bastante Improvável que ocorra ( Não se tem Notícia que tenha ocorrido)</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Muito Improvável</td>
							<td>Quase Imposs´vel que o evento ocorra</td>
							<td>1</td>
						</tr>
					</tbody>
				</table>



				<br><br><br>
				<table class="table  table-condensed text-center table-hover table-striped fundoBranco table">
					<thead>
						<tr>
							<th colspan="3" align="center">
								<h4>SEVERIDADE DO RISCO</h4>
							</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Probabilidade de Risco</th>
							<th>Catastrófico  (A)</th>
							<th>Crítico (B)	</th>
							<th>Significativo ( C )</th>
							<th>Pequeno (D)	</th>
							<th>Insignificante (E)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Frequente (05)</td>
							<td>5A</td>
							<td>5B</td>
							<td>5C</td>
							<td>5D</td>
							<td>5E</td>
						</tr>
						<tr>
							<td>Ocasional (04)</td>
							<td>4A</td>
							<td>4B</td>
							<td>4C</td>
							<td>4D</td>
							<td>4E</td>
						</tr>
						<tr>
							<td>Remoto (03)</td>
							<td>3A</td>
							<td>3B</td>
							<td>3C</td>
							<td>3D</td>
							<td>3E</td>
						</tr>
						<tr>
							<td>Improvável (02)</td>
							<td>2A</td>
							<td>2B</td>
							<td>2C</td>
							<td>2D</td>
							<td>2E</td>
						</tr>
						<tr>
							<td>Muito ImprováVEL (01)</td>
							<td>1A</td>
							<td>1B</td>
							<td>1C</td>
							<td>1D</td>
							<td>1E</td>
						</tr>
					</tbody>
				</table>

				<br><br>
				<?php echo CHtml::image( Yii::app()->request->baseUrl . "/images/metodologia.jpg"); ?>


      		</div>
      		<!--<div class="modal-footer">
        		<button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
      		</div>-->

    	</div>
  	</div>
</div>

<style>
	.modal-body {
 		max-height: 500px;
		overflow-y: scroll;
	}
</style>