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
  			<div class="panel-heading">GESTÃO CAIXA POR <?php echo $username ?></div>
  			<div class="panel-body">
   				 <div class="col-md-12">
   				 	<div class="col-md-4">
   				 		<div class="fundonome col-md-12">CAIXA ATUAL</div>
   				 		<?php $this->load->helper("funcoes"); ?>
   				 		<?php $hoje = date('Y-m-d');
   				 			  $aberto = 1;
   				 			if ($hoje == $caixaHoje && $aberto == $caixaAberto) { ?>
   				 				<div class="fundocaixa col-md-12"> R$ <?php echo formata_preco($caixaAtual); ?></div>
   				 			<?php } else { ?>
   				 				<div class="fundocaixa col-md-12"> <a href="<?php echo base_url(); ?>index.php/administracao/abreCaixa"> <button type="submit" class="btn btn-sm btn-pizza"><i class="fa fa-plus"></i> ABRIR CAIXA</button></a></div>
   				 			<?php } ?>
   				 		
   				 	</div>
   				 	<div class="col-md-8">
   				 		<p>FUNÇÕES DO CAIXA </p>
   				 		<table class="table">
   				 			<tr>
   				 				<td width="30%"><b>FUNÇÃO</b></td>
   				 				<td width="20%"><b>VALOR/R$</b></td>
   				 				<td width="40%"><b>DATA/HORA</b></td>
   				 				<td width="10%"><b>AÇÃO</b></td>
   				 			</tr>
   				 			<tr>
   				 				<td>ENTRADA</td>
   				 				<form action="<?php echo base_url(); ?>index.php/administracao/entraCaixa" method="get">
	   				 				<td><input type="text" class="form-control" name="entrada" value="0,00"></input></td>
	   				 				<td><?php echo date('d-m-Y H:i:s') ?></td>
	   				 				<td><button type="submit" class="btn btn-sm btn-pizza"><i class="fa fa-plus"></i> </button></td>
   				 				</form>
   				 			</tr>
   				 			<tr>
   				 				<td>RETIRADA</td>
   				 				<form action="<?php echo base_url(); ?>index.php/administracao/saidaCaixa" method="get">
	   				 				<td><input type="text" class="form-control" name="retirada" value="0,00"></input></td>
	   				 				<td><?php echo date('d-m-Y H:i:s') ?></td>
	   				 				<td><button type="submit" class="btn btn-sm btn-pizza"><i class="fa fa-plus"></i> </button></td>
	   				 			</form>
   				 			</tr>
   				 		</table>
   				 	</div>
   				 	<div class="col-md-4"></div>
   				 	<div class="col-md-4"></div>
   				 	<div class="col-md-4"><a href="<?php echo base_url(); ?>index.php/administracao/fecharCaixa"><button class="btn btn-md btn-danger"><i class="fa fa-times"></i> FECHAR CAIXA</button></a></div>
   				 </div>
   				<div class="clearfix"> </div>
				<hr class="divisor" /> 
   				 <div class="col-md-12">
   				 	<div class="col-md-8">
   				 		
   				 	</div>
   				 	<div class="col-md-4">
   				 		
   				 	</div>
   				 </div>
  			</div>
		</div>
		<div class="panel panel-primary">
  		<div class="panel-heading">COMPRAS DO DIA</div>
  		<div class="panel-body">			
        		<?php echo form_open('administracao/produtos_form'); ?>
				    <label for="titulo">LOCAL:</label>
				    	<input type="text" size="20" class="form-control" id="titulo" name="titulo"/>
				        <br/>
				    <label for="preco">CUSTO:</label>
				    	<input type="text" size="20" class="form-control" id="valor" name="preco"/>
				        <br/>
				     <label for="preco">QNTD:</label>
				    	<input type="text" size="20" class="form-control" id="qntd" name="qntd"/>
				        <br/>
				    <input  class="btn btn-primary" type="submit" value="Cadastrar"/>
       			</form>
       			<div class="mensagem"></div>	  				
  		</div>
	</div>
		<div class="panel panel-success">
  			<div class="panel-heading">COMPRAS DO DIA</div>
  			<div class="panel-body">
   				<table class="table">
   				<tr>
				<td>ID</td>
				<td>LOCAL/PRODUTO</td>
				<td>N COMPRAS</td>
				<td>TOTAL</td>
				<td>OPÇÕES</td>
				</tr>
				<?php foreach ($produtos as $row) { ?>
				<tr>
				<td><?php echo $row->ID; ?></td>
				<td><?php echo $row->titulo; ?></td>
				<td><?php echo $row->qntd; ?></td>
				<td><?php $this->load->helper("funcoes");
				echo formata_preco($row->preco); ?></td>
				<td><a href="<?php echo base_url(); ?>index.php/administracao/excluirProduto/<?php echo $row->ID ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a> <a href="<?php echo base_url(); ?>index.php/administracao/editarProduto/<?php echo $row->ID ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a></td>
				</tr>
				<?php } ?>		 
  				</table>
  				
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
	<div class="clearfix"> </div>
	<hr class="divisor" />
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
		<div class="panel panel-default">
	  		<div class="panel-heading">LICENSA: ATIVA</div>
		  	<div class="panel-body">
		  				<p>Licensa ativa para <b><?php echo $nomeEmpresa; ?></b> <br /> <?php echo $cnpjEmpresa; ?></p>
		  				<p>SERIAL Nº: <code><?php echo $serialEmpresa ?></code></p>
		  	</div>
	  		<div class="panel-footer">Licensiado por Agência Zero7</div>
  		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-warning">
			<div class="panel-heading">Cadastrar Novo Usuário</div>
			<div class="panel-body">
		  			<form action="<?php echo base_url(); ?>index.php/administracao/addUser" target="get">
			  			<div class="col-md-7"><input class="form-control" name="username" type="text" value="Usuario sem espaços"></input></div>
			  			<div class="col-md-5">
			  				<select id="produtos" name="funcao" class="form-control">
			  					<option id='0' value="0">Função</option>
			  					<option id='1' value="1">Administrador</option>
			  					<option id='2' value="2">Atendente</option>
			  					<option id='3' value="3">Empresa</option>
			  				</select>
			  			</div>
			  			<div class="clearfix"> </div>
			  				<br />
			  			<div class="col-md-12"><input class="form-control" name="nome" type="text" value="Nome"></input></div>
			  			<div class="clearfix"> </div>
			  				<br />
			  			<div class="col-md-12"><input class="form-control" name="email" type="text" value="E-mail"></input></div>
			  			<div class="clearfix"> </div>
			  				<br />
			  			<div class="col-md-12"><input class="form-control" name="senha" type="password" value="Senha"></input></div>
			  			<div class="clearfix"> </div>
			  				<br />
			  			<div class="col-md-12"><button type="submit" class="btn btn-sm btn-primary"> Cadastrar</button></div>
			  		</form>
		  	</div>
		</div>
		<div class="panel panel-primary">
		  	<div class="panel-heading">Usuários</div>
		  	<div class="panel-body">
		  				<p><code>1 - Administrador | 2 - Atendente | 3 - Empres</code></p>
		  				<table class="table">
		  					<tr>
		  						<td>USUÁRIO</td>
		  						<td>FUNÇÃO</td>
		  						<td>OPÇÕES</td>
		  					</tr>
		  					<?php foreach ($userLista as $row) { ?>
		  					<tr>	  					
		  						<td><?php echo $row->username ?></td>
		  						<td><?php
		  							switch ($row->funcao) {
			  							case '1':
			  								echo 'Administrador';
			  								break;
			  							case '2':
			  								echo 'Atendente';
			  								break;
			  							case '3':
			  								echo 'Func. Empres.';
			  								break;
			  							
			  							default:
			  								echo 'Cadastrar';
			  								break;
		  							}

		  						 ?></td>
		  						<td><a href="<?php echo base_url(); ?>index.php/administracao/editarUser/<?php echo $row->ID ?>"><button type="submit" class="btn btn-sm btn-pizza"><i class="fa fa-plus"></i> </button></a> <a href="<?php echo base_url(); ?>index.php/administracao/deleteUser/<?php echo $row->ID ?>"> <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> </button></a></td>
		  					</tr>
		  					<?php } ?>  					
		  				</table>
		  	</div>
		</div>
	</div>
	<script type="text/javascript">
		function redireciona(){
		$(document.location.reload(true), 7000);
		}
	</script>
</section>

