<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

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

		function __construct() {
		    parent::__construct();
		    $this->load->helper('form');
		    $this->load->helper('url');
		}

	public function index()
	{
		if($this->session->userdata('login') === true){

			redirect("welcome/atualizando", 'refresh');
		} else {

			#Carregando o Checkin
			$this->load->model('Checkin_model','', TRUE);

			#Atualizando o Checkin
			$mesa_id 	= 1; //alterada, sempre a mesma mesa
			$entrada 	= date('Y-m-d');
			$nome 		= 'Visitante';
			$pedidoID	= 0;

				
			$this->load->model('Checkin_model');
			$this->Checkin_model->inserir($mesa_id, $entrada, $nome, $pedidoID);

			$checkID = $this->db->insert_id();

			//var_dump($checkID);

			$this->load->helper('cookie');

			$cookie = array(
                   'name'   => 'IDCheck',
                   'value'  => 	$checkID,
                   'expire' => '0',
                   'domain' => '/',
               );

			set_cookie($cookie);

			//$pedUlt = get_cookie('IDCheck', TRUE);
			$pedUlt = $checkID;
			
			#gerando comanda vazia
			$clienteID 	= $pedUlt;
			$mesaID 	= $mesa_id;
			$nome		= 'Comanda Gerada';
			$qntd		= 1;
			$confirmado = 1;
			$abertura	= date('Y-m-d');

			//var_dump($clienteID);

			$this->load->model('Comanda_model');
			$this->Comanda_model->insPedido($clienteID, $mesaID, $nome, $qntd, $confirmado, $abertura);

			if ($this == TRUE) {

				redirect('welcome/bemvindo/'.$checkID, 'refresh');

			}				
			
		}
	}
	public function bemvindo($ID)
	{
			$this->load->model('Cardapio_model');
			$data['pizzas'] = $this->Cardapio_model->exibir('');

			$this->load->model('Bebidas_model');
			$data['bebidas'] = $this->Bebidas_model->exibir('');

			$this->load->model('Publicidade_model');
			$data['publicidade'] = $this->Publicidade_model->exibir('');

			$this->load->model('Votar_model');
			$data['votar'] = $this->Votar_model->exibir('');

			$this->load->model('Checkin_model','', TRUE);
			$data['checando'] = $this->Checkin_model->editar($ID);
			$cliente_ID = $this->Checkin_model->exibirUltID($ID);
			$pedUlt = $cliente_ID['0']->ID;

			#ID DO CHECKIN
			//$this->load->helper('cookie');	
			//$pedUlt = get_cookie('IDCheck');
			$data['pedID'] = $pedUlt;
			$clienteId = $pedUlt;

			//var_dump($clienteId);

			#carregando comanda
			$this->load->model('Comanda_model');			 
			$data['comandaExib'] 	= $this->Comanda_model->exibir($clienteId);
			$data['somaValor']		= $this->Comanda_model->somaValor($clienteId);
			$confirmado				= $this->Comanda_model->exibirConf($clienteId);
			$data['confirmado'] 	= $confirmado['0']->confirmado;

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

			//var_dump($data['confirmado']);

			#vendo estoque cardápio
			$this->load->model('Cardapio_model');
			$estoque 			= $this->Cardapio_model->exibir('');
			$data['estoque'] 	= $estoque['0']->estoque;

				$this->load->view('header/head', $data);
				$this->load->view('cabecalho', $data);
				$this->load->view('welcome_message',$data);
				$this->load->view('footer/footer');
	}

	public function atualizando()
	{

		#pegando dados do cliente
		$this->load->helper('cookie');	
		$pedUlt = get_cookie('IDCheck');


		$buscaMesa = $this->Checkin_model->exibir($ID);		
		$mesa_id = $buscaMesa[0]->mesa_id;
		
	#gerando comanda vazia
		$clienteID 	= $pedUlt;
		$mesaID 	= $mesa_id;

		$this->load->model('Comanda_model');
		$this->Comanda_model->insPedido($clienteID, $mesaID);

	#recuperando a contagem

		$ID = $IDCheck;
		
		$this->load->model('Checkin_model','', TRUE);
		$buscaMesa = $this->Checkin_model->exibir($ID);		
		$mesa_id = $buscaMesa[0]->mesa_id;
		$avaliacao = $buscaMesa[0]->avaliacao;
		$ocupada = 'sim';

			$this->load->model('Mesas_model');
			$this->Mesas_model->atualizarP($mesa_id, $ocupada);
	}	
	
	public function logout()
	{

		$this->load->helper('cookie');

		$idCheckin = get_cookie('IDCheck');

		$ID = $idCheckin;
		
		$this->load->model('Checkin_model','', TRUE);
		$buscaMesa = $this->Checkin_model->exibir($ID);		
		$mesa_id = $buscaMesa[0]->mesa_id;
		$avaliacao = $buscaMesa[0]->avaliacao;

		$ocupada = 'nao';

			$this->load->model('Mesas_model');
			$this->Mesas_model->atualizarP($mesa_id, $ocupada);

		
			delete_cookie("IDCheck");		
		$this->session->sess_destroy();

		redirect('welcome/saiu');	
	}

	public function saiu()
	{
		$this->load->model('Layout_model');
			$ID = 1;
			$layout = $this->Layout_model->exibir('');
			$data['logo']= $layout[0]->imagem;
			$data['titulo']= $layout[0]->nome;
			$data['slogam']= $layout[0]->slogam;
			$data['estilo']= $layout[0]->estilo;
		
		$data['mensagem'] = "Obrigado! <br /> Volte Sempre";
		$data['rodape']	= "Sistema Desenvolvido por <a href='http://www.agencia07.com.br/' target='_blank'>Agência Zero7 </a> Todos os Direitos Reservados &copy 2015";
		$this->load->view('header/head', $data);
		$this->load->view('saiu_view',$data);
	}
	
}
