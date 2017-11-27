<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil_model extends CI_Model {

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

	function inserir($face_id, $mesa_id, $nome, $nascimento, $email, $sexo, $confirmado, $newContagem, $avaliacao)
	{
		
		$dados = array(

			'ID' 				=> $face_id,
			'mesa_id'			=> $mesa_id,
			'nome' 				=> $nome,
			'nascimento'		=> $nascimento,
			'email'				=> $email,
			'sexo'				=> $sexo,
			'confirmado'		=> $confirmado,
			'contagem'			=> $newContagem,
			'avaliacao'			=> $avaliacao
			);

		 return $this->db->insert('perfil', $dados);
	}

	function exibir($ID)
	{
		$this->db->where('ID', $ID);
    		$query = $this->db->get('perfil');
    				return $query->result();
	}

	function exibirPerf($face)
	{
		$this->db->where('ID', $face);
    		$query = $this->db->get('perfil');
    				return $query->result();
	}

	function exibirCP($ID)
	{
		$query = $this->db->get('perfil');
			return $query->result();
	}


	function exibirID($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->order_by('ID', 'desc');
    		$query = $this->db->get('perfil', 1);
    				return $query->result();
	}

	//Exibindo usuário por Facebook ID

	function exibirF($face_id)
	{
		$this->db->where('ID', $face_id);
    		$query = $this->db->get('perfil');
    				return $query->result();
	}

	function exibirM($mesa_id)
	{
		$this->db->where('mesa_id', $mesa_id);
    		$query = $this->db->get('perfil');
    				return $query->result();
	}

	function editar($ID)
	{
		$this->db->where('ID', $ID);
    		$query = $this->db->get('perfil');
    			return $query->result();
	}

	function atualizar($face_id, $mesa_id, $nome, $nascimento, $email, $sexo, $confirmado, $newContagem, $avaliacao)
	{
		$this->db->where('ID', $face_id);
		$dados = array(
			'ID' 				=> $face_id,
			'mesa_id'			=> $mesa_id,
			'nome' 				=> $nome,
			'nascimento'		=> $nascimento,
			'email'				=> $email,
			'sexo'				=> $sexo,
			'confirmado'		=> $confirmado,
			'contagem'			=> $newContagem,
			'avaliacao'			=> $avaliacao
			);
    	$this->db->set($dados);
    		return $this->db->update('perfil');
	}

	function atualizarV($face_id, $avaliacao)
	{
		$this->db->where('ID', $face_id);
		$dados = array(
			'ID' 				=> $face_id,
			'avaliacao'			=> $avaliacao
			);
    	$this->db->set($dados);
    		return $this->db->update('perfil');
	}

	function atualizarP($face_id, $pontos)
	{
		$this->db->where('ID', $face_id);
		$dados = array(
			'ID' 				=> $face_id,
			'pontos'			=> $pontos
			);
    	$this->db->set($dados);
    		return $this->db->update('perfil');
	}

	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('perfil');

	}

}

/* End of file cardapio_model.php */
/* Location: ./application/models/cardapio_model.php */
