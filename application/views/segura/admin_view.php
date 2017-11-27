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
		<div class="panel panel-warning">
  			<div class="panel-heading">INFORMAÇÕES GERAIS USUÁRIO: <?php echo $username ?></div>
  			<div class="panel-body">
   				 <div class="col-md-12">
   				 	<div class="col-md-6">
   				 		<a href="<?php echo base_url(); ?>index.php/administracao/pedidos"><button class="btnpedidos"><i class="fa fa-cutlery"></i> VER PEDIDOS </button></a>	
   				 	</div>
   				 	<div class="col-md-6">
   				 		<p>Nesse botão você poderá acompanhar todos os pedidos validados, tanto via app do Smartphones, quanto pelo Painel de Controle.</p>
   				 	</div>
   				 </div>
   				<div class="clearfix"> </div>
				<hr class="divisor" /> 
   				 <div class="col-md-12">
   				 		<h4>O que é o Menfis?</h4>
   				 		<p>O <b>Menfis</b> é um aplicação de gestão do setor gastronômico,desenvolvido para atender a demanda virtual em Eventos e praças de alimentação. </p>
   				 		<p>Dentro dela, o seu cliente poderá fazer pedidos, e gerar sua comanda de forma virtual, garantindo o sigilo e a segurança nas transações, feitas pelo aplicação.</p>
   				 		<h4>Sobre a versão e futuras atualizações</h4>
   				 		<p>O <b>Menfis</b> está na versão 1.00.8 (20/abril/2017)</p>
   				 		<p>Próxima versão 2.00.0 - Adicionaremos - Integração Fiscal (Agosto/2017)</p>
   				 		<p>Próxima versão 2.10.0 - Adicionaremos - Pagamento via Cartão (Agosto/2017)</p>
   				 		<p>Próxima versão 2.20.0 - Adicionaremos - Delivery App (Setembro/2017)</p>   				 	
   				 </div>
  			</div>
		</div>
</section>
<section class="col-md-4">
	<div class="center">
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarALC">
			<button class="btn btn-small btn-primary"><i class="fa fa-cutlery"></i> NOVO PEDIDO</button>
		</a>	
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarPIZZA">
			<button class="btn btn-small btn-warning"><i class="fa fa-cutlery"></i> NOVA PIZZA</button>
		</a>
	</div>
	<div class="col-md-12"><h4>RELATÓRIO DATA: <?php echo date('d/m/Y'); ?></h4>
		<div class="col-md-5">VENDAS:</div>
		<div class="col-md-7">R$ <?php
						$this->load->helper("funcoes"); 
						$valorTotal = (implode(" ", $contvendas[0]));

						if ($valorTotal == NULL) {
							
							print_r($valorTotal);

						}else{

							print_r(formata_preco($valorTotal));

						}

						

					 ?></div>
		<div class="col-md-5">DINHEIRO:</div>
		<div class="col-md-7">R$ <?php
						$this->load->helper("funcoes"); 
						$dinhTotal = (implode(" ", $contvdin[0]));

						if ($dinhTotal == NULL) {
							
							print_r($dinhTotal);

						}else{

							print_r(formata_preco($dinhTotal));

						}

						

					 ?> </div>
		<div class="col-md-5">CARTÕES:</div>
		<div class="col-md-7">R$ <?php
						$this->load->helper("funcoes"); 
						$cartTotal = (implode(" ", $contvendas[0])) - (implode(" ", $contvdin[0])) ;

						if ($cartTotal == NULL) {
							
							print_r($cartTotal);

						}else{

							print_r(formata_preco($cartTotal));

						}

						

					 ?></div>
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
		<div class="col-md-6"></div>
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
	</div>
	<div class="col-md-12">
		<div class="panel panel-primary">
	  			<div class="panel-heading">LICENSA: ATIVA</div>
	  			<div class="panel-body">
	  				<p>Licensa ativa para <b><?php echo $nomeEmpresa; ?></b> <br /> <?php echo $cnpjEmpresa; ?></p>
	  				<p>SERIAL Nº: <code><?php echo $serialEmpresa ?></code></p>
	  			</div>
		</div>
	</div>
	<script type="text/javascript">
		function redireciona(){
		$(document.location.reload(true), 7000);
		}
	</script>
</section>

