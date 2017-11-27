<section class="col-md-8">
	<script type="text/javascript" charset="utf-8">		
			jQuery(document).ready(function(){

				jQuery("#bt-um").on('click', function(){

					jQuery("#insert1").removeClass('hidden');
					jQuery("#insert3").addClass('hidden');
					jQuery("#insert2").addClass('hidden');

					
				});

				jQuery("#bt-dois").on('click', function(){

					jQuery("#insert2").removeClass('hidden');
					jQuery("#insert3").addClass('hidden');
					jQuery("#insert1").addClass('hidden');

					
				});

				jQuery("#bt-tres").on('click', function(){

					jQuery("#insert3").removeClass('hidden');
					jQuery("#insert2").addClass('hidden');
					jQuery("#insert1").addClass('hidden');
					
				});
			});
  		</script>
	<div class="clearfix"> </div>
	<hr class="divisor" />
	<!-- INICIO DROP -->
		<div class="btn-group">
			<button id="bt-dois" type="button" class="btn btn-lg btn-primary">2 Sabores</button>
			<button id="bt-tres" type="button" class="btn btn-lg  btn-danger">3 Sabores</button>
			<button id="bt-um" type="button" class="btn btn-lg btn-pizza">Bebidas</button>
		</div>
		<div id="insert1" class="hidden col-md-12 col-xs-12">
			<div class="titulo">
				<h3>BEBIDAS</h3>
			</div>
			<table class="table">						
				<tr>
					<td><h5>NOME</h5></td>
					<td><h5>QNTD</h5></td>
					<td><h5>Add Pedido</h5></td>
				</tr>
				
					<tr>
						<form action="<?php echo base_url(); ?>index.php/administracao/alacBebInsert/<?php echo $clienteID; ?>" type="GET">
							<td width="50%">
								<input hidden name="clienteId" type="text" value="<?php echo $clienteID; ?>"></input>
								<select id="produtos" name="prodid" class="form-control">
									<option id="0" value="0">Escolha a Bebida</option>
									<?php foreach ($bebidas as $row) { 

										$produtoId 	= $row->ID;
										$prodTit	= $row->titulo;
										$prodPreco	= $row->preco;
									?>


										<option id="<?php echo $produtoId; ?>" value="<?php echo $produtoId; ?>"> <?php echo $prodTit; ?> (R$ <?php echo $prodPreco; ?>) <?php echo $produtoId; ?> </option>
									<?php } ?>
								</select>
							</td>
							<td width="20%"><input name="qntd" class="form-control" type="text" onblur="Qntd" value="1"></input></td>
							<td><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> </button></td>
						</form>
					</tr>
			</table>
		</div>
		<div id="insert2" class="col-md-12">	
			<div class="col-md-12 col-xs-12">
				<div class="col-md-12 titulo">
					<h3>PIZZAS COM 2 SABORES</h3>
				</div>
				<div class="col-md-12">
					<form action="<?php echo base_url(); ?>index.php/administracao/PizInsertTwo/<?php echo $clienteID; ?>" type="GET">
						<div class="col-md-12">
							<input hidden name="clienteId" type="text" value="<?php echo $clienteID; ?>"></input>
							
								<?php foreach ($pizzas as $row) { 
									$produtoId 	= $row->ID;
									$prodTit	= $row->titulo;
									$prodPreco	= $row->preco;
									$prodImg 	= $row->imagem;	
								?>
								<div class="col-md-4 quadrado" style="background-image:url(<?php echo base_url() . "uploads/"; ?><?php echo $prodImg . ".jpg"; ?>)">
									<div class="squaredOne">
										<input class="squaredOne" id="squaredOne" type="checkbox" name="prodid[]" value="<?php echo $produtoId; ?>" /> 
										<label for="squaredOne"></label>
									</div>
									<p style="color: #FFF;" class="text-center"><b><?php echo $prodTit; ?></b></p>
								</div>
								<?php } ?>
						</div>
						<div class="clearfix"> </div>
						<hr class="divisor" /> 
						<div class="col-md-12">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-plus"></i> ADD AO PEDIDO</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="insert3" class="col-md-12 hidden">
			<div class="col-md-12 col-xs-12">
				<div class="col-md-12 titulo">
					<h3>PIZZAS COM 3 SABORES</h3>
				</div>
				<div class="col-md-12">
					<form action="<?php echo base_url(); ?>index.php/administracao/PizInsertTree/<?php echo $clienteID; ?>" type="GET">
						<div class="col-md-12">
							<input hidden name="clienteId" type="text" value="<?php echo $clienteID; ?>"></input>
							
								<?php foreach ($pizzas as $row) { 
									$produtoId 	= $row->ID;
									$prodTit	= $row->titulo;
									$prodPreco	= $row->preco;
									$prodImg 	= $row->imagem;	
								?>
								<div class="col-md-4 quadrado" style="background-image:url(<?php echo base_url() . "uploads/"; ?><?php echo $prodImg . ".jpg"; ?>)">
									<div class="squaredOne">
										<input class="squaredOne" id="squaredOne" type="checkbox" name="prodid[]" value="<?php echo $produtoId; ?>" /> 
										<label for="squaredOne"></label>
									</div>
									<p style="color: #FFF;" class="text-center"><b><?php echo $prodTit; ?></b></p>
								</div>
								<?php } ?>
						</div>
						<div class="clearfix"> </div>
						<hr class="divisor" /> 
						<div class="col-md-12">
							<button type="submit" class="btn btn-lg btn-danger"><i class="fa fa-plus"></i> ADD AO PEDIDO</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<!-- FIM DO DROP -->

	<div class="clearfix"> </div>
	<hr class="divisor" /> 
	
