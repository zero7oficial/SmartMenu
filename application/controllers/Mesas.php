<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mesas extends CI_Controller {

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
	
	public function index(){

		$this->load->library('ciqrcode');

		$id_mesa = 1;

		$params['data'] = 'http://localhost/pizzaria/index.php?ID='.$id_mesa;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'includes/uploads/teste.png';

		$this->ciqrcode->generate($params);

		$img_qr = base_url().'includes/uploads/teste.png';

		$data['imagem'] = $img_qr;

		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];

		$this->load->view('segura/header/header_view');
		$this->load->view('segura/mesas_view', $data);
		$this->load->view('segura/footer/footer_view');
	}

}
