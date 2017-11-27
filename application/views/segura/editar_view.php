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
<section id="corpo">
	<div class="panel panel-primary">
		<div class="panel-heading">Editando Layout da Pizzaria</div>
		<div class="panel-body">
			<form action="<?php echo base_url(); ?>index.php/administracao/atualizaL" method="POST">
				<input type="hidden" name="ID"  class="form-control" value="<?php echo $layout[0]->ID ?>">
				<label for="nome">Nome da Pizzaria</label>				
				<input type="text" name="nome"  class="form-control" value="<?php echo $layout[0]->nome ?>" placeholder="<?php echo $layout[0]->nome ?>">
				<br />
				<label for="nome">Slogam</label>	
				<input type="text" name="slogam"  class="form-control" value="<?php echo $layout[0]->slogam ?>" placeholder="<?php echo $layout[0]->slogam ?>">
				<br />
				<label for="nome">Endereço Completo</label>	
				<input type="text" name="endereco"  class="form-control" value="<?php echo $layout[0]->endereco ?>" placeholder="<?php echo $layout[0]->endereco ?>"> <br />
				<label for="nome">Email</label>	
				<input type="email" name="email"  class="form-control" value="<?php echo $layout[0]->email ?>" placeholder="<?php echo $layout[0]->email ?>">
				<br />
				<label for="nome">Telefone</label>	
				<input type="tel" name="telefone"  class="form-control" value="<?php echo $layout[0]->telefone ?>" placeholder="<?php echo $layout[0]->telefone ?>"><br />
				<label for="nome">Serial (Chave de Ativação)</label>	
				<input type="tel" name="serial"  class="form-control" value="<?php echo $layout[0]->serial ?>" placeholder="<?php echo $layout[0]->serial ?>"><br />
				<label for="nome">Sistema de Cores</label>
				<select name="estilo" class="form-control">
					<option value="style"> Style (Amarelo e Madeira) </option>
					<option value="style1"> Style 1 (Verde, Vermelho e Branco) </option>
					<option value="style2"> Style 2 (Tons de Roxo) </option>					
				</select>
				<br />
				<input type="submit"  class="btn btn-primary disabled" value="Atualizar Dados">
			</form>
			
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">Atualizar Sua Logo</div>
		<div class="panel-body">
			<div class="col-md-4">
					<h4>Enviar Imagem</h4>					
					<img src="<?php echo base_url(); ?>uploads/layout/<?php echo $layout[0]->imagem; ?>.png" height="90px" class="responsive">
				</div>
					
				<div class="col-md-6">
					<p>Somente .PNG é permitida. O tamanho máximo é 1024</p>
					<form method="post" action="<?php echo base_url(); ?>index.php/administracao/do_upload" enctype="multipart/form-data" />
	       					<input type="hidden" class="form-control" name="ID" value="<?php echo $layout[0]->ID; ?>"/>
					    	<input type="file" class="form-control" name="userfile" size="20" />
					        <br/>
					    <input  class="btn btn-primary disabled" type="submit" value="Enviar Imagem"/>
	       			</form>
       			</div>
		</div>
	</div>
</section>