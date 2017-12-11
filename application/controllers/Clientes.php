<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	/**
	*  	SmartMenu - Menu Fiscal para Praças de Alimentação
	* 
	*	Sistema para gestão de praças de alimentação em eventos. 
	*	Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
	*  	Sistema de Pedido Pronto para exibição em TV, SMART TVS E PAINEIS DE LED
	*
	* @package		SmartMenu 
	* @version  	1.0
	* @author   	Agência Zero7
	* @copyright 	Copyright (c) 2017, Agência Zero7 - 17.254.945/0001-32
	* @link 		https://smartmenu.agencia07.com.br/
	*
	*
	*/
	

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
    }

    #Login de Clientes

    class clienteCadastro {

    }

    class clienteLogin {
        
    }
}