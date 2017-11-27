<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validar_login extends CI_Controller {

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
		$this->load->model('usuario_model','',TRUE);
	}

	function index()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('senha','Senha','trim|required|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('segura/login_view');
		} 
		else 
		{
			$hoje 		= date('Y-m-d H:i:s');
			$aberto 	= 1;
			$usuario 	= $this->input->post('username');
			
			// Verificando se SERIAL está ativado
			redirect('gestao/controleAtivacao', 'refresh');
		}
	}

	function check_database($senha)
	{
		//Validação do Campo com Sucesso. Na base de dados.
		$username = $this->input->post('username');

		//Query do Banco de Dados
		$result = $this->usuario_model->login($username, $senha);

		if($result)
		{
			$sess_array = array();
			foreach ($result as $row)
			{
				$sess_array = array(
				'ID' 		=> $row->ID,
				'username' 	=> $row->username //AQUI ERRO DE STDCLASS
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}	
			return TRUE;
			$hoje 		= date('Y-m-d H:i:s');
			$aberto 	= 1;
			$usuario 	= $this->input->post('username');

			$this->load->model('Checkin_model');
			$this->Checkin_model->abrirCaixa($hoje, $aberto, $usuario);

		}
		else
		{
			$this->form_validation->set_message('check_database', 'Usuário e Senha Inválido!');
			return FALSE;
		}
			
	}

}

/* End of file validar_login.php */
/* Location: ./application/controllers/validar_login.php */