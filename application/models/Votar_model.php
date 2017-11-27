<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votar_model extends CI_Model {

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


	function exibir($ID)
	{
		$query = $this->db->get('estabelecimento');
			return $query->result();
	}

	function atualizar($ID, $votos, $pontos)
	{

		$dados = array(

			'ID' 		=> $ID,
			'votos'		=> $votos,
			'pontos'	=> $pontos
			);

		 return $this->db->update('estabelecimento', $dados);
	}
}

/* End of file Votar_model.php */
/* Location: ./application/models/votar_model.php */
