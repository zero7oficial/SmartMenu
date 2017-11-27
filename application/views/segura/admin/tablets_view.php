<!DOCTYPE HTML>
<html lang="pt-br">
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
<!-- INICIO HEAD -->
	<head> 		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title><?php echo $nomeEmpresa; ?></title>
		<meta name="keywords" content="SmartMenu, Pizzaria Expresso, Cardápio Online, Pizzas" />
		<meta name="description" content="SmartMenu, um cardápio tecnológico, facilitando sua comunicação conosco.>" />
		<meta property="og:locale" content="pt_BR">
		<meta property="og:title" content="SmartMenu" />
		<meta property="og:description" content="SmartMenu, um cardápio tecnológico, facilitando sua comunicação conosco. " />
		<meta property="og:url" content="<?php echo base_url(); ?>">
		<meta property="og:site_name" content="<?php echo base_url(); ?>" />
		<meta property="og:image" content="<?php echo base_url(); ?>uploads/layout/logo.png">
		<meta property="og:image:type" content="image/png">
		<meta property="og:image:width" content="350">
		<meta property="og:image:height" content="200">
		<meta name="author" content="AgênciaZero7 - contato@agencia07.com.br" />
		<meta name="robots" content="index, follow" />
		<link rel="canonical" href="<?php echo base_url(); ?>" />

		<!-- CSS STYLOS -->

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/style.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>includes/font-awesome/css/font-awesome.min.css">
		<link rel="shortcut icon" href="<?php echo base_url(); ?>includes/uploads/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url(); ?>includes/uploads/favicon.ico" type="image/x-icon">


		<!-- JS STYLOS -->
		
		<script src="<?php echo base_url(); ?>includes/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>includes/js/bootstrap.min.js"></script>
		<script type="text/javascript" href="<?php echo base_url(); ?>includes/js/bootstrap.js" ></script>
		<style type="text/css">
			body{font-family:Open Sans, sans-serif; font-weight:normal; }
			h1{font-family:Open Sans, sans-serif; font-weight:700; }
			h2{font-family:Open Sans, sans-serif; font-weight:600; }
			h3{font-family:Open Sans, sans-serif; font-weight:normal; }
			h4{font-family:Open Sans, sans-serif; font-weight:700; }
			h5{font-family:Open Sans, sans-serif; font-weight:600; }
			h6{font-family:Open Sans, sans-serif; font-weight:600; }
  		</style>
	</head> 
<!-- FIM HEAD -->
<!-- INÍCIO DO CORPO DO SITE-->
<body>
<section class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">LISTA DE PEDIDOS EM ORDEM DE PEDIDO <a href="<?php echo base_url(); ?>index.php/administracao/tablets/"><button class="btn btn-sm btn-warning"> ATUALIZAR</button></a></div>
		<div class="panel-body">
			<div class="col-md-6 col-xs-6">TICKET Nº</div>
			<div class="col-md-6 col-xs-6">OPÇÃO</div>
			<div class="clearfix"> </div>
			<hr class="divisor" />
			<div class="col-md-12">
				<?php foreach ($pedidos as $item) { ?>
					<?php 
						$pronto = $item->pronto;
							if ($pronto == 0 or $pronto == NULL) { ?>	
								<div class="col-md-6 col-xs-6 fundo-ticket">
									<h2><?php echo $codeEmpresa; ?><?php echo $item->cliente_id; ?></h2>
								</div>
								<div class="col-md-6 col-xs-6 fundo-pronto">
									<?php $clienteId = $item->cliente_id; ?>
										<form action="<?php echo base_url(); ?>index.php/administracao/prontoTab/" type="post">
											<input type="text" hidden name="clienteId" value="<?php echo $clienteId ?>" />
											<button id="pedPronto" type="submit" class="btn btn-lg btn-success" data-toggle="modal" data-target="#aprontando"><i class="fa fa-check-circle"></i> Pronto</button>
										</form>									
								</div>
							<div class="clearfix"> </div> <br />
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">

				function redireciona(){

					 $(document.location.reload(true), 7000);
				}

			</script>
</section>
</body>
<!-- INÍCIO DO CORPO DO SITE-->
</html>