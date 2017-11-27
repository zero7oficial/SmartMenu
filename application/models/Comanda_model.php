<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comanda_model extends CI_Model {

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

	#Inserindo Lanches
	function inserir($clienteId, $mesaId, $nome, $cardID, $qntd,  $valor, $observac)
	{
		$data = array(
					'clienteID' => $clienteId,
					'mesaId'	=> $mesaId,
					'nome'		=> $nome,
					'cardID'	=> $cardID,
					'qntd'		=> $qntd,
					'valor'		=> $valor,
					'observac'	=> $observac
				);

		$this->db->select('*');
		$this->db->insert('comanda', $data);

	}

	#Inserindo Bebidas
	function inserirB($clienteId, $mesaId, $nome, $bebID, $qntd, $valor)
	{
		$data = array(
					'clienteID' => $clienteId,
					'mesaId'	=> $mesaId,
					'nome'		=> $nome,
					'bebID'		=> $bebID,
					'qntd'		=> $qntd,
					'valor'		=> $valor
				);

		$this->db->select('*');
		$this->db->insert('comanda', $data);

	}

	function insPedido($clienteId, $mesaId, $nome, $qntd, $confirmado, $abertura)
	{
		$dados = array(
			'clienteID' 	=> $clienteId,
			'mesaID' 		=> $mesaId,
			'nome'			=> $nome,
			'qntd'			=> $qntd,
			'confirmado'	=> $confirmado,
			'abertura'		=> $abertura
			);

		 return $this->db->insert('comanda', $dados);
	}

	function insCom($clienteId, $mesaId, $confirmado)
	{
		$dados = array(

			'clienteID' 	=> $clienteId,
			'mesaID' 		=> $mesaId,
			'confirmado'	=> $confirmado
			);

		 return $this->db->insert('comanda', $dados);
	}

	function conteVendas($pago, $hoje)
	{
		$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje') AS resultado");
			return($query->result_array());
	}

	/** VISUALIZANDO CARTÕES **/
	function conteVDin($pago, $hoje, $metdin)
	{
		$query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where pago = '$pago' AND abertura = '$hoje' AND metodo = '$metdin') AS resultado");
			return($query->result_array());
	}
	/** FIM VISUALIZANDO CARTÕES **/

	function exibir($clienteId)
	{
		 $query = $this->db->query("SELECT * FROM comanda where clienteID = '$clienteId'");
        return $query->result();
	}

	function exibirConf($clienteId)
	{
		 $query = $this->db->query("SELECT * FROM comanda where clienteID = '$clienteId'");
        return $query->result();
	}

	function exibindo()
	{
		 $query = $this->db->query("SELECT * FROM comanda");
        return $query->result();
	}

	function confPedido($clienteId, $confirmado, $hoje)
	{

		$this->db->where('clienteId', $clienteId);
			$dados = array(
				'confirmado' => $confirmado,
				'abertura' 	=> $hoje
				);
		$this->db->set($dados);
		return $this->db->update('comanda'); 

	}

	function pagarCom($clienteId, $pagamento, $metodo, $usuario, $comprador)
	{
		$this->db->where('clienteID', $clienteId);
			$dados = array(
				'pago' 		=> $pagamento,
				'metodo' 	=> $metodo,
				'usuario' 	=> $usuario,
				'comprador' => $comprador
				);
		$this->db->set($dados);
		return $this->db->update('comanda');

	}

	function fecConta($clienteId, $pagamento)
	{

		$this->db->where('clienteId', $clienteId);
			$dados = array(
				'pagamento' => $pagamento
				);
		$this->db->set($dados);
			return $this->db->update('comanda');  

	}

	function comandaExib($clienteId)
	{
		 $query = $this->db->query("SELECT * FROM comanda where clienteID = '$clienteId'");
        	return $query->result();
	}

	function pedAlac($clienteId, $mesaId, $nome, $alacId, $alacQntd, $alacValor, $alacPeso, $abertura)
	{
		//$this->db->where('clienteId', $clienteId);
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $nome,
				'alacID'	=> $alacId,
				'qntd'		=> $alacQntd,
				'valor'		=> $alacValor,
				'peso'		=> $alacPeso,
				'abertura'	=> $abertura
				);
		$this->db->select('*');
			return $this->db->insert('comanda', $dados); 
	}

	function proAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura)
	{
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $nome,
				'observac'	=> $vendObs,
				'cardID'	=> $alacId,
				'valor'		=> $alacValor,
				'qntd'		=> $alacQtd,
				'abertura'	=> $abertura
				);
		$this->db->select('*');
			return $this->db->insert('comanda', $dados); 
	}

	function bebAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura)
	{
		//$this->db->where('clienteId', $clienteId);
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $nome,
				'observac'	=> $vendObs,
				'bebID'		=> $alacId,
				'valor'		=> $alacValor,
				'qntd'		=> $alacQtd,
				'abertura'	=> $abertura
				);
		$this->db->select('*');
			return $this->db->insert('comanda', $dados); 
	}

	function acomAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura)
	{
		//$this->db->where('clienteId', $clienteId);
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $nome,
				'observac'	=> $vendObs,
				'acomID'	=> $alacId,
				'valor'		=> $alacValor,
				'qntd'		=> $alacQtd,
				'abertura'	=> $abertura
				);
		$this->db->select('*');
			return $this->db->insert('comanda', $dados); 
	}

	function pizAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura)
	{
		//$this->db->where('clienteId', $clienteId);
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $nome,
				'observac'	=> $vendObs,
				'pizzID'	=> $alacId,
				'valor'		=> $alacValor,
				'qntd'		=> $alacQtd,
				'abertura'	=> $abertura
				);
		$this->db->select('*');
			return $this->db->insert('comanda', $dados); 
	}

	function pizAdd($clienteId, $mesaId, $nome, $alacId, $pizzADD, $alacValor, $alacQtd, $abertura)
	{
		//$this->db->where('clienteId', $clienteId);
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $nome,
				'pizzID'	=> $alacId,
				'pizzADD'	=> $pizzADD,
				'valor'		=> $alacValor,
				'qntd'		=> $alacQtd,
				'abertura'	=> $abertura
				);
		$this->db->select('*');

			return $this->db->insert('comanda', $dados); 
	}

	function pizAddTwo($clienteId, $mesaId, $pizzasSelec, $pizzFCH, $pizzasValor, $pizzaQtd, $abertura)
	{
		//$this->db->where('clienteId', $clienteId);
		$dados = array(
				'clienteID'	=> $clienteId,
				'mesaID'	=> $mesaId,
				'nome'		=> $pizzasSelec,
				'pizzADD'	=> $pizzFCH,
				'valor'		=> $pizzasValor,
				'qntd'		=> $pizzaQtd,
				'abertura'	=> $abertura
				);
		$this->db->select('*');
			return $this->db->insert('comanda', $dados); 
	}

	function atuaPizzaCom($clienteId, $pizzADD, $mesaId, $pizzSabores, $calcValor, $alacQtd, $abertura)
	{
		$this->db->where('clienteId', $clienteId);
		$this->db->where('pizzADD', $pizzADD);
		$dados = array(
				'mesaID'	=> $mesaId,
				'nome'		=> $pizzSabores,
				'valor'		=> $calcValor,
				'qntd'		=> $alacQtd,
				'abertura'	=> $abertura
				);
		$this->db->set($dados);
			return $this->db->update('comanda', $dados); 
	}

	function exibPizzas($clienteId, $pizzADD)
	{
		 $query = $this->db->query("SELECT * FROM comanda where clienteID = '$clienteId' AND  pizzADD = '$pizzADD'");
        	return $query->result();
	}

	function somaValor($clienteId)
	{

        $query = $this->db->query("SELECT sum(valor) FROM (SELECT valor FROM comanda where clienteId = '$clienteId' ) AS resultado");
			return($query->result_array());
	}

	function conteComan()
	{
		
		return $this->db->count_all_results('comanda');
	}

	function pagamento($data)
	{
		$this->db->where('ID', $data['ID']);
    	$this->db->set($data);
    	return $this->db->update('comanda');
	}

	function deletar($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('comanda');
	}

	function deleteOutras($clienteId, $pizzADD)
	{
		$this->db->where('clienteID', $clienteId);
		$this->db->where('pizzADD', $pizzADD);
		$this->db->delete('comanda');
	}

	function excluirItem($ID){
		$this->db->where('ID', $ID);
		$this->db->delete('comanda');
	}

	function fechando($clienteId)
	{
		$this->db->where('clienteId', $clienteId);
		$this->db->delete('comanda');
	}

	function contarVendasUser($clienteId)
	{
		$query = $this->db->query("SELECT * FROM comanda WHERE clienteId = '$clienteId'");
			return $query->result();
	}

	function delItem($idProduto){
		$this->db->where('ID', $idProduto);
		$this->db->delete('comanda');
	}
}