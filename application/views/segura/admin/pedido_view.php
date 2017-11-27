<?php 

	/**
	*  	PIZZARIA EXPRESSO AGENCIA07
	* 
	*	Sistema para Apresentação do Cardápio de Pizzarias Expresso e Padrão 
	*	Desenvolvido para facilitar a apresentação do cardápio online. Em todas as plataformas.
	*
	* @package		Pizzaria Expresso 
	* @version  	1.0
	* @author   	Agência07
	* @copyright 	Copyright (c) 2014, Agência Zero7 LTDA
	* @link 		http://pizzaria.agencia07.com.br/
	*
	*
	*/

 ?>

<section class="col-md-8">
	<div class="panel panel-primary">
		<?php
			$clienteId = $pedcliente[0]->clienteID;
		?>
		<div class="panel-heading"><b>PEDIDO SM<?php echo $clienteId; ?></b></div>
		<div class="panel-body">   						
				<table class="table">						
						<tr>
							<td hidden>#</td>
							<td hidden>Nº MESA</td>
							<td width="20%">PRODUTO</td>
							<td hidden>ID PROD.</td>
							<td width="5%">QNTD</td>
							<td width="20%">OBS.</td>
							<td width="20%">VALOR UNIT</td>
							<td width="20%">VALOR TOTAL</td>
						</tr>
						<?php foreach ($pedcliente as $row) { $clienteId = $row->clienteID; ?>
						<tr>
							<td hidden><?php echo $row->ID ?></td>
							<td hidden><?php echo $row->mesaID ?></td>
							<td><?php echo $row->nome ?></td>
							<td hidden><?php echo $row->cardID  ?> <?php echo $row->bebID  ?></td>
							<td><?php echo $row->qntd  ?></td>
							<td><?php echo $row->observac  ?></td>
							<td><?php
								$this->load->helper("funcoes"); 
								$quantidade = $row->qntd;
								$valor = $row->valor;
								echo "R$ " . formata_preco(($valor / $quantidade));
							 ?></td>
							<td>R$ 
							<?php
							$this->load->helper("funcoes"); 
							$pago =	$row->pago;

							echo formata_preco($valor);

							?></td>
						</tr>
						<?php } ?>
				</table>
				<div class="col-md-4 col-xs-12">
					<h4>VALOR TOTAL: R$ <?php

						$valorTotal = (implode(" ", $somaValor[0]));

						if ($valorTotal == NULL) {
							
							print_r($valorTotal);

						}else{

							print_r(formata_preco($valorTotal));

						}

						

					 ?> </h4>
				</div>
				<div class="col-md-2 col-xs-12">
					<form action="<?php echo base_url(); ?>index.php/administracao/feConta" method="post">
						<input type="text" hidden name="valorTotal" value="<?php print_r($valorTotal); ?> ">
							
						<input type="text" hidden name="clienteId" value="<?php echo $clienteId ?> ">
					</form>
				</div>
				<div class="col-md-4 col-xs-12">
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
				</div>
				
					<?php
						} else { ?>
							<div class="col-md-6 col-xs-12">
							<?php 
							echo "<h4><b>PAGO</b></h4>";
							?>
							</div>
					<?php 
						}
					 ?>
				
		</div>
			<!-- fim panel body -->
		<div class="panel-footer">
			<div class="col-md-12 col-xs-12">
				
			</div>		
		</div>
	</div>
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