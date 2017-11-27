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
* @copyright 	Copyright (c) 2015, Agência Zero7 LTDA
* @link 		http://pizzaria.agencia07.com.br/
*
*
*/

?>

	<?php 

        $newContar = $contpedi;

    ?>
<section class="col-md-8">
		<div class="panel panel-warning">
  			<div class="panel-heading">EDITANDO USUÁRIO <?php echo $usuario[0]->nome; ?></div>
  			<div class="panel-body">
   				 <div class="col-md-12">
   				 <form action="<?php echo base_url(); ?>index.php/administracao/atualizarUser" target="get">
   				 	<input type="hidden" class="form-control" name="ID" type="text" value="<?php echo $usuario[0]->ID ?>"></input>
   				 	<div class="col-md-4">NOME: <input class="form-control" name="nome" type="text" value="<?php echo $usuario[0]->nome ?>"></input></div>
   				 	<div class="col-md-6">E-MAIL: <input class="form-control" name="email" type="text" value="<?php echo $usuario[0]->email ?>"></input></div>
   				 	<div class="col-md-2"> FUNÇÃO*:
   				 		<select id="funcao" name="funcao" class="form-control">
			  					<option id='0' value="0">Função</option>
			  					<option id='1' value="1">Administrador</option>
			  					<option id='2' value="2">Atendente</option>
			  					<option id='3' value="3">Func. Empr.</option>
			  			</select>
			  		</div>
			  		<div class="clearfix"> </div>
			  				<br />
   				 	<div class="col-md-6">NOVA SENHA (obrigatório): <input class="form-control" name="senha" type="password" value=""></input></div>
   				 	<div class="col-md-6"><br /><button type="submit" class="btn btn-sm btn-pizza">Atualizar</button></div>
   				 </form>
   				 </div>
   				<div class="clearfix"> </div>
				<hr class="divisor" /> 
  			</div>
		</div>
</section>
<section class="col-md-4">
	<div class="center">
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarALC"><button class="btn btn-lg btn-pizza"><i class="fa fa-cutlery"></i> NOVO PEDIDO</button></a>	
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarPIZZA"><button class="btn btn-lg btn-pizza"><i class="fa fa-cutlery"></i> NOVA PIZZA</button></a>	
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
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
		<div class="col-md-6"><a href="<?php echo base_url(); ?>index.php/administracao/relatorio"><button id="" class="btn btn-sm btn-pizza"><i class="fa fa-cutlery"></i> RELATÓRIO DETALHADO</button></a></div>
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
	</div>
	<div class="col-md-12">
		<div class="panel panel-primary">
	  			<div class="panel-heading">LICENSA: ATIVA</div>
	  			<div class="panel-body">
	  				<p>Licensa ativa para <b>SmartMenu</b><br /> CNPJ: 17.254.945/0001-32</p>
	  				<p>CÓDIGO DA LICENSA Nº: <code>0000-AAAA-0000-AAAA</code></p>
	  			</div>
		</div>
	</div>
	<script type="text/javascript">
		function redireciona(){
		$(document.location.reload(true), 7000);
		}
	</script>
</section>

