<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comanda extends CI_Controller {

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
	

	public function  index($clienteId){

		/* Carregando o Model */

		$this->load->model('Comanda_model');
		$data['pedcliente'] = $this->Comanda_model->exibir($clienteId);

		$this->load->view('comanda_view', $data);
	}

	# Add Lanches
	public function addLanches(){

		$this->load->model('Comanda_model');

		$clienteId 	= $this->input->post('clienteId');
		$mesaId 	= $this->input->post('mesaId');
		$nome		= $this->input->post('nome');
		$cardID		= $this->input->post('cardID');
		$qntd		= $this->input->post('qntd');
		$valor		= $this->input->post('valor') * $qntd;
		$observac	= $this->input->post('observac');
		

		$this->Comanda_model->inserir($clienteId, $mesaId, $nome, $cardID, $qntd, $valor, $observac);


		if ($this == true ) {

			$userid 	= $this->input->post('userid');			
			redirect('welcome/bemvindo/' . $clienteId);
		}

	}

	# Add Bebidas
	public function addBebidas(){

		$this->load->model('Comanda_model');

		$clienteId 	= $this->input->post('clienteId');
		$mesaId 	= $this->input->post('mesaId');
		$nome		= $this->input->post('nome');
		$bebID		= $this->input->post('bebID');
		$qntd		= $this->input->post('qntd');
		$valor		= $this->input->post('valor') * $qntd;
		

		$this->Comanda_model->inserirB($clienteId, $mesaId, $nome, $bebID, $qntd, $valor);

		if ($this == true ) {

			$userid 	= $this->input->post('userid');			
			redirect('welcome/bemvindo/' . $clienteId);
		}

	}


	# Confirmando Pedido e Enviando ao Painel de Controle
	public function confPedido(){

		$mesaId 	= $this->input->post('mesaId');
		$clienteId 	= $this->input->post('clienteId');
		$hoje 		= date('Y-m-d');
		$pedhora	= date('Y-m-d H:i:s');
		$proHorario = date('Y-m-d H:i:s');
		$confirmado = 1;

		$this->load->model('Comanda_model');
		$this->Comanda_model->confPedido($clienteId, $confirmado, $hoje);

		$this->load->model('Pedidos_model');
		$this->Pedidos_model->inserir($clienteId, $mesaId, $hoje, $pedhora, $proHorario);


		if ($this == true) {
			
			redirect('visualiza/', 'refresh');
		}
	}

	# Deletar Produto
	public function delProduto($ID){

		$mesaId 	= $this->input->post('mesaId');
		$clienteId 	= $this->input->post('clienteId');

		$this->load->model('Comanda_model');
		$this->Comanda_model->deletar($ID);

		if ($this == TRUE) {
			
			redirect('welcome/bemvindo/' . $clienteId);
			
		}

	}


	# Finalizar Pedido (Pedir a Conta)
	public function finalizando(){

		$mesaId 	= $this->input->post('mesaId');
		$clienteId 	= $this->input->post('clienteId');
		$valorTotal = $this->input->post('valorTotal');
		$pagamento = 1;

		$this->load->model('Comanda_model');
		$this->Comanda_model->fecConta($clienteId, $pagamento);


		if ($this == true) {
			
			redirect('welcome/bemvindo/' . $clienteId);
		}

	}

}

/* End of file comanda.php */
/* Location: ./application/controllers/comanda.php */