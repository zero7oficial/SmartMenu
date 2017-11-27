<body>
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
				</button>
			<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/administracao">Painel Controle</a>
			</div>
			<div id="barra" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
			  		<li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/cardapio"><i class="fa fa-cutlery"></i> Cardápio</a></li>  		
			  		<li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/bebidas"><i class="fa fa-beer"></i> Bebidas</a></li>
			  		<li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/mesas"><i class="fa fa-qrcode"></i> Mesas</a></li>
			  		<li role="separator" class="divider"></li>
			  		<li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/pedidos"><i class="fa fa-bolt"></i> Pedidos <span id="notificacao" class="badge"><?php echo $contpedi; ?></span></a></li>
			  		<li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/perfil"><i class="fa fa-user"></i> Clientes</a></li>
			  		<li role="separator" class="divider"></li>
			  		<li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/sobre"><i class="fa fa-graduation-cap"></i> Sobre</a></li>
			  		<li role="presentation"><a href="<?php echo base_url(); ?>/index.php/administracao/logout"><i class="fa fa-times"></i> Sair</a></li>
				</ul>
			</div>
		</div>
	</nav>
<section id="corpo">
	<h3><?php echo $error;?></h3>

	<h4><a href="<?php echo $link; ?>">Tentar novamente?</a></h4>

	<p>Estamos aqui para ajudar. Se tudo estiver correto, e mesmo assim o envio não é possivel, por favor contate-nos <b>contato@agencia07.com.br</b></p>
</section>