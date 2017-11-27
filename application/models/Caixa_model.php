<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caixa_model extends CI_Model {

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


	/** INICIO INSERINDO VALORES NO CAIXA **/

		function abrirCaixa($dataHoje, $aberto, $usuario, $entrada){
			$dados = array(
			'abertura'	=> $dataHoje,
			'aberto'	=> $aberto,
			'usuario'	=>  $usuario,
			'entrada' 	=> $entrada			
			);

		 return $this->db->insert('caixa', $dados);
		}

		function entradaCaixa($ultID, $entrada){

			$this->db->where('ID', $ultID);
			$dados = array(
				'entrada' => $entrada
			);
				$this->db->set($dados);
		 		return $this->db->update('caixa');
		}

		function vendasCaixa($ultID, $newVendas){

			$this->db->where('ID', $ultID);
			$dados = array(
				'total' => $newVendas
			);
				$this->db->set($dados);
		 		return $this->db->update('caixa');
		}




		function exibirInicial(){

			$hoje 	= date('Y-m-d');
			$query 	= $this->db->where('abertura', $hoje);
			$query 	= $this->db->order_by('ID', 'desc');
			$query 	= $this->db->query("SELECT * FROM caixa");
	        		return $query->result();
		}

		function contarResultados(){
			$query 	= $this->db->query("SELECT * FROM caixa");
			return $query->num_rows();
		}

		function retiradaCaixa($ultID, $retirada){

			$this->db->where('ID', $ultID);
			$dados = array(
				'saida'			=> $retirada
			);

    			$this->db->set($dados);
    				return $this->db->update('caixa');
		}

		function fechandoCaixa($ultID, $aberto){

			$this->db->where('ID', $ultID);
			$dados = array(
				'aberto' => $aberto
			);
				$this->db->set($dados);
		 		return $this->db->update('caixa');
		}

	/** FIM DO INSERINDO VALORES NO CAIXA **/

	
}