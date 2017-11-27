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
		<div class="panel panel-danger">
  			<div class="panel-heading">SEU SISTEMA NÃO ESTÁ ATIVADO</div>
  			<div class="panel-body">
   				 <div class="col-md-12">
   				  <p>O sistema MENFIS <b>expirou</b>, você precisa reativa-lo para continuar usando.</p>
   				  <p>Para reativar seu sistema, será necessário, entrar em contato com a Agência Zero7, via WhatsApp <b>53 9 8108-5010</b> ou por e-mail <b>ativacao@agencia07.com.br</b></p>
   				  <p>Utilize o código do seu estabelecimento: <?php echo $cnpjEmpresa ?></p>
   				  <p>Se isto for um erro, por favor, entre em contato com a gente para resolver imediatamente.</p>
   				 </div>
   				<div class="clearfix"> </div>
				<hr class="divisor" /> 
   				 <div class="col-md-12">
	   				 <div class="panel-heading">OBSERVAÇÕES JURÍDICAS</div>
	  				<div class="panel-body">
	   				 	<p>Utilizar esse sistema sem a devida orientação, poderá incorrer em processo judicial, você não pode comercializar essa aplicação.</p>

	   				 	<p>Se não foi a Zero7 a empresa que lhe vendeu essa aplicação, por favor contate-nos, há melhorias significativas e atualizadas dessa aplicação.</p>
	   				</div>
	   			</div>
  			</div>
		</div>
</section>
<section class="col-md-4">
	<div class="col-md-12">
		<div class="panel panel-primary">
	  			<div class="panel-heading">LICENSA: EXPIROU</div>
	  			<div class="panel-body">
	  				<p>Licensa ativa para <b><?php echo $nomeEmpresa; ?></b> <br /> <?php echo $cnpjEmpresa; ?></p>
	  				<p>SERIAL Nº: <code>NÚMERO DE SÉRIE DESCONTINUADO</code></p>
	  			</div>
	  			<div class="panel-footer">CONTATE-NOS PARA NOVA ATIVAÇÃO</div>
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