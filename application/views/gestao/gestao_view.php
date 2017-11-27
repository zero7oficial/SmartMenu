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
<section class="col-md-8">
		<div class="panel panel-warning">
  			<div class="panel-heading">GESTÃO DO SISTEMA</div>
  			<div class="panel-body">
   				 <div class="col-md-12">
   				   <form>
   				   		<div class="col-md-3">NOME DA EMPRESA</div>
   				   		<div class="col-md-9"><input type="text" class="form-control" name="empresa" value=""></input></div>
   				   		
   				   </form>
   				 </div>
   				<div class="clearfix"> </div>
				<hr class="divisor" /> 
				<div class="clearfix"> <br /></div>
				<div class="clearfix"> <br /> </div>
				<div class="clearfix"> <br /></div>
				<div class="clearfix"> <br /></div>
				
   				 <div class="col-md-12">
   				 		
   				 </div>
  			</div>
		</div>
</section>
<section class="col-md-4">
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
	<div class="col-md-6"></div>
	<div class="col-md-6"></div>
	<div class="clearfix"> </div>
	<hr class="divisor" /> 
</section>
<section class="col-md-12">
<div id="footer" class="footer copy_pc" style="position: fixed;  bottom: 0; padding-bottom: 2%;padding-top: 2%; left: 0">
       <p>Painel de Administração desenvolvido por <b><a href="https://www.agencia07.com.br/">Agência Zero7</a></b> | <b>Menfis - Versão 1.0</b></p>
    </div>
</section>