</section>
<section class="col-md-4">
	<div class="center">
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarALC"><button class="btn btn-small btn-primary"><i class="fa fa-cutlery"></i> NOVO PEDIDO</button></a>	
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarPIZZA"><button class="btn btn-small btn-warning"><i class="fa fa-cutlery"></i> NOVA PIZZA</button></a>	
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
	</div>
	
	<div class="clearfix"> </div>
	<hr class="divisor" /> 
	<div class="titulo">
		<h3>TICKET <b>SM<?php echo $clienteID; ?></b> </h3>
	</div>
	<table class="table">						
		<tr>
			<td><h4>PRODUTOS </h4></td>
			<td><h4>TOTAL PEDIDO</h4></td>
		</tr>
		<?php foreach ($comanda as $row) { ?>
		<tr>
			<td><?php echo $row->nome; ?></td>
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
	<script type="text/javascript">
		function redireciona(){
		$(document.location.reload(true), 7000);
		}
	</script>
	<div class="clearfix"> </div>
	<hr class="divisor" />
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
	    <p>Dinheiro Recebido: <input type="text" class="form-control"  id="n2" value="5" onblur="calcular()"/> </p>
		</form>
		<div class="col-md-12 fundotroco" id="resultado">CALCULAR TROCO</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<?php if($pago == 0 or $pago == NULL){ ?>			       
			<form action="<?php echo base_url(); ?>index.php/administracao/pagCom" method="get">
				<input type="text" hidden name="clienteId" value="<?php echo $clienteId ?> ">
					<div class="checkbox">
						<label><input type="checkbox" name="metodo" value="dinheiro"> DINHEIRO<br /> </label>
						<label><input type="checkbox" name="metodo" value="visa"> VISA<br /></label>
						<label><input type="checkbox" name="metodo" value="mastercard"> MASTERCARD<br /></label>
						<label><input type="checkbox" name="metodo" value="banricompras"> BANRICOMPRAS<br /></label>
					</div>
					<button type="submit"  class="btn btn-sm btn-warning"><i class="fa fa-print" aria-hidden="true"></i> CONFIRMAR PAGAMAENTO </button>
			</form>
		<?php }else { ?>
			<h4>PEDIDO PAGO</h4>
			<?php } ?>

		<div class="clearfix"> </div>
		<hr class="divisor" /> 
	</div>
</section>
</body>