<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestao extends CI_Controller {

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
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];

	}

	# INICIO PÁGINA DE GESTAO
		# Versão 1.1
		# Autor - ZERO7 LTDA

		function G2207()
		{
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
			
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
				$data['serialEmpresa'] = $estabelecimento[0]->serial;
				$serialEmpresa = $estabelecimento[0]->serial;
				$serialAtual = file_get_contents("uploads/txt/serial.txt");

				if ($serialAtual == $serialEmpresa) {
					
					$this->load->model('Layout_model');
					$data['layout']	= $this->Layout_model->exibir('');

					$userSistema = 'franz';

					if ($userSistema == $usuario) {
						
						$this->load->view('segura/header/header_view', $data);
						$this->load->view('gestao/gestao_view', $data);

					}else{

						echo "O que você faz aqui? Você não tem permissão para acesso a codificação do sistema!";
					}

					
					
				}else{

					$this->load->view('segura/header/header_view', $data);
					$this->load->view('gestao/ative_view', $data);
					
				}
		}

	#FIM DA PÁGINA DE GESTAO

	#INICIO PÁGINA DE CONTROLE

		function controleAtivacao(){

			$hoje = date("Y-m-d");
			//$hoje = "2017-06-23";
			//$ativacao = file_get_contents("https://www.agencia07.com.br/sistemas/ativacao/serialrimas.txt");
			$ativacao = "2018-10-05";
			$dif = strtotime($ativacao) - strtotime($hoje);

			$serialAtivado = ($dif / 86400);

			if ($serialAtivado == 0 OR $serialAtivado <= 0) {
				
				$codhj = date('dm');
				$codsi = $codhj + 1000;
				$codfi = $codsi + $codhj;
				$estabID = 1;
				$newSerial = "2207-" .$codhj. "-".$codsi."-".$codfi;
				$this->load->model('Estabelecimento_model');
				$this->Estabelecimento_model->atualizaSerial($estabID, $newSerial);

				if ($this == TRUE) {
					
					redirect('gestao/G2207', 'refresh');
				}

			}else{

				redirect('administracao', 'refresh');
			}

				
		}

	#FIM DA PAGINA DE CONTROLE
}