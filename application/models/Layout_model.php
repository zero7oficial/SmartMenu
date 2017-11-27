<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout_model extends CI_Model {

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

	#Inserindo estabelecimento

	function inserir($ID, $nome, $slogam)
	{
		
		$dados = array(

			'ID' 		=> $ID,
			'nome'		=> $nome,
			'slogam' 	=> $slogam
			);

		 return $this->db->insert('estabelecimento', $dados);
	}

	#Exibindo estabelecimento
	function exibir($ID)
	{
		$query = $this->db->get('estabelecimento');

			return $query->result();
	}

	#Editando estabelecimento

	function editar($ID)
	{
		$this->db->where('ID', $ID);

    		$query = $this->db->get('estabelecimento');

    			return $query->result();
	}

	#Atualizando estabelecimento

	function atualizar($ID, $nome, $slogam, $endereco,  $email, $telefone, $serial, $estilo)
	{
		$this->db->where('ID', $ID);
		$dados = array(			
				'nome' 				=> $nome,
				'slogam'			=> $slogam,
				'endereco'			=> $endereco,	
				'email'				=> $email,
				'telefone'			=> $telefone,
				'serial'			=> $serial,
				'estilo' 			=> $estilo
			);

    	$this->db->set($dados);
    		return $this->db->update('estabelecimento');		
	}


	function atualizarI($ID, $imagem)
	{
		$this->db->where('ID', $ID);
			$dados = array(
				'imagem' => $imagem
				);
    		$this->db->set($dados);

    			return $this->db->update('estabelecimento');
	}
}

/* End of file estabelecimento_model.php */
/* Location: ./application/models/estabelecimento_model.php */
