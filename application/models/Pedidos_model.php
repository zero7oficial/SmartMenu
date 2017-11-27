<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_model extends CI_Model {

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

	#Inserindo Pedidos

	function inserir($clienteId, $mesaId, $hoje, $pedhora, $proHorario)
	{
		$data = array(
					'cliente_id' => $clienteId,
					'mesa_id' 	=> $mesaId,
					'data' 		=> $hoje,
					'pedhora'	=> $pedhora,
					'prohora'	=> $proHorario
				);

		return $this->db->insert('pedidos', $data);

	}

	function exibir($maximo, $inicio)
	{
		$this->db->limit($maximo, $inicio);
		$query = $this->db->get('pedidos');
			return $query->result();
	}

	function exibPMM()
	{
		$pronto = 1;
		$this->db->order_by('prohora', 'DESC');
		$this->db->where('pronto', $pronto);
		$query = $this->db->get('pedidos', 9);

			return $query->result();
	}

	function contePedidos($hoje)
	{
		$this->db->where('data', $hoje);
		$query = $this->db->get('pedidos');

			return $query->result();
	}

	function contarPedidos()
	{
		$pronto = NULL;
		$this->db->where('pronto', $pronto);
		 return $this->db->count_all_results('pedidos');
	}
	
	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('pedidos');
	}
	function deletarP($clienteId)
	{
		$this->db->where('clienteId', $clienteId);
		$this->db->delete('pedidos');
	}

	function pagComP($clienteId, $pagamento, $metodo, $usuario, $comprador)
	{
		$this->db->where('cliente_id', $clienteId);
			$dados = array(
				'pago' 		=> $pagamento,
				'metodo' 	=> $metodo,
				'usuario'	=> $usuario,
				'comprador' => $comprador
				);
		$this->db->set($dados);
		return $this->db->update('pedidos');

	}

	function pronto($clienteId, $prodPronto, $proHorario)
	{

		$this->db->where('cliente_id', $clienteId);
			$dados = array(
				'pronto' => $prodPronto,
				'prohora' => $proHorario
				);
		$this->db->set($dados);
		return $this->db->update('pedidos');

	}
	
	/**  Formatando para exibir último ID 
		
		v. 1.0

	*/

	function countID()
	{
		$pronto = 1;
		$query = $this->db->query("SELECT * FROM pedidos WHERE pronto = '$pronto' ORDER BY prohora ASC");
			return $query->num_rows();
	}

	function exibCCP()
	{
		$pronto = 1;
		$query = $this->db->query("SELECT * FROM pedidos WHERE pronto = '$pronto' ORDER BY prohora ASC");
			return $query->result();
	}

	/**  Formatando para exibir último ID 
		
		v. 1.0

	*/

	function exibSMP()
	{

	}
}