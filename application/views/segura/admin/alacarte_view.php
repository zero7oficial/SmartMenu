
<section class="col-md-8">
	<script type="text/javascript" charset="utf-8">		
			jQuery(document).ready(function(){

				jQuery("#btlanches").on('click', function(){

					jQuery("#exlanches").removeClass('hidden');
					jQuery("#exbebidas").addClass('hidden');
					jQuery("#exacomp").addClass('hidden');
					jQuery("#exbuffets").addClass('hidden');
					jQuery("#expizzas").addClass('hidden');
					
				});

				jQuery("#btbebidas").on('click', function(){

					jQuery("#exbebidas").removeClass('hidden');
					jQuery("#exlanches").addClass('hidden');
					jQuery("#exacomp").addClass('hidden');
					jQuery("#exbuffets").addClass('hidden');
					jQuery("#expizzas").addClass('hidden');
					
				});

				jQuery("#btacomp").on('click', function(){

					jQuery("#exacomp").removeClass('hidden');
					jQuery("#exlanches").addClass('hidden');
					jQuery("#exbebidas").addClass('hidden');
					jQuery("#exbuffets").addClass('hidden');
					jQuery("#expizzas").addClass('hidden');
					
				});

				jQuery("#btbuffet").on('click', function(){

					jQuery("#exbuffets").removeClass('hidden');
					jQuery("#exlanches").addClass('hidden');
					jQuery("#exbebidas").addClass('hidden');
					jQuery("#exacomp").addClass('hidden');
					jQuery("#expizzas").addClass('hidden');
					
				});

				jQuery("#btpizza").on('click', function(){

					jQuery("#expizzas").removeClass('hidden');
					jQuery("#exlanches").addClass('hidden');
					jQuery("#exbebidas").addClass('hidden');
					jQuery("#exacomp").addClass('hidden');
					jQuery("#exbuffets").addClass('hidden');
					
				});

				jQuery("#bt-tres").on('click', function(){

					jQuery("#insert3").removeClass('hidden');
					jQuery("#insert2").addClass('hidden');
					
				});
			});
  	</script>
  		<?php foreach ($comanda as $row) {
  			$valorAdq 	= $row->valor;
			$pesoProd	= $row->peso;
			$pago 		= $row->pago;
		} ?>
  	<?php if($pago == 0 or $pago == NULL){ ?>
		<div class="clearfix"> </div>
		<div class="col-md-12">
			<div class="btn-group">
				<button id="btlanches" type="button" class="btn btn-lg btn-primary">LANCHES</button>
				<button id="btbebidas" type="button" class="btn btn-lg  btn-danger">BEBIDAS</button>
				<button id="btacomp" type="button" class="btn btn-lg  btn-warning">ACOMPANHAMENTOS</button>
				<button id="btpizza" type="button" class="btn btn-lg  btn-success">PIZZAS</button>
				<button id="btbuffet" type="button" class="btn btn-lg  btn-info">BUFFETS</button>
			</div>
		</div>

	    <div id="exlanches" class="col-md-12 col-xs-12">
	    	<br />
			<div class="btn-primary col-md-12 col-xs-12">
				<h3>LANCHES</h3>
			</div>
			<br />
			<div class="col-md-12">
				<div class="col-md-12">
					<form>
						<div class="col-md-12">
							<div class="col-md-12">
									<div class="col-md-12">
									<br />
										<p>DIGITE A OBSERVAÇÃO PARA O LANCHE</p>
										<textarea name="obsv" class="form-control" rows="3" placeholder="Ex.: Um sem alface, e outro completo." value=""></textarea>
									<br />
									</div>
									
								<input hidden name="clienteId" type="text" height="120px" value="<?php echo $clienteID; ?>"></input>
								<input hidden name="qntd" type="text" height="120px" value="1"></input>
									<br />
								<div class="select-style col-md-12">
								<br />
									<p>AGORA SELECIONE O LANCHE</p>										
											<?php foreach ($cardapio as $row) { 
												$produtoId 	= $row->ID;
												$produtoImg = $row->imagem;
												$prodTit	= $row->titulo;
												$prodPreco	= $row->preco;
											?>
												<div class="col-md-2">
													<input type="image" name="prodid" formaction="<?php echo base_url(); ?>index.php/administracao/alacProInsert/<?php echo $clienteID; ?>" height="75px" formmethod="GET" src="<?php echo base_url(); ?>uploads/<?php echo $produtoImg; ?>.jpg" value="<?php echo $produtoId; ?>">
														<br /><?php echo $prodTit; ?><br />
													</input>
													<br />
												</div>	
											<?php } ?>	
								</div>
							</div>
						</div>
					</form>
				</div>	
			</div>
		</div>
		<div id="exbebidas" class="hidden col-md-12 col-xs-12">
			<br />
			<div class="btn-danger col-md-12 col-xs-12">
				<h3>BEBIDAS</h3>
			</div>
			<br />
			<div class="col-md-12 col-xs-12">				
				<form>
						<div class="col-md-12">
							<div class="col-md-12">
									<div class="col-md-12">
									<br />
										<p>DIGITE A OBSERVAÇÃO PARA A BEBIDA</p>
										<textarea name="obsv" class="form-control" rows="3" placeholder="Ex.: Com limão e gelo." value=""></textarea>
									<br />
									</div>
									
								<input hidden name="clienteId" type="text" height="120px" value="<?php echo $clienteID; ?>"></input>
								<input hidden name="qntd" type="text" height="120px" value="1"></input>
									<br />
								<div class="select-style col-md-12">
								<br />
									<p>AGORA SELECIONE A BEBIDA</p>										
											<?php foreach ($bebidas as $row) { 
												$produtoId 	= $row->ID;
												$produtoImg = $row->imagem;
												$prodTit	= $row->titulo;
												$prodPreco	= $row->preco;
											?>
												<div class="col-md-2">
													<input type="image" name="prodid" formaction="<?php echo base_url(); ?>index.php/administracao/alacBebInsert/<?php echo $clienteID; ?>" height="75px" formmethod="GET" src="<?php echo base_url(); ?>uploads/<?php echo $produtoImg; ?>.jpg" value="<?php echo $produtoId; ?>">
														<br /><?php echo $prodTit; ?><br />
													</input>
													<br />
												</div>	
											<?php } ?>	
								</div>
							</div>
						</div>
					</form>
			</div>
		</div>
		<div id="exacomp" class="hidden col-md-12 col-xs-12">
			<br />
			<div class="btn-warning col-md-12 col-xs-12">
				<h3>ACOMPANHAMENTOS</h3>
			</div>
			<br />
			<div class="col-md-12 col-xs-12">
				<form action="<?php echo base_url(); ?>index.php/administracao/alacAcomInsert/<?php echo $clienteID; ?>" type="GET">
					<div class="col-md-5">
						<input hidden name="clienteId" type="text" height="120px" value="<?php echo $clienteID; ?>"></input>
						<br />
						<div class="select-style">
							<p>Escolha o Acompanhamento</p>
							<select id="produtos" name="prodid" class="form-control">							
										<?php foreach ($acompanhamentos as $row) { 
											$produtoId 	= $row->ID;
											$prodTit	= $row->titulo;
											$prodPreco	= $row->preco;
										?>
								<option id="<?php echo $produtoId; ?>" value="<?php echo $produtoId; ?>"> <?php echo $prodTit; ?> (R$ <?php echo $prodPreco; ?>) <?php echo $produtoId; ?> </option>
										<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-7">
						<div class="col-md-12">
							<br />
							<p>Observações</p>
							<textarea name="obsv" class="form-control" rows="3" placeholder="Ex.: Molho Branco ao invés de Barbecue." value=""></textarea>
						</div>

						<div class="col-md-6">
							<br />
							<p>Quantidade</p>
							<input name="qntd" class="form-control" type="text" onblur="Qntd" value="1"></input>
						</div>
						<div class="col-md-6">
							<br />
							<p>Adicionar a Comanda</p>
							<button type="submit" class="btn btn-sm  btn-primary"><i class="fa fa-plus"></i> ADICIONAR</button>
						</div>
					</div>
				</form>
			</div>		
		</div>
		<div id="exbuffets" class="hidden col-md-12 col-xs-12">
			<br />
			<div class="btn-info col-md-12 col-xs-12">
				<h3>BUFFETS</h3>
			</div>
			<br />
			<div class="select-style">	
			<table class="table">
									
					<tr>
						<td><h5>NOME</h5></td>
						<td><h5>PESO</h5></td>
						<td><h5>Add Pedido</h5></td>
					</tr>
				
					<tr>
						<form action="<?php echo base_url(); ?>index.php/administracao/alacPedInsert/<?php echo $clienteID; ?>" type="GET">
							<td width="50%">
								<input hidden name="clienteId" type="text" value="<?php echo $clienteID; ?>"></input>
								
								<select id="produtos" name="prodid" class="form-control">
									<?php foreach ($alacarte as $row) { 

										$produtoId 	= $row->ID;
										$prodTit	= $row->titulo;
										$prodPreco	= $row->preco;
									?>


										<option id="<?php echo $produtoId; ?>" value="<?php echo $produtoId; ?>"> <?php echo $prodTit; ?> (R$ <?php echo $prodPreco; ?>) <?php echo $produtoId; ?> </option>
									<?php } ?>
								</select>
								
							</td>
							<td width="20%"><input name="peso" class="form-control" type="text" onblur="Peso em g" value=""></input></td>
							<td><button type="submit" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> </button></td>
						</form>
					</tr>
				
			</table>
			</div>
		</div>
		<div id="expizzas" class="hidden col-md-12 col-xs-12">
			<br />
			<div class="btn-success col-md-12 col-xs-12">
				<h3>PIZZAS</h3>
			</div>
			<br />
			<div class="col-md-12 col-xs-12">					
				<form action="<?php echo base_url(); ?>index.php/administracao/alacPizInsert/<?php echo $clienteID; ?>" type="GET">
					<div class="col-md-5">
						<input hidden name="clienteId" type="text" height="120px" value="<?php echo $clienteID; ?>"></input>
						<br />
						<div class="select-style">
							<p>Escolha a Pizza</p>
							<select id="produtos" name="prodid" class="form-control">							
										<?php foreach ($pizzas as $row) { 
											$produtoId 	= $row->ID;
											$prodTit	= $row->titulo;
											$prodPreco	= $row->preco;
										?>
								<option id="<?php echo $produtoId; ?>" value="<?php echo $produtoId; ?>"> <?php echo $prodTit; ?> (R$ <?php echo $prodPreco; ?>) <?php echo $produtoId; ?> </option>
										<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-7">
						<div class="col-md-12">
							<br />
							<p>Observações</p>
							<textarea name="obsv" class="form-control" rows="3" placeholder="Ex.: Pizza sem Azeitonas." value=""></textarea>
						</div>

						<div class="col-md-6">
							<br />
							<p>Quantidade</p>
							<input name="qntd" class="form-control" type="text" onblur="Qntd" value="1"></input>
						</div>
						<div class="col-md-6">
							<br />
							<p>Adicionar a Comanda</p>
							<button type="submit" class="btn btn-sm  btn-primary"><i class="fa fa-plus"></i> ADICIONAR</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="exresultado" class="col-md-12 col-xs-12">
				<div class="clearfix"> </div>
					<br />
				<hr class="divisor" />
				<table class="table">						
					<tr>
						<td><h4>PRODUTOS </h4></td>
						<td><h4>QNTD </h4></td>
						<td><h4>SUBTOTAL</h4></td>
						<td><h4>OPÇÕES</h4></td>
					</tr>
					<?php foreach ($comanda as $row) { ?>
					<?php $idDoProd = $row->ID; ?>
					<tr>
						<td><?php echo $row->nome; ?></td>
						<td><?php
						$qntd 		= $row->qntd;
						 echo $qntd; ?></td>
						<td>R$ <?php
						$valorAdq 	= $row->valor;
						$pesoProd	= $row->peso;
						$pago 		= $row->pago;
						
						$this->load->helper("funcoes");
						 echo formata_preco($valorAdq); ?></td>
						 <!-- Deletar Item da Comanda -->
						<td>
						<form action="<?php echo base_url(); ?>index.php/administracao/delItemCom" method="get">
							<input id="clienteId" type="text" hidden name="clienteId" value="<?php echo $clienteId; ?> ">
							<input id="iddoproduto" type="text" hidden name="iddoproduto" value="<?php echo $idDoProd; ?> ">
							<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
						</form>
					</tr>
					<?php } ?>
					<tr>
						<td><h4>VALOR TOTAL:</h4></td>
						<td></td>
						<td>
							<h4>R$ <?php

								$valorTotal = (implode(" ", $somaValor[0]));

								if ($valorTotal == NULL) {
									
									print_r($valorTotal);

								}else{

									print_r(formata_preco($valorTotal));

								}

								

							 ?> </h4>
						</td>
					</tr>
				</table>
		</div>
	<?php }else{ ?>
		<div class="col-md-12">
			<center>
			<h2 class="success">CAIXA ABERTO</h2>
			<h3>FAÇA UM NOVO PEDIDO</h3>
			<div class="clearfix"> </div><br />
			<div class="center">
				<a href="<?php echo base_url(); ?>index.php/administracao/entrarALC"><button class="btn btn-lg btn-primary"><i class="fa fa-cutlery"></i> NOVO PEDIDO</button></a>	
				<a href="<?php echo base_url(); ?>index.php/administracao/entrarPIZZA"><button class="btn btn-lg btn-warning"><i class="fa fa-cutlery"></i> NOVA PIZZA</button></a>	
				<div class="clearfix"> </div>
				<hr class="divisor" /> 
			</div>
			</center>
			<div id="exresultado" class="col-md-12 col-xs-12">
				<div class="clearfix"> </div>
					<br />
				<hr class="divisor" />
				<table class="table">						
					<tr>
						<td><h4>PRODUTOS </h4></td>
						<td><h4>QNTD </h4></td>
						<td><h4>SUBTOTAL</h4></td>
					</tr>
					<?php foreach ($comanda as $row) { ?>
					<tr>
						<td><?php echo $row->nome; ?></td>
						<td><?php
						$qntd 		= $row->qntd;
						 echo $qntd; ?></td>
						<td>R$ <?php
						$valorAdq 	= $row->valor;
						$pesoProd	= $row->peso;
						$pago 		= $row->pago;
						
						$this->load->helper("funcoes");
						 echo formata_preco($valorAdq); ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td><h4>VALOR TOTAL:</h4></td>
						<td></td>
						<td>
							<h4>R$ <?php

								$valorTotal = (implode(" ", $somaValor[0]));

								if ($valorTotal == NULL) {
									
									print_r($valorTotal);

								}else{

									print_r(formata_preco($valorTotal));

								}

								

							 ?> </h4>
						</td>
					</tr>
				</table>
		</div>
		</div>
	<?php } ?>
</section>
<section class="col-md-4">
	<div class="col-md-12 fundoticket">
			<h3>TICKET <b><?php echo $codeEmpresa; ?><?php echo $clienteID; ?></b> </h3>
	</div>
		<div class="clearfix"> </div>
		<br />
		<hr class="divisor" />
	
	<script type="text/javascript">
		function redireciona(){
		$(document.location.reload(true), 7000);
		}
	</script>
	<div class="btn-primary">
		<center>
		 	<br />
			<h4>TOTAL DA CONTA</h4>
			<h3> R$ 
				<?php
					$this->load->helper("funcoes");
					$valorTotal = (implode(" ", $somaValor[0]));
					if ($valorTotal == NULL) {
						print_r($valorTotal);
					}else{
						print_r(formata_preco($valorTotal));
				}?>
			</h3>
			<br />
		</center>
	</div>
	<div class="clearfix"> </div>
	<hr class="divisor" />
	<div class="col-md-12">
		<script type="text/javascript">
			function getMoney( str )
				{
				    return parseInt( str.replace(/[\D]+/g,'') );
				}
			function formatReal( int )
				{
				        var tmp = int+'';
				        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
				        if( tmp.length > 6 )
				                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

				        return tmp;
				}

			function calcular()
				{
				    var n1 = parseInt(document.getElementById('n1').value, 10);
				    var n2 =  document.getElementById('n2').value;
				    var n3 = getMoney(n2);
				    var calculo = n3 - n1;
				    var resposta = 'TROCO R$ '; 
				   	var resultado = document.getElementById('resultado').innerHTML = resposta + formatReal(calculo);   
				}
			
		</script>

		<form action="" method="post">
	    <p><input hidden type="text" id="n1" value="<?php print_r($valorTotal)?>" /></p>
	    <p>Dinheiro Recebido: <input type="text" class="form-control"  id="n2" value="0,00" onblur="calcular()"/> </p>
		</form>
		<div class="col-md-12 fundotroco" id="resultado">CALCULAR TROCO</div>
	</div>
	<div class="clearfix"> </div>
	<hr class="divisor" /> 
	<div class="col-md-12 col-xs-12">
		<?php if($pago == 0 or $pago == NULL){ ?>			       
						<form action="<?php echo base_url(); ?>index.php/administracao/pagCom" method="get">
							<input id="clienteId" type="text" hidden name="clienteId" value="<?php echo $clienteId; ?> ">
							<input id="totalRec" type="text" hidden name="totalRec" value="<?php echo $valorTotal; ?> ">
							<select id="clienteVal" name="cliente" class="form-control">
								<option value="Visitante">Visitante</option>
										<?php foreach ($userLista as $row) { 

											$userId 	= $row->ID;
											$userNome	= $row->username;
										?>
								<option value="<?php echo $userNome; ?>"> <?php echo $userId; ?> - <?php echo $userNome; ?> </option>
									<?php } ?>
							</select>
							 <div class="checkbox">
								 <label><input type="checkbox" id="metodoVal" name="metodo" value="dinheiro"> DINHEIRO<br /> </label>
								 <label><input type="checkbox" id="metodoVal" name="metodo" value="visa"> CARTÃO<br /></label>
							</div>
							<button type="submit"  class="btn btn-sm btn-warning"><i class="fa fa-print" aria-hidden="true"></i> CONFIRMAR PAGAMAENTO </button>
						</form>

							<div class="clearfix"> </div>
							<hr class="divisor" /> 
					<?php
						} else {

							echo "<p>Pedido <b>PAGO</b></p>";
						}
					 ?>
	<script type="text/javascript">
		function exibPrint(){
			var newWindow = window.open("<?php echo base_url(); ?>index.php/administracao/verTicketTxt/?clienteId=<?php echo $clienteId; ?>", "_blank", "width=300,height=180")	
		}		
	</script>
	</div>
</section>
</body>