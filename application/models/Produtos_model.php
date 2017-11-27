<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_model extends CI_Model {

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

	function inserir($titulo, $preco, $qntd)
	{
		
		$dados = array(

			'titulo' 	=> $titulo,
			'preco'		=> $preco,
			'qntd'		=> $qntd
			);

		 return $this->db->insert('produtos', $dados);
	}

	function exibir($ID)
	{
		$query = $this->db->get('produtos');
			return $query->result();
	}

	function editar($ID)
	{
		$this->db->where('ID', $ID);
    		$query = $this->db->get('produtos');
    			return $query->result();
	}

	function atualizar($data)
	{
		$this->db->where('ID', $data['ID']);
    		$this->db->set($data);
    			return $this->db->update('produtos');
	}

	function atuaEstoque($alacId, $newQntd)
	{
		$this->db->where('ID', $alacId);
			$dados = array(
				'qntd' => $newQntd
				);
    		$this->db->set($dados);

    			return $this->db->update('produtos');
	}

	function atualizarI($ID, $imagem)
	{
		$this->db->where('ID', $ID);
			$dados = array(
				'imagem' => $imagem
				);
    		$this->db->set($dados);

    			return $this->db->update('produtos');
	}

	function exibeRes($ID)
	{
		$this->db->where('ID', $ID);
			$query = $this->db->get('produtos');
				return $query->result();
	}

	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('produtos');

	}

}

/* End of file bebidas_model.php */
/* Location: ./application/models/bebidas_model.php */
