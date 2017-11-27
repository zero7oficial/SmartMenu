<?php 

	/**
	*  	SmartMenu - Menu Fiscal para Praças de Alimentação
	* 
	*	Sistema para gestão de praças de alimentação em eventos. 
	*	Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
	*  	Sistema de Pedido Pronto para exibição em TV, SMART TVS E PAINEIS DE LED
	*
	* @package		SmartMenu 
	* @version  	1.0
	* @author   	Agência Zero7
	* @copyright 	Copyright (c) 2017, Agência Zero7 - 17.254.945/0001-32
	* @link 		https://smartmenu.agencia07.com.br/
	*
	*
	*/

 ?>
<section id="cardapio" class="fundo" role="main"> 
 	<div class="row"> 		
 		<div class="col-md-12 col-xs-12"><!-- inicio da col-12 do menu de navegação -->
 			<div id="navegacao" class="pull-right">			
	 			<div id="produto1" class="col-md-6">
	 				<a href="#pizzas" id="bt-pizza" class="pizzas-view"><img src="<?php echo base_url(); ?>includes/uploads/pizzas.png" alt="Vários sabores de pizzas!" class="img-responsive"></a>
	 			</div>
	 			<div id="produto2" class="col-md-6">
	 				<a href="#vinhos" id="bt-vinho" class="vinhos-view"><img src="<?php echo base_url(); ?>includes/uploads/bebidas.png" alt="Vinhos finos para Pessoas Exigentes!" class="img-responsive"></a>
	 			</div>
 			</div><!-- fim da navegacao -->
 		</div> <!-- fim da col-12 do menu de navegação -->
 		<div class="clearfix"> </div>
 		<div class="col-xs-12 col-md-12 center-block">
 			<a href="#comanda" id="bt-comanda"><button class="btn btn-lg btn-pizza">VER MINHA COMANDA</button></a>
 		</div></div>
 		<div class="clearfix"> </div>
 		<div id="comanda" class="col-xs-12 col-md-12 hidden"><!-- Inicio da Comanda -->
 			<div class="col-xs-12 col-md-12 center-block">
				<table class="table" width="100%">						
						<tr>
							<td width="2%">#</td>
							<td width="20%">PRODUTO</td>
							<td width="40%">PREPARO</td>
							<td width="10%">PREÇO UN</td>
							<td width="2%">QNTD</td>
							<td width="10%">VALOR</td>
							<td width="10%">OPÇÕES</td>
						</tr>
						<?php foreach ($comandaExib as $row) { ?>
						<tr>
							<td><?php echo $row->ID ?></td>
							<td><?php echo $row->nome ?></td>
							<td><?php echo $row->observac ?></td>
							<td>R$ <?php
								$this->load->helper("funcoes"); 
								echo formata_preco($row->valor / $row->qntd) 
								?></td>
							<td><?php echo $row->qntd  ?></td>
							<td>R$ 
							<?php
							$this->load->helper("funcoes"); 
							$valor = $row->valor;

							echo formata_preco($valor);

							?></td>
							<td><?php if($row->confirmado == 0) { ?>
									<a href="<?php echo base_url(); ?>index.php/comanda/delProduto/<?php echo $row->ID ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
								<?php } else { ?>

									<a href="#"><button type="button" class="btn btn-pizza"><i class="fa fa-check"></i></button></a></td>

								<?php } ?>
						</tr>
						<?php } ?>
				</table>
			</div>
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
							<script type="text/javascript">
								function conf_ped() {
								  $.ajax({
								    type: "POST",
								    url: '<?php echo base_url(); ?>index.php/comanda/confPedido',
								    data: {
								     	mesaId: '<?php echo $checando[0]->mesa_id; ?>', 
										clienteId: '<?php echo $face; ?>',
								    },
								    success: function(data) {
								    
									     $('#confirmado').removeClass('hidden');
								    }
								  });
								}									
							</script>
				<div id="bl-btn" class="col-md-12 col-xs-12 center-block"><!-- Inicio do Bloco de Botões -->					
					<div class="col-md-6 col-xs-12">						
						<button id="confirmaPedido" onclick="conf_ped()" class="btn btn-large btn-block btn-danger" data-toggle="modal" data-target="#confpedido">Confirmar Pedido</button>
						<div class="clearfix"> </div>
						<hr class="divisor" /> 
					</div>					
					<div id="confirmado" class="hidden"><h4>Seu pedido foi confirmado!</h4></div>

						<!-- Inicio Modal de Confirma Pedido -->
							<div id="confpedido" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="redireciona()">&times;</button>
							                <h4 class="modal-title">Sucesso!</h4>
							            </div>
							            <div class="modal-body">
							                <h4>O seu pedido foi confirmado!</h4>
							                <p class="text-warning"><small>Aguarde um instante, um garçom irá até a sua mesa!</small></p>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">Fechar</button>
							            </div>
							        </div>
							    </div>
							</div>
						<!-- Fim do Modal de Confirma Pedido -->
					

					<script type="text/javascript">
						function fechar_cc() {
								  $.ajax({
								    type: "POST",
								    url: '<?php echo base_url(); ?>index.php/comanda/finalizando',
								    data: {
								     	mesaId: '<?php echo $checando[0]->mesa_id; ?>', 
										clienteId: '<?php echo $face; ?>',
										valorTotal: '<?php print_r($valorTotal); ?>',
								    },
								    success: function(data) {
								    
								      $('#comanda').removeClass('hidden');
								      
								    }
								  });
								}					
					</script>
					<div class="col-md-6 col-xs-12">
						<button id="fecharConta" onclick="fechar_cc()" class="btn btn-large btn-block btn-pizza" data-toggle="modal" data-target="#fecharconta">Fechar a Conta</button>
						<div class="clearfix"> </div>
					</div>
					<div id="comanda" class="hidden"><h4>Um dos nossos garçons levará a conta à você. Obrigado!</h4></div>
					<!-- Inicio Modal de Pedir Conta -->
							<div id="fecharconta" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="redireciona()">&times;</button>
							                <h4 class="modal-title">Sucesso!</h4>
							            </div>
							            <div class="modal-body">
							                <h4>Você pediu a conta!</h4>
							                <p class="text-warning"><small>Aguarde um instante, um garçom irá até a sua mesa!</small></p>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">Fechar</button>
							            </div>
							        </div>
							    </div>
							</div>
					<!-- Fim do Modal de Pedir Conta -->
				</div><!-- Fim do Bloco de Botões -->
			</div><!-- Fim da col-md-10 -->
			<script type="text/javascript">

				function redireciona(){

					 $(document.location.reload(true), 7000);
				}

			</script>
 		</div><!-- Fim da Comanda -->

 		<div class="clearfix"> </div>
 		<hr class="divisor" /> 
 		<div class="col-md-12 col-xs-12">
			<div id="pizzas" class="cardapio hidden">

				<?php 
				$ID = $this->input->get('ID');
				$Face = $perfil; 
				?>
				<?php foreach ($pizzas as $row) {  ?>
				<div class="col-md-8">
					<div class="col-md-3 col-xs-3">
						<img src="<?php echo base_url(); ?>uploads/<?php echo $row->imagem; ?>.jpg" class="img-responsive img-circle" alt="<?php echo $row->titulo; ?>"/>
					</div>
					<div class="col-md-5 col-xs-9">
						<h4 class="titcard"><?php echo $row->titulo; ?></h4>
					</div><!-- fim col-xs-6-pizzas -->
					<div class="col-md-5 col-xs-12">
						<p class="descard"><?php echo $row->descricao; ?></p>
					</div>
					<div class="col-md-4 col-xs-12 preco">
							
						<form action="<?php echo base_url(); ?>index.php/comanda/addLanches" method="post">

							<input type="text" hidden name="clienteId" value="<?php echo $face; ?> ">
							<input type="text" hidden name="mesaId" value="<?php echo $checando[0]->mesa_id; ?> ">
							<input type="text" hidden name="nome" value="<?php echo $row->titulo; ?> ">
							<input type="text" hidden name="cardID" value="<?php echo $row->ID; ?> ">

							<p>QUANTIDADE: <input type="number" class="form-control" name="qntd" min="1" value="1"></p>

							<p><select name="valor" class="form-control">
								<?php $this->load->helper("funcoes"); ?>
								<option value="<?php echo $row->preco; ?>">	R$ <?php $valor  = $row->preco; echo formata_preco($valor); ?> (brotinho)</option>
								<option value="<?php echo $row->preco1; ?>">		R$ <?php $valor1 = $row->preco1; echo formata_preco($valor1); ?> (média)</option>
								<option value="<?php echo $row->preco2; ?>">	R$ <?php $valor2 = $row->preco2; echo formata_preco($valor2); ?> (família)</option>
								<option value="<?php echo $row->preco3; ?>">		R$ <?php $valor3 = $row->preco3; echo formata_preco($valor3); ?> (grande)</option>
								<option value="<?php echo $row->preco4; ?>">	R$ <?php $valor4 = $row->preco4; echo formata_preco($valor4); ?> (gigante)</option>						
							</select></p>

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
							<div class="col-xs-12 clearfix"><br /> </div>
							<div class="col-xs-12 col-md-12"><hr class="divisor" /> </div>								
						</form>
						
					</div> <!-- fim da col-xs-4 -->
					
				</div><!-- fim da col-md-8 -->
				<?php } ?>
			</div><!-- fim da pizzas -->

			<div id="vinhos" class="vinhos hidden">
				<?php foreach ($bebidas as $row) {  ?>
				<div class="col-md-8">
					<hr class="divisor" /> 
					<div class="col-md-3">
							<img src="<?php echo base_url(); ?>uploads/<?php echo $row->imagem; ?>.jpg" alt="<?php echo $row->titulo; ?>" class="img-responsive img-rounded">
					</div>
					<div class="col-md-6">
							<h3 class="titcard"><?php echo $row->titulo; ?></h3>
							<p class="descard"><?php echo $row->descricao; ?></p>
							
					</div>
					<div class="col-md-3 preco">
						<form action="<?php echo base_url(); ?>index.php/comanda/addBebidas" method="post">

							<input 
								type="text" 
								hidden 
								name="clienteId" 
								value="<?php echo $face; ?> "
								/>
							<input 
								type="text" 
								hidden 
								name="mesaId" 
								value="<?php echo $checando[0]->mesa_id; ?> "
								/>
							<input 
								type="text" 
								hidden 
								name="nome" 
								value="<?php echo $row->titulo; ?> "
								/>
							<input 
								type="text" 
								hidden 
								name="bebID" 
								value="<?php echo $row->ID; ?> "
								/>
							<input 
								type="text"
								hidden 
								name="valor" 
								value="<?php echo $row->preco; ?>" 
								/>

								<p>QUANTIDADE: <input type="number" class="form-control" name="qntd" min="1" value="1"></p>

							<div class="col-xs-12 col-md-4"><h4><?php $this->load->helper("funcoes"); ?>R$ <?php $valor  = $row->preco; echo formata_preco($valor); ?></h4></div>

							<div class=" clearfix"><br /></div>
							<div class="col-xs-12 col-md-12"><button class="btn btn-lg btn-pizza"> ADD À COMANDA</button></div>
							<div class=" clearfix"><br /></div>
							<div class="col-xs-12 col-md-12"><hr class="divisor" /> </div>								
						</form>
					</div>
					 <br />
				</div>
				<?php } ?>	
			</div><!-- fim dos vinhos -->
			
		</div><!-- fim da col-12 da exibição dos produtos-->
		<div class="clearfix"> </div>
		<hr class="divisor" /> 

		<div class="clearfix"> </div>
		<hr class="divisor" />
		<div class="col-md-12">
			<?php foreach ($publicidade as $pub) { ?>
				<div class="col-md-3 col-xs-12">
					<a href="<?php echo $pub->link; ?>" title="<?php echo $pub->descricao; ?>" target="_blank"><img src="<?php echo base_url(); ?>uploads/publicidade/<?php echo $pub->imagem; ?>.png" class="img-responsive" width="100%" /></a>
				</div>
			<?php } ?>
		</div>
 	</div><!-- fim da row -->
</section> <!-- Fim da Section Fundo -->


			




