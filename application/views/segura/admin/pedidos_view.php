<section class="col-md-8">
	<div class="panel panel-primary">
		<div class="panel-heading">LISTA DE PEDIDOS EM ORDEM DE PEDIDO</div>
		<div class="panel-body">				
			<table class="table">						
				<tr>
					<td hidden><h4>MESA</h4></td>
					<td><h4>TICKET</h4></td>
					<td><h4>HORÁRIO</h4></td>
					<td><h4>OPÇÕES</h4></td>
				</tr>
			<?php foreach ($pedidos as $item) { ?>
					<?php 
						$pronto = $item->pronto;
							if ($pronto == 0 or $pronto == NULL) { ?>	
								<tr id="atualizando">
									<td hidden><h4><?php echo $item->mesa_id; ?></h4></td>
									<td><h4><?php echo $codeEmpresa; ?><?php echo $item->cliente_id; ?></h4></td>
									<td>
								<?php
									$data = strtotime($item->pedhora);

									$dia = date("j", $data);
									$hora = date("H", $data);
									$minuto = date("i", $data);
									$segundo = date("s", $data);
									  
									$semana = array(0 => "Domingo",1 => "Segunda", 2 => "Terça", 3 => "Quarta",  4 => "Quinta", 5 => "Sexta",  6 => "Sábado");
									$mes = array(1 => "Janeiro",  2 => "Fevereiro",  3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro",  11 => "Novembro", 12 => "Dezembro");
									  
									$ano = date("Y", $data);
									$data_completa = date("d/m/y", $data);
									$hora_completa = $hora.":".$minuto;
									$misc = $semana[date("w", $data)].", ".date("j", $data)." de ".$mes[date("n", $data)]." as ". $hora_completa;
				 
									

									echo $misc;

								?></td>
									<td>
										<?php $clienteId = $item->cliente_id; ?>
										<td>
											<a title="Cancelar Pedido" href="<?php echo base_url(); ?>index.php/administracao/deletarP/<?php echo $item->ID; ?>"><button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button></a>
										</td>
										<td>
											<?php if ($item->pago == 0 or $item->pago == NULL) { ?>
												<form action="#" type="post">
													<input type="text" hidden name="clienteId" value="<?php echo $clienteId ?>" />
													<input type="text" hidden name="metodo" value="dinheiro" />
													<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#aprontando"><i class="fa fa-money"></i></button>
												</form>
											<?php }else{ ?> 

												<button class="btn btn-warning"><i class="fa fa-money"></i> <i class="fa fa-check"></i></button>

											<?php } ?>
										</td>
										<td>
											<a title="Ver Pedido" href="<?php echo base_url(); ?>index.php/administracao/visualP/<?php echo $item->cliente_id; ?>"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button></a>
										</td>
										<td>
											<a title="Editar Pedido" href="<?php echo base_url(); ?>index.php/administracao/alacarte/<?php echo $item->cliente_id; ?>"><button type="button" class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
										</td>
										<td>
											<form action="<?php echo base_url(); ?>index.php/administracao/prontoCom/" type="post">
												<input type="text" hidden name="clienteId" value="<?php echo $clienteId ?>" />
												<button id="pedPronto" type="submit" class="btn btn-success" data-toggle="modal" data-target="#aprontando"><i class="fa fa-check-circle"></i> Pronto</button>
											</form>
										</td>
									
									</td>
								</tr>
					<?php } ?>
			<?php } ?>
			</table>
			<div class="panel-footer">
					<!-- Inicio Confirmando Pagamento -->
						<script type="text/javascript">
								function confPag() {
								  $.ajax({
								    type: "POST",
								    url: '<?php echo base_url(); ?>index.php/administracao/pagCom',
								    data: {
								    	clienteId: '<?php echo $clienteId; ?>',
								     	pagamento: '1',
								    },
								    success: function(data) {
								    
									    $('#confirmado').removeClass('hidden');
								    }
								  });
								}									
						</script>
						<div id="confirmando" class="modal fade">
							<div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="redireciona()">&times;</button>
							                <h4 class="modal-title">Pagamento Confirmado</h4>
							            </div>
							            <div class="modal-body">
							                <p class="text-warning"><small>Você confirmou o pagamento do Ticket <?php echo $codeEmpresa; ?><?php echo $clienteId; ?>.</small></p>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">Fechar</button>
							            </div>
							        </div>
							    </div>
							</div>
					<!-- Fim Confirmando Pagamento -->

					<!-- Inicio Pedido Pronto -->
							<div id="aprontando" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="redireciona()">&times;</button>
							                <h4 class="modal-title">Pedido Pronto</h4>
							            </div>
							            <div class="modal-body">
							                <p class="text-warning"> O pedido está pronto para ser retirado.</p>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">Fechar</button>
							            </div>
							        </div>
							    </div>
							</div>
					<!-- Fim Pedido Pronto --> 	
			</div>
		</div>
	</div>
	<script type="text/javascript">

				function redireciona(){

					 $(document.location.reload(true), 7000);
				}

			</script>
</section>
<section class="col-md-4">
	<div class="center">
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarALC"><button class="btn btn-small btn-pizza"><i class="fa fa-cutlery"></i> NOVO PEDIDO</button></a>	
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarPIZZA"><button class="btn btn-small btn-pizza"><i class="fa fa-cutlery"></i> NOVA PIZZA</button></a>	
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
	</div>
	<script type="text/javascript">
		function redireciona(){
		$(document.location.reload(true), 7000);
		}
	</script>
	<p><code>Painel de Controle em desenvolvimento.</code></p>
	<p>A agência07 preza pela segurança de dados de nossos clientes, esse nosso diferencial é, fazer o que tem que ser feito, para maior segurança de toda a aplicação. Essa versão é a 1.0. Atualizaremos em breve.</p>
</section>

</body>