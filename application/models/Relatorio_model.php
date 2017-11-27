<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio_model extends CI_Model {

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

	function conteVendas($pago, $hoje)
	{
		$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje') AS resultado");
			return($query->result_array());
	}

	function conteVendasTotais($pago){

		$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago') AS resultado");
			return($query->result_array());
	}

	/** VISUALIZANDO CARTÕES **/
		function conteVDin($pago, $hoje, $metdin)
		{
			$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje' AND metodo = '$metdin') AS resultado");
				return($query->result_array());
		}

		function conteVCred($pago, $hoje, $metdin)
		{
			$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje' AND metodo = '$metdin') AS resultado");
				return($query->result_array());
		}

		function conteVVisa($pago, $hoje, $metdin)
		{
			$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje' AND metodo = '$metdin') AS resultado");
				return($query->result_array());
		}

		function conteVBanr($pago, $hoje, $metdin)
		{
			$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje' AND metodo = '$metdin') AS resultado");
				return($query->result_array());
		}

	/** FIM VISUALIZANDO CARTÕES **/

	/** INICIO VISUALIZANDO USUÁRIOS **/
		function contarUsuarios()
		{
			return $this->db->count_all_results('usuarios');
		}
		function listarUsuarios()
		{
			$query = $this->db->query("SELECT * FROM usuarios");
        		return $query->result();
		}

		function vendasUsuarios($pago)
		{
			$query = $this->db->query("SELECT * FROM comanda WHERE pago = '$pago'");
				return $query->result();
		}
		
		function somandoValor($pago, $hoje, $usuario){

			$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje' AND usuario = '$usuario') AS resultado");
			return($query->result_array());
		}
	/** FIM VISUALIZANDO USUÁRIOS **/
	/** INICIO INSERINDO VALORES NO CAIXA **/


	/** FIM DO INSERINDO VALORES NO CAIXA **/

	function visualizaCaixa()
	{
		$hoje 	= date('Y-m-d');
		$query 	= $this->db->where('abertura', $hoje);
		$query 	= $this->db->query("SELECT * FROM caixa");
        		return $query->result();
	}

	function totalProdHoje($pago, $hoje)
	{
		$query = $this->db->query("SELECT sum(qntd) FROM comanda where pago = '$pago' AND abertura = '$hoje'");
			return $query->result();
	}

	function visProdVen($pago, $hoje){

		$query = $this->db->query("SELECT sum(valor) FROM comanda GROUP BY nome");
		return $query->result();
	}

	function visProdQntd($pago, $hoje){
		
		$query = $this->db->query("SELECT sum(qntd) FROM comanda GROUP BY nome");
		return $query->result();
	}

	function verProdVend(){
		$pago = 1;
		$hoje =	date('Y-m-d');

		$query = $this->db
              ->select('nome, count(nome) AS Qtd')
              ->group_by('nome')
              ->order_by('Qtd', 'DESC')
              ->where('pago', $pago)
               ->where('abertura', $hoje)
              ->get('comanda');
			return $query->result();


	}

}