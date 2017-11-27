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

		<!-- CSS STYLOS -->

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

  <script type="text/javascript">
    (function($)
        {
            $(document).ready(function()
            {
                $.ajaxSetup(
                {
                    cache: false,
                    beforeSend: function() {
                        $('#notificacao').hide();
                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                        $('#notificacao').show();
                    },
                    success: function() {
                        $('#loading').hide();
                        $('#notificacao').show();
                    }
                });
                var $container = $("#notificacao");
                var carurl = '<?php echo base_url() ?>index.php/visualiza/pool';
                    $container.load(carurl);
                var refreshId = setInterval(function()
                {
                    $container.load(carurl);
                }, 10000);
            });
        })(jQuery);
    </script>
     <script type="text/javascript">
    (function($)
        {
            $(document).ready(function()
            {
                $.ajaxSetup(
                {
                    cache: false,
                    beforeSend: function() {
                        $('#atualizacao').show();
                        $('#carregando').show();
                    },
                    complete: function() {
                        $('#carregando').hide();
                        $('#atualizacao').show();
                    },
                    success: function() {
                        $('#carregando').hide();
                        $('#atualizacao').show();
                    }
                });
                var $conteudo = $("#atualizacao");
                var carregurl = '<?php echo base_url() ?>index.php/visualiza/poolI';
                    $conteudo.load(carregurl);
                var recarregaId = setInterval(function()
                {
                    $conteudo.load(carregurl);
                }, 10000);
            });
        })(jQuery);
    </script>
	</head> 
<!-- FIM HEAD -->
<!-- INÍCIO DO CORPO DO SITE-->
	<body>
	<!-- INICIO SECTION VISUALIZA-->
		<section id="visualiza" class="container-fluid fill fundo" role="main">
				<div class="col-md-12 bg-verde">
					<div class="col-md-3"><img src="<?php echo base_url(); ?>uploads/layout/logo.png" width="100%" class="img-responsive"></div>
					<div class="col-md-5"><h1 style="text-align: center; color:#FFF;">PEDIDO PRONTO </h1></div>
					<div class="col-md-4"></div>
				</div>
			<div class="row">
			 		<div class="col-md-12">
							<div class="col-md-12 bg-verde">
								
							</div>
							<script type="text/javascript">
								setInterval(function(){
								    $("#ticket").animate({opacity:'toggle'})
								},60);
							</script>
							<div id="ticket" class="tomato col-md-12 ">
							
								<h2 style="color: #fff; font-size: 130px; text-align: center;"><b><span id="notificacao"> <?php echo $contpedi; ?></span></b></h2>
							
							</div>
							<div class="clearfix"> </div>
							<hr class="divisor" />
							<div clas="col-md-12">
								<div class="col-md-12"><p style="font-size: 20px;">OUTROS PEDIDOS PRONTOS</p></div>
								<div class="col-md-12" style="font-size: 20px; color: #000">
								
									<b id="atualizacao"><?php echo $exibpedido; ?><b>

								</div>
							</div>
							<div class="clearfix"> </div>
							<hr class="divisor" />
							<div class="col-md-12">
								<div class="col-md-8"><p style="font-size: 20px;">PATROCÍNIO</p> </div>
								<div class="col-md-4">	
									<div class="col-md-12">
										<div class="col-md-6"><h5>TECNOLOGIA</h5>
											<img src="<?php echo base_url(); ?>uploads/layout/logo_menfis.png" width="100%" class="img-reponsive">
										</div>
										<div class="col-md-6"><h5>MANTIDO</h5>
											<img src="<?php echo base_url(); ?>uploads/layout/logo_agencia.png" width="100%" class="img-reponsive">
										</div>
										
									</div>			
								</div>
								
								<div class="col-md-8">
									<div class="col-md-12">
										<img src="https://www.fenadoce.com.br/arquivos/fenadoce_facebook_logotipo.jpg" width="580px">
									</div>
								</div>
								<div class="col-md-4">	
									<div class="col-md-12">

										<p><br /></p>
									</div>		
								</div>
							</div>		
										
								
					</div><!-- fim da div exibi ticket -->
			</div><!-- fim da div row -->
			<br />	
			<br />		
		</section>
	<!-- FIM SECTION VISUALIZA-->
	</body>
<!-- INÍCIO DO CORPO DO SITE-->
</html>