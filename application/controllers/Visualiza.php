<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visualiza extends CI_Controller {

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

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));

	}

	# INDEX DO PAINEL DE ADMINISTRAÇÃO DO SMARTMENU
	# Versão 1.0

	function index()
	{
		$this->load->model('Checkin_model');
		$data['contpedi'] = $this->Checkin_model->exibirUlt('');

		$this->load->model('Pedidos_model');
		$this->load->library('pagination');
		$countIDs = $this->Pedidos_model->countID('') - 1;
		$ultPediP = $this->Pedidos_model->exibCCP('');

		if ($ultPediP == NULL) {
			
			$contpedi = "AGUARDANDO";

			$this->load->view('visualiza_view', $data);

		}else{

			$data['contpedi'] 		= $ultPediP[$countIDs]->cliente_id; //erro aqui
			$data['pedPronto'] 		= $ultPediP[$countIDs]->pronto; //erro aqui
			$data['exibpedi'] 		= $this->Pedidos_model->exibCCP('');
			$data['exibpedido'] 	= $this->Pedidos_model->exibPMM('');

					$estabID = 1;
					$this->load->model('Estabelecimento_model');
					$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
					$data['nomeEmpresa'] = $estabelecimento[0]->nome;
					$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
					$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
					$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
					$data['codeEmpresa'] = $estabelecimento[0]->codigo;
					$data['emailEmpresa'] = $estabelecimento[0]->email;
					$data['telEmpresa'] = $estabelecimento[0]->telefone;


			$this->load->view('visualiza_view', $data);
		}
		
			

			
	}

	function pool()
	{
		$this->load->model('Checkin_model');
		$data['contpedi'] = $this->Checkin_model->exibirUlt('');

		$this->load->model('Pedidos_model');
		$this->load->library('pagination');
		$countIDs = $this->Pedidos_model->countID('') - 1;
		$ultPediP = $this->Pedidos_model->exibCCP('');
		$estabID = 1;
					$this->load->model('Estabelecimento_model');
					$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
					$data['nomeEmpresa'] = $estabelecimento[0]->nome;
					$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
					$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
					$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
					$data['codeEmpresa'] = $estabelecimento[0]->codigo;
					$data['emailEmpresa'] = $estabelecimento[0]->email;
					$data['telEmpresa'] = $estabelecimento[0]->telefone;


		
		
		if($ultPediP ==  NULL){

			$data['contpedi'] = "AGUARDANDO...";
			print_r($data['contpedi']);

		}else{

			$data['contpedi'] 		= $ultPediP[$countIDs]->cliente_id;
			$data['pedPronto'] 		= $ultPediP[$countIDs]->pronto;
			$data['exibpedi'] 		= $this->Pedidos_model->exibCCP('');
			$data['exibpedido'] 	= $this->Pedidos_model->exibPMM('');

			$pedidoPronto = $data['codeEmpresa'] . $data['contpedi'];

			print_r($pedidoPronto);
		}	
	}

	function poolI()
	{
		$this->load->model('Checkin_model');
		$data['contpedi'] = $this->Checkin_model->exibirUlt('');

		$this->load->model('Pedidos_model');
		$this->load->library('pagination');
		$countIDs = $this->Pedidos_model->countID('') - 1;
		$ultPediP = $this->Pedidos_model->exibCCP('');

		if ($ultPediP == NULL ) {
			
			$exibpedido = "Aguardando...";
			echo $exibpedido;

		}else{

		$data['contpedi'] 		= $ultPediP[$countIDs]->cliente_id;
		$data['exibpedi'] 		= $this->Pedidos_model->exibCCP('');
		$exibindo  				= $this->Pedidos_model->exibPMM('');
		$data['pedPronto'] 		= $ultPediP[$countIDs]->pronto;
		$estabID = 1;
					$this->load->model('Estabelecimento_model');
					$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
					$data['nomeEmpresa'] = $estabelecimento[0]->nome;
					$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
					$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
					$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
					$data['codeEmpresa'] = $estabelecimento[0]->codigo;
					$data['emailEmpresa'] = $estabelecimento[0]->email;
					$data['telEmpresa'] = $estabelecimento[0]->telefone;

		if($countIDs > 0) {$exibpedido1 = $exibindo[1]->cliente_id;}else{$exibpedido1 = "";}
		if($countIDs > 1) {$exibpedido2 = $exibindo[2]->cliente_id;}else{$exibpedido2 = "";}
		if($countIDs > 2) {$exibpedido3 = $exibindo[3]->cliente_id;}else{$exibpedido3 = "";}
		if($countIDs > 3) {$exibpedido4 = $exibindo[4]->cliente_id;}else{$exibpedido4 = "";}
		if($countIDs > 4) {$exibpedido5 = $exibindo[5]->cliente_id;}else{$exibpedido5 = "";}
		if($countIDs > 5) {$exibpedido6 = $exibindo[6]->cliente_id;}else{$exibpedido6 = "";}

			if($exibpedido1 == NULL) {

				echo '<div class="col-md-2 fundoticket"><p style="font-size: 25px; color: #FFF;">Espera</p></div>';				
			}else{

				echo '<div class="col-md-2 fundoticket"><p style="font-size: 25px; color: #FFF;">'. $data['codeEmpresa']. $exibpedido1 . '</p></div>';			
			}

			if($exibpedido2 == NULL) {

				echo '<div class="col-md-2 fundotroco"><p style="font-size: 25px; color: #FFF;">Espera</p></div>';				
			}else{

				echo '<div class="col-md-2 fundotroco"><p style="font-size: 25px; color: #FFF;">'. $data['codeEmpresa']. $exibpedido2 . '</p></div>';			
			}

			if($exibpedido3 == NULL) {

				echo '<div class="col-md-2 fundoticket"><p style="font-size: 25px; color: #FFF;">Espera</p></div>';				
			}else{

				echo '<div class="col-md-2 fundoticket"><p style="font-size: 25px; color: #FFF;">'. $data['codeEmpresa']. $exibpedido3 . '</p></div>';			
			}

			if($exibpedido4 == NULL) {

				echo '<div class="col-md-2 fundotroco"><p style="font-size: 25px; color: #FFF;">Espera</p></div>';				
			}else{

				echo '<div class="col-md-2 fundotroco"><p style="font-size: 25px; color: #FFF;">'. $data['codeEmpresa']. $exibpedido4 . '</p></div>';			
			}

			if($exibpedido5 == NULL) {

				echo '<div class="col-md-2 fundoticket"><p style="font-size: 25px; color: #FFF;">Espera</p></div>';				
			}else{

				echo '<div class="col-md-2 fundoticket"><p style="font-size: 25px; color: #FFF;">'. $data['codeEmpresa']. $exibpedido5 . '</p></div>';			
			}

			if($exibpedido6 == NULL) {

				echo '<div class="col-md-2 fundotroco"><p style="font-size: 25px; color: #FFF;">Espera</p></div>';				
			}else{

				echo '<div class="col-md-2 fundotroco"><p style="font-size: 25px; color: #FFF;">'. $data['codeEmpresa']. $exibpedido6 . '</p></div>';			
			}

		}

	}	
	
}