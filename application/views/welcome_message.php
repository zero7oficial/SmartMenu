	<?php
	
	/**
	*  	MENFIS - MENU FISCAL - ZERO7
	* 
	*	Sistema para gestão de praças de alimentação em eventos. 
	*	Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
	*  	Sistema de Pedido Pronto para exibição em TV, <?php echo $codeEmpresa; ?>ART TVS E PAINEIS DE LED
	*
	* @package		MENFIS 
	* @version  	1.0
	* @author   	Agência Zero7
	* @copyright 	Copyright (c) 2017, Agência Zero7 - 17.254.945/0001-32
	* @link 		http://menfis.agencia07.com.br/
	*
	*
	*/
	?>

<!-- INICIO SECTION APRESENTAÇÃO -->
	<section id="apresentacao"> 
	<!-- INICIO ROW -->
	 	<div class="row">
		<!-- INICIO NAVEGAR -->
			 		<div id="navegar"  class="col-md-12 col-xs-12">
			 			<div id="navegacao">
				 			<div class="col-md-5 col-xs-12">
				 				<a href="#pizzas" id="bt-pizza" class="pizzas-view">
				 					<button id="produto1" class="col-md-12 col-xs-12 btn btn-lg btn-success">
				 						<h3><i class="fa fa-cutlery fa-1x"></i> LANCHES</h3>
				 					</button>
				 				</a>
				 			</div>
				 			<div class="col-md-2 col-xs-12" >
				 				<hr class="divisor" />
				 			</div>
				 			<div class="col-md-5 col-xs-12" >
				 				<a href="#vinhos" id="bt-vinho" class="vinhos-view">
				 					<button id="produto2" class="col-md-12 col-xs-12 btn btn-lg btn-success">
				 						<h3><i class="fa fa-cutlery fa-1x"></i> BEBIDAS</h3>
				 					</button>
				 				</a>
				 			</div>
			 			</div><!-- fim da navegacao -->
			 		</div>
		<!-- FIM NAVEGAR -->
		<!-- INICIO COMANDA -->
		 	<div id="comanda_V" class="col-md-12 col-xs-12">
		 		<!-- Inicio da Comanda -->
			 		<div id="comanda" class="col-xs-12 col-md-12 hidden">
			 			<div class="clearfix"> </div>
		 					<hr class="divisor" />
		 				<!-- Inicio Tabela Comanda -->
				 			<div class="col-xs-12 col-md-12 center-block">
								<table class="table" width="100%">						
										<tr>
											<td width="20%">PRODUTO</td>
											<td width="2%">QNTD</td>
											<td width="10%">VALOR</td>
											<td width="10%">OPÇÕES</td>
										</tr>
										<?php foreach ($comandaExib as $row) { ?>
										<tr>
											
											<td><?php echo $row->nome ?></td>
											<td><?php echo $row->qntd  ?></td>
											<td>R$ 
											<?php
											$this->load->helper("funcoes"); 
											$valor = $row->valor;

											echo formata_preco($valor);

											?></td>
											<script type="text/javascript">
												function del_ped() {
												  $.ajax({
												    type: "POST",
												    url: '<?php echo base_url(); ?>index.php/comanda/delProduto/<?php echo $row->ID ?>',
												    data: {
												     	mesaId: '<?php echo $checando[0]->mesa_id; ?>', 
														clienteId: '<?php echo $pedID; ?>',
												    },
												    success: function(data) {
												    
													    $('#deletado').removeClass('hidden');
												    }
												  });
												}									
											</script>
											<div id="deletado" class="hidden"><h4>PRODUTO DELETADO!</h4></div>

										<!-- Inicio Modal de Confirma Pedido -->
											<div id="deletando" class="modal fade">
											    <div class="modal-dialog">
											        <div class="modal-content">
											            <div class="modal-header">
											                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="redireciona()">&times;</button>
											                <h4 class="modal-title">Deletado!</h4>
											            </div>
											            <div class="modal-body">
											                <h4>Produto Deletado.</h4>
											                <p class="text-warning"><small>Produto deletado da comanda.</small></p>
											            </div>
											            <div class="modal-footer">
											                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">Fechar</button>
											            </div>
											        </div>
											    </div>
											</div>
											<td><?php 
											$produtoConfirmado = $row->confirmado;
											if($produtoConfirmado == 0) { ?>
													<button id="delproduto" type="button" onclick="del_ped()" class="btn btn-danger"  data-toggle="modal" data-target="#deletando"><i class="fa fa-trash"></i></button></td>
												<?php } else { ?>

													<a href="#"><button type="button" class="btn btn-pizza"><i class="fa fa-check"></i></button></a></td>

												<?php } ?>
										</tr>
										<?php } ?>
								</table>
							</div>
						<!-- Fim Tabela Comanda -->
					<!-- Inicio Exibir Valor -->
						<div class="col-xs-12 col-md-6">
							<h4>VALOR TOTAL: R$ <?php

								$valorTotal = (implode(" ", $somaValor[0]));

								if ($valorTotal == NULL) {
									
									print_r($valorTotal);

								}else{

									print_r(formata_preco($valorTotal));

								}
							 ?> </h4>
						</div>
					<!-- Fim Exibir Valor -->
					<!-- Início do Bloco de Botões -->
							<div id="bl-btn" class="col-md-12 col-xs-12 center-block">	
								<div class="col-md-12 col-xs-12">
								<?php if ($produtoConfirmado == 0) { ?>

									<button id="confirmaPedido" onclick="conf_ped()" class="btn btn-large btn-block btn-danger" data-toggle="modal" data-target="#confpedido">CONFIRMAR PEDIDO</button>
									<div class="clearfix"> </div>
									<hr class="divisor" /> 
									
								<?php }else{ ?>

									<a href="<?php echo base_url(); ?>index.php/"><button id="novoPedido" class="btn btn-large btn-block btn-success">NOVO PEDIDO</button></a>
									<div class="clearfix"> </div>
									<hr class="divisor" /> 

								<?php }	?>				
									
									
								</div>					
								<div id="confirmado" class="hidden"><h4>PEDIDO CONFIRMADO!</h4></div>
								<!-- Inicio Modal de Confirma Pedido -->
									<script type="text/javascript">
											function conf_ped() {
											  $.ajax({
											    type: "POST",
											    url: '<?php echo base_url(); ?>index.php/comanda/confPedido',
											    data: {
											     	mesaId: '<?php echo $checando[0]->mesa_id; ?>', 
													clienteId: '<?php echo $pedID; ?>',
											    },
											    success: function(data) {
											    
												     $('#confirmado').removeClass('hidden');
											    }
											  });
											}									
									</script>
									<div id="confpedido" class="modal fade">
										    <div class="modal-dialog">
										        <div class="modal-content">
										            <div class="modal-header">
										                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="redireciona()">&times;</button>
										                <h5 class="modal-title">SUCESSO! SEU TICKET É <?php echo $codeEmpresa; ?><?php echo $pedID; ?></h5>
										            </div>
										            <div class="modal-body">
										                <h5>Sucesso! EFETUE O PAGAMENTO NO CAIXA.</h5>
										                <p class="text-warning"><small>Seu pedido será produzido após a confirmação do pagamento. Use o número do seu ticket - </small> <?php echo $codeEmpresa; ?><?php echo $pedID; ?></p>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">Fechar</button>
										            </div>
										        </div>
										    </div>
									</div>
								<!-- Fim do Modal de Confirma Pedido -->
							</div>
					<!-- Fim do Bloco de Botões -->
			 		</div>
			 	<!-- Fim da Comanda -->
			 	<div class="clearfix"> </div>
			 	<hr class="divisor" />
		 	</div>
		<!-- FIM COMANDA -->
		<!-- INICIO JS's -->
				<script type="text/javascript">
					function redireciona(){
						$(document.location.reload(true), 7000);
					}
				</script>
		<!-- FIM JS's -->
		<!-- INICIO EXIBICAO PRODUTOS -->
		 	<div id="exibicao_produtos" class="col-md-8 col-xs-12">			 	
			 	<!-- Inicio do cardápio -->
					<div id="pizzas" class="cardapio hidden">
					<!-- Inicio bloco de produto -->
						<?php $clienteId = $pedID; ?>
							<?php foreach ($pizzas as $row) {  ?>							
							<div id="bloc_pro" class="col-md-12 col-xs-12">
								<div id="img-produto" class="col-md-4 col-xs-12">
									<img src="<?php echo base_url(); ?>uploads/<?php echo $row->imagem; ?>.jpg" class="img-responsive" height="100%" alt="<?php echo $row->titulo; ?>"/>
								</div>
								<div id="info-produto"  class="col-md-4 col-xs-12">
									<div id="tit-produto" class="col-md-12 col-xs-12">
										<h4 class="titcard"><?php echo $row->titulo; ?></h4>
									</div>
									<div id="desc-produto" class="col-md-12 col-xs-12">
										<p class="descard"><?php echo $row->descricao; ?></p>
									</div>
									<div id="preco" class="col-md-12 col-xs-12">
									<?php $this->load->helper("funcoes"); ?>
										<h3 class="text-center">R$ <b> <?php echo formata_preco($row->preco); ?></b></h3>
									</div>
								</div>
								<!-- Inicio Exibir Preço -->
								<div id="exib_preco" class="col-md-4 col-xs-12">
									<!-- inicio do form prod -->
										<div id="form-produto" class="col-md-12 col-xs-12 preco">	
											<form action="<?php echo base_url(); ?>index.php/comanda/addLanches" method="post">

												<input type="text" hidden name="clienteId" value="<?php echo $clienteId; ?> ">
												<input type="text" hidden name="mesaId" value="<?php echo $checando[0]->mesa_id; ?> ">
												<input type="text" hidden name="nome" value="<?php echo $row->titulo; ?> ">
												<input type="text" hidden name="cardID" value="<?php echo $row->ID; ?> ">
												<input type="text" hidden name="valor" value="<?php echo $row->preco; ?>" />

												<p>QUANTIDADE: <input type="number" class="form-control" name="qntd" min="1" value="1"></p>
												
												<p>Obs.:<textarea class="form-control" id="observac" name="observac" rows="2" maxlength="80" width="100%" placeholder="Ex.: Sem Cebola"></textarea></p>

												<div class="col-xs-12 clearfix"><br /> </div>
												<?php 
												$estoque = $row->estoque;
												switch ($estoque) {
													case '1': 
														echo '<div class="col-xs-12 col-md-12"><button class="btn btn-lg btn-pizza disabled">SEM ESTOQUE</button></div>';
														break;
													
													default:
														echo '<div class="col-xs-12 col-md-12"><button class="btn btn-lg btn-pizza"> ADD À COMANDA</button></div>';
														break;
												}
												
												 ?>								
											</form>
										</div>
									<!-- fim do form prod -->	
								</div>
								<!-- Fim Exibir Preço -->			
								<div class="clearfix"> </div>
			 					<hr class="divisor" />
			 				</div>
							<?php } ?>
					<!-- Fim do bloco de produto -->			
					</div>
				<!-- fim do cardápio -->
				<!-- Inicio das Bebidas -->
					<div id="vinhos" class="vinhos hidden">
						<!-- Inicio bloco de Bebidas -->
							<?php foreach ($bebidas as $row) {  ?>
							<div id="bloc_pro" class="col-md-12 col-xs-12">
								<div id="img-produto" class="col-md-4 col-xs-12">
									<img src="<?php echo base_url(); ?>uploads/<?php echo $row->imagem; ?>.jpg" alt="<?php echo $row->titulo; ?>" class="img-responsive">
								</div>
								<div id="info-produto" class="col-md-4 col-xs-6">
									<h4 class="titcard"><?php echo $row->titulo; ?></h4>
									<p class="descard"><?php echo $row->descricao; ?></p>
									<?php $this->load->helper("funcoes"); ?>
									<h3 class="preccard">R$ <?php $valor  = $row->preco; echo formata_preco($valor); ?></h3>
								</div>
								<div id="exib_form" class="col-md-4 col-xs-12 preco">
								<!-- Inicio Form Bebidas -->
									<form action="<?php echo base_url(); ?>index.php/comanda/addBebidas" method="post">

										<input type="text" hidden name="clienteId" value="<?php echo $clienteId; ?>" />
										<input type="text" hidden name="mesaId" value="<?php echo $checando[0]->mesa_id; ?> " />
										<input type="text" hidden name="nome" value="<?php echo $row->titulo; ?> " />
										<input type="text" hidden name="bebID" value="<?php echo $row->ID; ?> " />
										<input type="text" hidden name="valor" value="<?php echo $row->preco; ?>" />
										<p>QUANTIDADE: <input type="number" class="form-control" name="qntd" min="1" value="1"></p>
											<div class=" clearfix"><br /></div>
											<div class="col-xs-12 col-md-12">
												<button class="btn btn-lg btn-pizza"> ADD À COMANDA</button>
											</div>
											<div class=" clearfix"><br /></div>
												<div class="col-xs-12 col-md-12"><hr class="divisor" /> </div>								
									</form>
								<!-- Fim Form Bebidas -->
								</div>
								<div class="clearfix"> </div>
								<hr class="divisor" />	
							</div>							
							<?php } ?>
						<!-- Fim do bloco de Bebidas -->
					</div>
				<!-- Fim das bebidas -->					
			</div>
		<!-- FIM EXIBIÇAO PRODUTOS -->
		<!-- INICIO LATERAL -->
			<div id="lateral-direita" class="col-md-4 col-xs-12"></div>
			<div class="clearfix"> </div>
			<hr class="divisor" /> 
		<!-- FIM LATERAL -->
		<!-- INICIO PUBLICIDADE -->
				<div class="col-md-12 col-xs-12">
					<?php foreach ($publicidade as $pub) { ?>
						<div class="col-md-12 col-xs-12">
							<a href="<?php echo $pub->link; ?>" title="<?php echo $pub->descricao; ?>" target="_blank"><img src="<?php echo base_url(); ?>uploads/publicidade/<?php echo $pub->imagem; ?>.png" class="img-responsive" width="100%" /></a>
						</div>
					<?php } ?>
					<div class="clearfix"> </div>
				</div>
		<!-- FIM PUBLICIDADE -->
	 	</div>
	<!-- FIM ROW  -->
	</section> 
<!-- FIM SECTION APRESENTAÇÃO -->