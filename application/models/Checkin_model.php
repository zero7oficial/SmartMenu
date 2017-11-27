<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkin_model extends CI_Model {

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

	function inserir($mesa_id, $entrada, $nome, $pedidoID)
	{
		
		$dados = array(

			'mesa_id' 	=> $mesa_id,
			'entrada'	=> $entrada,
			'nome'		=> $nome,
			'pedido_id'	=> $pedidoID
			);

		 return $this->db->insert('checkin', $dados);
	}
/** INICIO ABERTURA E FECHAMENTO DO CAIXA **/
	function abrirCaixa($horario, $aberto, $usuario)
	{
		$dados = array(
			'abertura' 		=> $horario,
			'aberto'		=> $aberto,
			'usuario'		=> $usuario
			);

		 return $this->db->insert('caixa', $dados);
	}

	function fechaCaixa($usuario, $abertura, $aberto, $fechado, $fechamento)
	{
			$this->db->where('usuario', $usuario);
			$this->db->where('abertura', $abertura);
			$this->db->where('aberto', $fechado);
			$dados = array(				
				'aberto' 	=> $aberto,
				'fechahora' => $fechamento
				);
		$this->db->set($dados);
		return $this->db->update('caixa');
		}

/** FIM DA ABERTURA E FECHAMENTO DO CAIXA **/

	function exibir($ID)
	{
		$this->db->where('ID', $ID);
		$query = $this->db->get('checkin');
			return $query->result();
	}

	function exibirUlt($pedido_id)
	{
		$this->db->where('pedido_id', $pedido_id);
		$this->db->order_by('pedido_id', 'desc');
		$query = $this->db->get('checkin');
			return $query->result();
	}

	function exibirUltID($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->order_by('ID', 'desc');
		$query = $this->db->get('checkin');
			return $query->result();
	}

	function exibirCP($ID)
	{
		$query = $this->db->get('checkin');
			return $query->result();
	}

	function exibe()
	{
		$query = $this->db->query("SELECT * FROM checkin where ID");
			return $query->result();
	}

	function countID()
	{
		$query = $this->db->query("SELECT * FROM checkin where ID");
			return $query->num_rows();
	}

	function exibirID($ID)
	{
	$this->db->where('ID', $ID);
		$this->db->order_by('ID', 'desc');
    		$query = $this->db->get('perfil', 1);
    				return $query->result();
	}


	function exibirM($mesa_id)
	{
		$this->db->where('mesa_id', $mesa_id);
    		$query = $this->db->get('checkin');
    				return $query->result();
	}

	function editar($ID)
	{
		$this->db->where('ID', $ID);
    		$query = $this->db->get('checkin');
    			return $query->result();
	}


	function atualizarA($checkinID, $avaliacao)
	{
		$this->db->where('ID', $checkinID);

		$dados = array(
			'avaliacao'			=> $avaliacao
			);

    	$this->db->set($dados);
    		return $this->db->update('checkin');
	}

	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('checkin');

	}

}

/* End of file checkin_model.php */
/* Location: ./application/models/checkin_model.php */
