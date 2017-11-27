<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mesas_model extends CI_Model {

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

	function inserir($mesa)
	{
		
		$dados = array(

			'mesas' 	=> $mesa
			);

		 return $this->db->insert('mesas', $dados);
	}

	#Exibindo Mesas

	function exibir($ID)
	{
		$query = $this->db->get('mesas');

			return $query->result();
	}

	#Editando Mesas

	function editar($ID)
	{
		$this->db->where('ID', $ID);

    		$query = $this->db->get('mesas');

    			return $query->result();
	}

	#Atualizando Mesas

	function atualizar($data)
	{
		$this->db->where('ID', $data['ID']);
    	$this->db->set($data);
    		return $this->db->update('mesas');		
	}

	function atualizarP($mesa_id, $ocupada){

		$this->db->where('ID', $mesa_id);
		$dados = array(
			'ID' => $mesa_id,
			'ocupada' => $ocupada
			);
		$this->db->set($dados);
    		return $this->db->update('mesas');	
	}

	function contMesas(){
		return $this->db->count_all_results('mesas');
	}


	#Deletando Mesas

	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('mesas');

	}

}

/* End of file mesas_model.php */
/* Location: ./application/models/mesas_model.php */
