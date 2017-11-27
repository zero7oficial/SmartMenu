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
<!-- Início da HEAD -->
	<head> 
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>MENFIS - Cardápio Virtual</title>
		<meta name="keywords" content="Menfis, Cardápio Virtual para Eventos" />
		<meta name="description" content="MENFIS, um cardápio virtual para praças de alimentação de eventos e shoppings." />
		<meta property="og:locale" content="pt_BR">
		<meta property="og:title" content="SmartMenu" />
		<meta property="og:description" content="MENFIS, um cardápio virtual para praças de alimentação de eventos e shoppings." />
		<meta property="og:url" content="<?php echo base_url(); ?>">
		<meta property="og:site_name" content="MENFIS - Cardápio Virtual Fiscal" />
		<meta property="og:image" content="<?php echo base_url(); ?>uploads/layout/logo.png">
		<meta property="og:image:type" content="image/png">
		<meta property="og:image:width" content="350">
		<meta property="og:image:height" content="200">
		<meta name="author" content="AgênciaZero7 - contato@agencia07.com.br" />
		<meta name="robots" content="index, follow" />
		<link rel="canonical" href="<?php echo base_url(); ?>" />

		<!--  INICIO CSS STYLOS -->

			<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/bootstrap.css" />
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/style.css" />
			<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/bootstrap-theme.min.css">
			<link rel="stylesheet" href="<?php echo base_url(); ?>includes/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:regular,700,600&amp;latin" type="text/css" />
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

  		<script type="text/javascript" charset="utf-8">		
			jQuery(document).ready(function(){

				jQuery("#bt-pizza").on('click', function(){

					jQuery("#pizzas").removeClass('hidden');
					jQuery("#vinhos").addClass('hidden');
					jQuery("#comanda").addClass('hidden');
					
				});

				jQuery("#bt-comanda").on('click', function(){

					jQuery("#comanda").removeClass('hidden');
					jQuery("#pizzas").addClass('hidden');
					jQuery("#vinhos").addClass('hidden');
					
				});

				jQuery("#bt-vinho").on('click', function(){

					jQuery("#vinhos").removeClass('hidden');
					jQuery("#pizzas").addClass('hidden');
					jQuery("#comanda").addClass('hidden');
					
				});
			});
  		</script>
	</head>
<!-- Fim da HEAD -->
<!-- INÍCIO DO BODY DO SITE-->
<body style="background-color: #F3F0EC;>
	<div class="container-fluid fundo fill" role="main">