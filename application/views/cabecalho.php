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
<!-- INICIO SECTION CABEÇALHO -->
	<section id="cabecalho">
		<!--INICIO ROW -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="col-md-3 col-xs-12"><img src="<?php echo base_url(); ?>uploads/layout/logo.png" class="img-responsive center-block"/></div>

					<div id="perfil" class="col-md-9 col-xs-12"><!-- Inicio do Perfil -->
						<div class="col-lg-12">
									<h3 class="txt-direita"><b>FENADOCE DIGITAL</b></h3>
									<h4>SEU TICKET: <b><?php echo $codeEmpresa; ?><?php echo $pedID; ?></b></h4>
									<p><?php echo $mensEmpresa; ?>.</p>
						</div>
					</div>
					<div id="botoes" class="col-md-9 col-xs-12">
						<div class="margin-cima"> </div>
						<div class="clearfix"> </div>	
					</div><!-- FIM DO PERFIL -->
				</div>
			</div>
		<!-- FIM ROW -->
			<br />
			<div class="row bg-titulo shadow">
				<div class="col-md-12 col-xs-12">
					<div class="text-center col-md-8 col-xs-12">
						<h2 class="text-uppercase">Cardápio Virtual</h2>
					</div>
					<a href="#comanda" id="bt-comanda">
						<div class="btn btn-md btn-pizza col-md-4 col-xs-12">
							<h3 class="text-center">COMANDA</h3>
						</div>
					</a>
				</div>
			</div>
			<br />
	</section>
<!-- INICIO SECTION CABEÇALHO -->



