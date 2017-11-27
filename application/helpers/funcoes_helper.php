<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	/**
	 * 
	 * HELPER FORMATANDO VALOR/PREÇO
	 * 
	 * @version 1.0
	 * @author Rodrigo Franz
	 * @package FormatarValor
	 * 
	 * 
	 * 
	 */ 

	if(!function_exists('formata_preco'))
	{
		function formata_preco($valor)
		{
			$negativo = false;
			$preco = '';
			$valor = intval(trim($valor));
			if ($valor < 0) {

				$negativo = true;
				$valor = abs($valor);
			}

			$valor = strrev($valor);
			while(strlen($valor) < 3) {

				$valor .= "0";
			}

			for($i=0; $i < strlen($valor); $i++){

				if ($i == 2){
					$preco .= ",";
				}
				if (($i <> 2 AND ($i + 1)%3 == 0)){

					$preco .= ".";
				}

				$preco .=  substr($valor, $i , 1);
			}

			$preco = strrev($preco);

			return ($negativo ? "-":"") . $preco;
		}
	}
	
/* End of file funcoes_helper.php */