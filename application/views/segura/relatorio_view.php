<?php 

	/**
	*  	MENFIS - MENU FISCAL - ZERO7
	* 
	*	Sistema para gestão de praças de alimentação em eventos. 
	*	Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
	*  	Sistema de Pedido Pronto para exibição em TV, SMART TVS E PAINEIS DE LED
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

	<?php 

        $newContar = $contpedi;

    ?>
<section class="col-md-8">
		<div class="panel panel-primary">
  			<div class="panel-heading"><b>RELATÓRIO DETALHADO - DATA  <?php echo date('d/m/Y'); ?></b></div>
  			<div class="panel-body">
   				<div id="relatoriosimples" class="col-md-12">
   					<h4>RELATÓRIO DE VENDAS</h4>
   				 	<div class="col-md-12">
							<div class="col-md-3"> TOTAL EM VENDAS </br><b>R$ <?php
											$this->load->helper("funcoes"); 
											$valorTotal = (implode(" ", $contvendas[0]));

											if ($valorTotal == NULL) {
												
												print_r($valorTotal);

											}else{

												print_r(formata_preco($valorTotal));

											}

											

										 ?></b>
							</div>
							<div class="col-md-3">TICKET MÉDIO </br><b>R$ <?php
												$this->load->helper("funcoes"); 
												print_r(formata_preco($ticketMedioE));
												?></b>
							</div>
							<div class="col-md-3">DINHEIRO:</br><b>R$ <?php
												$this->load->helper("funcoes"); 
												$dinhTotal = (implode(" ", $contvdin[0]));

												if ($dinhTotal == NULL) {
													
													print_r($dinhTotal);

												}else{

													print_r(formata_preco($dinhTotal));

												}

												

											 ?></b>
							</div>
							<div class="col-md-3"> VENDAS CARTÕES:</br><b>R$ <?php
												$this->load->helper("funcoes"); 
												$cartTotal = (implode(" ", $contvendas[0])) - (implode(" ", $contvdin[0])) ;

												if ($cartTotal == NULL) {
													
													print_r($cartTotal);

												}else{

													print_r(formata_preco($cartTotal));

												}

												

											 ?></b></div>
							</div>
							<div class="clearfix"> </div>
							<hr class="divisor" />
				</div>
   			</div> <!-- Fim do Corpo Painel -->
   			<div class="clearfix"> </div>
			<hr class="divisor" /> 
  			<div class="panel-footer">
  					<div class="clearfix"> </div>
  			</div>
		</div>
		<div class="panel panel-warning">
			<div class="panel-heading"><b>RELATÓRIO DE PRODUTOS VENDIDOS</b></div>
			<div class="panel-body">
				<div id="relatóriocompleto" class="col-md-12">
   				 		<div class="col-md-12"><h4>RELATÓRIO GERAL</h4></div>
	   				 		<div class="clearfix"> </div>
							<hr class="divisor" /> 
   				 		<div class="col-md-12">
   				 		<!-- Listando Métodos de Pagamento -->
   				 			<div class="col-md-12">
   				 				<div class="col-md-6"><b>MÉTODO DE PAGAMENTO</b></div>
   				 				<div class="col-md-6"><b>RECEBIDO</b></div>
   				 				<div class="col-md-6">DINHEIRO</div>
   				 				<div class="col-md-6">R$ <?php $this->load->helper("funcoes"); 
											$dinheiro = (implode(" ", $contMetDinh[0]));

											if ($dinhTotal == NULL) {
												
												print_r($dinheiro);

											}else{

												print_r(formata_preco($dinheiro));

											}?>
								</div>
   				 				<div class="col-md-6">MASTERCARD</div>
   				 				<div class="col-md-6">R$ <?php $this->load->helper("funcoes"); 
											$creditcard = (implode(" ", $contMetCred[0]));

											if ($dinhTotal == NULL) {
												
												print_r($creditcard);

											}else{

												print_r(formata_preco($creditcard));

											}?>
								</div>
   				 				<div class="col-md-6">VISA</div>
   				 				<div class="col-md-6">R$ <?php $this->load->helper("funcoes"); 
											$Visa = (implode(" ", $contMetVisa[0]));

											if ($Visa == NULL) {
												
												print_r($Visa);

											}else{

												print_r(formata_preco($Visa));

											}?>
								</div>
   				 				<div class="col-md-6">BANRICOMPRAS</div>
   				 				<div class="col-md-6">R$ <?php $this->load->helper("funcoes"); 
											$Banricompras = (implode(" ", $contMetBanr[0]));

											if ($Banricompras == NULL) {
												
												print_r($Banricompras);

											}else{

												print_r(formata_preco($Banricompras));

											}?></div>
   				 			</div>
   				 		<!-- FIM Listando Métodos de Pagamento 	-->   				 		
   				 			<div class="clearfix"> </div>
							<hr class="divisor" /> 
						<!-- Listando Produtos Vendidos Qntds e Recebido 	-->
							<div class="col-md-12">
   				 				<table class="table">
   				 					<tr>
   				 						<td width="60%"><b>Produto</b></td>
   				 						<td width="20%"><b>Qntd</b></td>
   				 					</tr>
   				 					
   				 				<?php foreach ($vendasProdT as $lin) { ?>
   				 					<tr>
   				 						<td><?php echo $lin->nome; ?></td>
   				 						<td><?php echo $lin->Qtd; ?></td>
   				 					</tr>
   				 				<?php } ?>   				 					
   				 				</table>
   				 			</div>
   				 		<!-- FIM Listando Produtos Vendidos Qntds e Recebido 	-->
   				 			<div class="clearfix"> </div>
							<hr class="divisor" /> 
   				 		<!-- Listando Usuários e Recebimentos 	-->
   				 			<div class="col-md-12">
   				 				<table class="table">
   				 					<tr>
   				 						<td width="30%"><b>RECEBIDO POR</b></td>
   				 						<td width="50%"><b>CAIXA FECHADO AS</b></td>
   				 						<td width="20%"><b>TOTAL RECEBIDO</b></td>
   				 					</tr>
   				 					<?php foreach ($vendasUsuario as $key) {?>
   				 						<tr>
   				 							<td><?php echo $key->usuario; ?></td>
   				 							<td><?php 
   				 							$fechamento = $key->fechahora;
   				 							if ($fechamento == NULL) { ?>
   				 								<p> CAIXA ABERTO </p>
   				 							<?php } else {

   				 							 echo $fechamento;
   				 							}

   				 							?></td>
	   				 						<td>R$ <?php $vTotal = $key->total;
	   				 						$this->load->helper("funcoes");
	   				 						print_r(formata_preco($vTotal));?></td>
   				 						
   				 						</tr>
   				 					<?php } ?>
   				 				</table>
   				 			</div>
   				 		<!-- FIM Listando Usuários e Recebimentos 	-->
   				 		</div>
   				</div>
			</div>
			<div class="panel-footer">
  				<div class="col-md-7" >RELATÓRIO - DATA  <?php echo date('d/m/Y'); ?></div>
  				
  					<div class="col-md-4">
  						<a href="<?php echo base_url(); ?>index.php/administracao/imprimiCabRelatorio" target="_blank"><button id="" class="btn btn-sm btn-warning"><i class="fa fa-cutlery"></i> IMPRESSÃO</button></a>
  					</div>
  					<div class="clearfix"> </div>
  			</div>
		</div>
</section>
<section class="col-md-4">
	<div class="panel panel-danger">
  		<div class="panel-heading">TOTAL EM VENDAS</div>
	  	<div class="panel-body">
	  				<p>VENDAS TOTAIS TODO O PERIODO</p>
	  				<h2><?php
	  				$this->load->helper("funcoes"); 
	  				print_r("R$ " . formata_preco($contVenTot)); ?></h2> <br />
  		<div class="panel-footer">Valor por período</div>
  	</div>
	<div class="panel panel-default">
  		<div class="panel-heading">LICENSA: ATIVA</div>
	  	<div class="panel-body">
	  				<p>Licensa ativa para <b><?php echo $nomeEmpresa; ?></b> <br /> <?php echo $cnpjEmpresa; ?></p>
	  				<p>SERIAL Nº: <code><?php echo $serialEmpresa ?></code></p>
	  	</div>
  		<div class="panel-footer">Licensiado por Agência Zero7</div>
  	</div>

			<script type="text/javascript">
				function redireciona(){
				$(document.location.reload(true), 7000);
				}
			</script>
</section>