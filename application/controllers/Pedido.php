<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends CI_Controller {

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

	public function index($ID)
	{
			/* Carregando o Model */

			$this->load->model('Mesas_model');
			$this->Mesas_model->editar($ID);

			$this->load->model('Cardapio_model');
			$data['pizzas'] = $this->Cardapio_model->exibir('');

					#Carregando a Mesa

			$data['ID'] = $this->input->get('ID');


					$this->load->view('header/head');
					$this->load->view('cabecalho', $data);
					$this->load->view('inicio', $data);
					$this->load->view('footer/footer');
			
		}
	public function atualizar()
	{
		/* Pegando os dados do Input */
			$data['ID'] 		= $this->input->post('ID');
			$data['pizza_id'] 	= $this->input->post('pizza_id');
			$data['mesa_id']	= $this->input->post('mesa_id');

			$data['ID'] = $this->input->get('ID');

			$this->load->model('Cardapio_model');
			$data['pizzas'] 	= $this->Cardapio_model->exibir('');

			#Carregando a Mesa

			$this->load->view('header/head');
			$this->load->view('cabecalho', $data);
			$this->load->view('inicio', $data);
			$this->load->view('footer/footer');
		
			$mesa_id 	= ucwords($this->input->post('mesa_id'));
			$pizza_id 	= ucwords($this->input->post('pizza_id'));
			$titpizza	= ucwords($this->input->post('titpizza'));
			$precPizza	= ucwords($this->input->post('precPizza'));
			$hoje 		= date('Y-m-d');
			$pedhora	= date('Y-m-d H:i:s');

			$this->load->model('Pedidos_model');
			$this->Pedidos_model->inserir($mesa_id, $pizza_id, $titpizza, $precPizza, $hoje, $pedhora);
	}

	public function exibir($ID){

		$data['ID'] = $this->input->get('ID');


		$this->load->model('Cardapio_model');
		$this->Cardapio_model->exibir($ID);
		$data['ID'] = $pizza_id;


		$this->load->view('header/head');
		$this->load->view('cabecalho', $data);
		$this->load->view('comanda_view', $data);
		$this->load->view('inicio', $data);
		$this->load->view('footer/footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */