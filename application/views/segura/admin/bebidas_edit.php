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
<section class="col-md-8">
		<div>
			<p class="text-right"><a href="<?php echo base_url(); ?>index.php/administracao/bebidas"><button class="btn btn-small btn-warning">Adicionar Nova Bebida</button></a></p>
		</div>
		<div class="panel panel-primary">
			<div>
				
			</div>
  			<div class="panel-heading"><p><b>EDITANDO BEBIDAS</b></p></div>
  			<div class="panel-body">   				 
				
        		<!-- abre o formulário de edição -->
				<?php echo form_open('administracao/atualizarB'); ?>
					<input type="hidden" class="form-control" name="ID" value="<?php echo $dados_bebidas[0]->ID; ?>"/>
					<label for="titulo">Titulo:</label><br/>
					<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $dados_bebidas[0]->titulo; ?>"/>

					<label for="preco">Preço:</label><br/>
					<input type="text" name="preco" id="preco" class="form-control" value="<?php
					$this->load->helper("funcoes");
					$valor = $dados_bebidas[0]->preco;
					echo formata_preco($valor);
					?>"/>

					<label for="preco">Estoque do Produto:</label><br/>
					<input type="text" name="qntd" id="qntd" class="form-control" value="<?php
					$this->load->helper("funcoes");
					$qntd = $dados_bebidas[0]->qntd;
					echo $qntd;
					?>"/>

					<label for="preco">Custo do Produto:</label><br/>
					<input type="text" name="custo" id="custo" class="form-control" value="<?php
					$this->load->helper("funcoes");
					$custo = $dados_bebidas[0]->custo;
					echo  formata_preco($custo);
					?>"/>
					
					<label for="descricao">Descricao (Restante: <span id="contador">200</span>):</label><br/>
					<textarea class="form-control" onkeyup="limitaTextarea(this.value)" id="descricao texto" name="descricao">
						<?php echo $dados_bebidas[0]->descricao; ?>
					</textarea>
					<br />
					
					<input type="submit" class="btn btn-primary" name="atualizar" value="Atualizar Detalhes" />
				<?php echo form_close(); ?>
				<!-- fecha o formulário de edição -->
				<div class="clearfix"></div>
				<hr class="divisor" /> 
				<div class="col-md-4">
					<h4>Enviar Imagem</h4>					
					<img src="<?php echo base_url(); ?>uploads/<?php echo $dados_bebidas[0]->imagem; ?>.jpg" height="130px" class="responsive">
				</div>
					
				<div class="col-md-8">
					<p>Somente .jpg é permitida. O tamanho máximo é 1024</p>
					<form method="post" action="<?php echo base_url(); ?>index.php/administracao/upimg_b" enctype="multipart/form-data" />
	       					<input type="hidden" class="form-control" name="ID" value="<?php echo $dados_bebidas[0]->ID; ?>"/>
					    	<input type="file" class="form-control" name="userfile" size="20" />
					        <br/>
					    <input  class="btn btn-primary" type="submit" value="Enviar Imagem"/>
	       			</form>
       			</div>
       	<div class="mensagem"></div>
	  				
  			</div>
		</div>
</section>
<section class="col-md-4">
	<div class="center">
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarALC"><button class="btn btn-small btn-pizza"><i class="fa fa-cutlery"></i> NOVO PEDIDO</button></a>	
		<a href="<?php echo base_url(); ?>index.php/administracao/entrarPIZZA"><button class="btn btn-small btn-pizza"><i class="fa fa-cutlery"></i> NOVA PIZZA</button></a>	
		<div class="clearfix"> </div>
		<hr class="divisor" /> 
	</div>
	<p><code>Painel de Controle em desenvolvimento.</code></p>
	<p>A agência07 preza pela segurança de dados de nossos clientes, esse nosso diferencial é, fazer o que tem que ser feito, para maior segurança de toda a aplicação. Essa versão é a 1.0. Atualizaremos em breve.</p>
</section>
</body>

