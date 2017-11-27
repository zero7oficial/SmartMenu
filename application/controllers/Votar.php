<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votar extends CI_Controller {

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

	public function index()
	{	
		// VALOR PADRÃO DA ID DA LOJA.

		$ID 	= 1; 

		// PEGA VALORES DO BANCO DE DADOS

		$this->load->model('Votar_model');
		$data['votarID'] = $this->Votar_model->exibir($ID);	 		
	 	$votosT  = $data['votarID'][0]->votos;
	 	$pontosT = $data['votarID'][0]->pontos;


	 	// FAZ OS CÁLCULOS DOS VALORES COM OS DADOS DO POST
			
		$votos 	= $_REQUEST['votar'] + $votosT;
		$pontos = $_REQUEST['ponto'] + $pontosT;


		// ATUALIZA OS VALORES NO BANCO DE DADOS

		$this->load->model('Votar_model');
		$this->Votar_model->atualizar($ID, $votos, $pontos);

		
		$calculo = round(($pontos / $votos), 1);
		$feito = $votos." votos e ".$pontos." pontos";

		die(json_encode(array('average' => $calculo, 'votos' => $feito)));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */