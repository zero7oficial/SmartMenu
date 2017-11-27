<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
	
	public function index($ID)
	{
		#Carregando o Cardápio
		$this->load->model('Cardapio_model');
		$data['pizzas'] = $this->Cardapio_model->exibir('');

		#Carregando o Bebidas
		$this->load->model('Bebidas_model');
		$data['bebidas'] = $this->Bebidas_model->exibir('');

		#Carregando o Votar
		$this->load->model('Votar_model');
		$data['votar'] = $this->Votar_model->exibir('');

		#Carregando o Mesas
		$this->load->model('Mesas_model');
		$data['mesa'] = $this->Mesas_model->exibir('');

		#Carregando o Checkin
		$this->load->model('Checkin_model','', TRUE);
		$data['checando'] = $this->Checkin_model->exibir($ID);

		#Carregando a publicidade
		$this->load->model('Publicidade_model');
		$data['publicidade'] = $this->Publicidade_model->exibir('');

		#Carregando a Comanda
		$clienteId = $this->Checkin_model->exibir($ID);

		$this->load->model('Comanda_model');
		$data['comandaExib'] 	= $this->Comanda_model->exibir($clienteId);
		$data['somaValor']		= $this->Comanda_model->somaValor($clienteId);

		$this->load->model('Layout_model');
			$ID = 1;
			$layout = $this->Layout_model->exibir('');
			$data['logo']= $layout[0]->imagem;
			$data['titulo']= $layout[0]->nome;
			$data['slogam']= $layout[0]->slogam;
			$data['estilo']= $layout[0]->estilo;

		$this->load->view('header/head', $data);
		$this->load->view('cabecalho', $data);
		$this->load->view('inicio', $data);
		$this->load->view('footer/footer');

	}

	public function logado($ID){

		#Carregando o Cardápio
		$this->load->model('Cardapio_model');
		$data['pizzas'] = $this->Cardapio_model->exibir('');

		#Carregando o Bebidas
		$this->load->model('Bebidas_model');
		$data['bebidas'] = $this->Bebidas_model->exibir('');

		#Carregando o Votar
		$this->load->model('Votar_model');
		$data['votar'] = $this->Votar_model->exibir('');

		#Carregando o Mesas
		$this->load->model('Mesas_model');
		$data['mesa'] = $this->Mesas_model->exibir('');

		#Carregando o Checkin
		$this->load->model('Checkin_model','', TRUE);
		$data['checando'] = $this->Checkin_model->exibir($ID);

		#Carregando a publicidade
		$this->load->model('Publicidade_model');
		$data['publicidade'] = $this->Publicidade_model->exibir('');

		#Carregando a Comanda
		$this->load->model('Comanda_model');
		$data['comandaExib'] 	= $this->Comanda_model->exibir($clienteId);
		$data['somaValor']		= $this->Comanda_model->somaValor($clienteId);

		$this->load->model('Layout_model');
			$ID = 1;
			$layout = $this->Layout_model->exibir('');
			$data['logo']= $layout[0]->imagem;
			$data['titulo']= $layout[0]->nome;
			$data['slogam']= $layout[0]->slogam;
			$data['estilo']= $layout[0]->estilo;

		$this->load->view('header/head', $data);
		$this->load->view('cabecalho', $data);
		$this->load->view('inicio', $data);
		$this->load->view('footer/footer');
	}
	/*
	public function chamaGar()
	{
			#SISTEMA
			$ID 	= $this->input->post('userid');
			$userid = $ID;			
			$mesaId 	= ucwords($this->input->post('mesa_id'));
			$clienteId 	= $this->input->post('faceid');
			$pedhora	= date('Y-m-d H:i:s');

			$this->load->model('Pedidos_model');
			$this->Pedidos_model->inserir($mesaId, $clienteId, $pedhora);
	}
	*/
	public function votacao()
	{
		// VALOR PADRÃO DA ID DA LOJA.
		$ID 	= 1; 

		// PEGA VALORES DO BANCO DE DADOS
		$this->load->model('Votar_model');
		$data['votarID'] = $this->Votar_model->exibir($ID);	 		
	 	$votosT  = $data['votarID'][0]->votos;
	 	$pontosT = $data['votarID'][0]->pontos;

	 	//PEGA VALORES DA VOTAÇÃO
	 	$checkinID 	= $_REQUEST['checkid'];
		$avaliacao 	= $_REQUEST['ponto'];
		$faceid		= $_REQUEST['faceid'];

	 	// FAZ OS CÁLCULOS DOS VALORES COM OS DADOS DO POST			
		$votos 	= $_REQUEST['votar'] + $votosT;
		$pontos = $_REQUEST['ponto'] + $pontosT;


		// ATUALIZA OS VALORES VOTAR MODEL
		$this->load->model('Votar_model');
		$this->Votar_model->atualizar($ID, $votos, $pontos);

		// ATUALIZA OS VALORES EM CHECKIN MODEL
		$this->load->model('Checkin_model');
		$this->Checkin_model->atualizarA($checkinID, $avaliacao);	

		// ATUALIZA OS VALORES EM CHECKIN MODEL

		$this->load->model('Perfil_model');
		$face_id = $faceid;
		$this->Perfil_model->atualizarV($face_id, $avaliacao);

		
		$calculo = round(($pontos / $votos), 1);
		$feito = $votos." votos e ".$pontos." pontos";

		die(json_encode(array('average' => $calculo, 'votos' => $feito))); 
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */