<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

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

		function login($username, $senha)
		{
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->where('username', $username);
			$this->db->where('senha', MD5($senha));

			$this->db->limit(1);

			$query = $this->db->get();

			if ($query -> num_rows() == 1) {
				return $query->result();
			} else {

				return false;
			}
		}

		function cadastro($usuario, $nome, $email, $senha, $funcao){

			$dados = array(
			'username'	=> $usuario,
			'nome'		=> $nome,
			'email'		=>  $email,
			'senha' 	=> $senha,
			'funcao'	=> $funcao			
			);

		 		return $this->db->insert('usuarios', $dados);
		}

		function visualiza(){
			$query 	= $this->db->query("SELECT * FROM usuarios");
        		return $query->result();
		}

		function userAtivo($username){
			$this->db->where('username', $username);
			$query 	= $this->db->get('usuarios');
        		return $query->result();
		}

		function editar($ID){
			$this->db->where('ID', $ID);
			$query = $this->db->get('usuarios');
				return $query->result();
		}

		function atualiza($ID, $nome, $email, $senha, $funcao){

			$this->db->where('ID', $ID);
			$data  = array(
				'nome' 	=> $nome,
				'email' => $email,
				'senha' => $senha,
				'funcao' => $funcao
				);
    		$this->db->set($data);
    			return $this->db->update('usuarios');
		}

		function delete($ID){
		
		$this->db->where('ID', $ID);
		$this->db->delete('usuarios');

		}

}

/* End of file usuario_model.php */
/* Location: ./application/models/usuario_model.php */
