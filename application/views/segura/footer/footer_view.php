
		</div>
		<!-- FIM DA DIV FUNDO -->
		<br />
	<div id="footer" class="footer copy_pc">
	  	<div class="col-md-4 abaixo">
			<ul>
				<li><a href="<?php echo base_url(); ?>index.php/visualiza/"> Função SmartTV's - VISUALIZA</a></li>
				<li><a href="<?php echo base_url(); ?>index.php?ID=4">Função Cardário Virtual</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/administracao/tablets">Função Pedidos Prontos (Tablets)</a></li>
			</ul>
		</div>
		<div class="col-md-8">
			<?php if ($usuarios == 1) { ?>

				<a href="<?php echo base_url(); ?>index.php/administracao/caixa"><button class="btn btn-sm btn-warning">
				CAIXA</button></a>  
				<a href="<?php echo base_url(); ?>index.php/administracao/cardapio"><button class="btn btn-sm btn-warning">
				LANCHES</button></a> 
				<a href="<?php echo base_url(); ?>index.php/administracao/bebidas"><button class="btn btn-sm btn-warning">
				BEBIDAS</button></a>
				<a href="<?php echo base_url(); ?>index.php/administracao/acompanhamentos"><button class="btn btn-sm btn-warning">
				ACOMPANHAMENTOS</button></a> 
				<a href="<?php echo base_url(); ?>index.php/administracao/pizzas"><button class="btn btn-sm btn-warning">
				PIZZAS</button></a> 
				<a href="<?php echo base_url(); ?>index.php/administracao/buffet"><button class="btn btn-sm btn-warning">
				BUFFET'S</button></a>
				<a href="<?php echo base_url(); ?>index.php/administracao/relatorio"><button class="btn btn-sm btn-warning">
				RELATÓRIO</button></a>
				<div class="clearfix"> </div>
				<br />
			<?php }else {
						echo '<div class="clearfix"> </div><br />';
				}?>
	  		<p>Painel de Administração desenvolvido por <b><a href="https://www.agencia07.com.br/">Agência Zero7</a></b> | <b>SmartMenu - Versão: 1.0.0</b></p>
	  	</div>
	</div>
	</body>  
</html>