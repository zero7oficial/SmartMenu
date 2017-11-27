<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acompanhamentos_model extends CI_Model {

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

	function inserir($titulo, $descricao, $preco, $qntd)
	{
		
		$dados = array(

			'titulo' 	=> $titulo,
			'descricao'	=> $descricao,
			'preco'		=> $preco,
			'qntd'		=> $qntd
			);

		 return $this->db->insert('acompanhamentos', $dados);
	}

	function exibir($ID)
	{
		$query = $this->db->get('acompanhamentos');
			return $query->result();
	}

	function editar($ID)
	{
		$this->db->where('ID', $ID);
    		$query = $this->db->get('acompanhamentos');
    			return $query->result();
	}

	function atualizar($data)
	{
		$this->db->where('ID', $data['ID']);
    		$this->db->set($data);
    			return $this->db->update('acompanhamentos');
	}

	function atuaEstoque($alacId, $newQntd)
	{
		$this->db->where('ID', $alacId);
			$dados = array(
				'qntd' => $newQntd
				);
    		$this->db->set($dados);

    			return $this->db->update('acompanhamentos');
	}

	function atualizarI($ID, $imagem)
	{
		$this->db->where('ID', $ID);
			$dados = array(
				'imagem' => $imagem
				);
    		$this->db->set($dados);

    			return $this->db->update('acompanhamentos');
	}

	function exibeRes($ID)
	{
		$this->db->where('ID', $ID);
			$query = $this->db->get('acompanhamentos');
				return $query->result();
	}

	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('acompanhamentos');

	}

}

/* End of file bebidas_model.php */
/* Location: ./application/models/bebidas_model.php */
