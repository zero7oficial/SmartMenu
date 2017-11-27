<!DOCTYPE html>
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
<html>
<head><title> </title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/style.css" />

	<script src="<?php echo base_url(); ?>includes/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>includes/js/bootstrap.min.js"></script>
</head>

<body style="font-family: Currier New">
<?php

	
?>
<?php if(file_exists("uploads/txt/cliente_".$clienteId.".txt") == TRUE){ ?>
	<div>
		<?php

		
		?>
	</div>

<?php }else{ ?>

	<script type="text/javascript">
		setTimeout(function(){location = '?clienteId=<?php echo $clienteId ?>'}, 5000);
	</script>
	<center id="carregando">Carregando... Aguarde...</center>

<?php } ?>

<p></p>

</body>
</html>