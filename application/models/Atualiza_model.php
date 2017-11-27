<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atualiza_model extends CI_Model {

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
	public function __Construct()
	{
		parent::__Construct();
	}

	#Inserindo Mesas

	function inserir($face_id, $nome, $titulo_p, $titulo_b, $mesa_id)
	{
		$data = array(
					'face_id' 	=> $face_id,
					'nome'		=> $nome,
					'titulo_p'	=> $titulo_p,
					'titulo_b'	=> $titulo_b,					
					'mesa_id' 	=> $mesa_id
				);

		$this->db->select('*');
		$this->db->insert('pedidot', $data);

	}

	function exibir($maximo, $inicio)
	{
		$this->db->limit($maximo, $inicio);
		$query = $this->db->get('pedidot');
			return $query->result();
	}

	function exibeT($face_id){

		$this->db->where('face_id', $face_id);
    		$query = $this->db->get('pedidot');
    				return $query->result();
	}

	function contePedidos(){
		return $this->db->count_all_results('pedidot');
	}
}