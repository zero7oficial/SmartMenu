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
<head><title> Impressão  </title>
<script type="text/javascript">  
	function DoPrinting(){
			jsPrintSetup.setOption('headerStrLeft', ' ');
			jsPrintSetup.setOption('headerStrCenter', '');
			jsPrintSetup.setOption('headerStrRight', '');
			// set empty page footer
			jsPrintSetup.setOption('footerStrLeft', '');
			jsPrintSetup.setOption('footerStrCenter', '');
			jsPrintSetup.setOption('footerStrRight', '');
		   	jsPrintSetup.setSilentPrint(true);
		   	//jsPrintSetup. setShowPrintProgress(true);
		      jsPrintSetup.printWindow(window);
   				jsPrintSetup.setSilentPrint(0);
		    window.close();	
 </script>
</head>
<body>
<div>
<center><input type="button" value="imprimir" onClick="javascript:DoPrinting();" id="botao " /> </center>
<?php
      echo file_get_contents("uploads/txt/relatorio_".$relatdata.".txt");
?>
</div>


</body>
</html>