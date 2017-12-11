<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administracao extends CI_Controller {

	/**
	*  	SmartMenu - Menu Fiscal para Praças de Alimentação
	* 
	*	Sistema para gestão de praças de alimentação em eventos. 
	*	Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
	*  	Sistema de Pedido Pronto para exibição em TV, SMART TVS E PAINEIS DE LED
	*
	* @package		SmartMenu 
	* @version  	1.0
	* @author   	Agência Zero7
	* @copyright 	Copyright (c) 2017, Agência Zero7 - 17.254.945/0001-32
	* @link 		https://smartmenu.agencia07.com.br/
	*
	*
	*/
	

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
	}

	# PÁGINA INICIAL DO PAINEL DE ADMINISTRAÇÃO DO SMARTMENU
		# Versão 1.1
		# Autor - ZERO7 LTDA

		function index()
		{
			if ($this->session->userdata('logged_in')) 
			{
				
				$serialAtual = file_get_contents("uploads/txt/serial.txt");
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
			
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				$data['serialEmpresa'] = $estabelecimento[0]->serial;
				$serialEmpresa = $estabelecimento[0]->serial;
					

				$pago 	= 1;
				$hoje 	= date('Y-m-d');
				$aberto = 1;
				$metdin = 'dinheiro';

				$this->load->model('Pedidos_model');
				$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

				$this->load->model('Comanda_model');
				$data['contvendas'] = $this->Comanda_model->conteVendas($pago, $hoje);
				$data['contvdin'] = $this->Comanda_model->conteVDin($pago, $hoje, $metdin);

				$this->load->model('Layout_model');
				$data['layout']	= $this->Layout_model->exibir('');

				$this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;

				if ($serialAtual == $serialEmpresa) {
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin_view', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}else{

					$this->load->view('segura/header/header_view', $data);
					$this->load->view('gestao/ative_view', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}
			}
			else
			{
				//Se não tiver Session, redireciona para LOGIN
			 	redirect('login', 'refresh');
			}
		}

		function logout()
		{
				
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$fechamento 		= date('Y-m-d H:i:s');
				$fechado 			= 1;
				$aberto				= 0;
				$abertura			= date('Y-m-d');

				$this->session->unset_userdata('logged_in');
					session_destroy();
					redirect('administracao', 'refresh');
		}
	# FIM DA PÁGINA INICIAL DO PAINEL ADMINISTRATIVO

	#INICIO TABLETS ATENDIMENTO
		function tablets(){
			if ($this->session->userdata('logged_in')) 
			{	
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];

				$hoje = date('Y-m-d');

				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;

				$this->load->model('Pedidos_model');				
		        $data['pedidos']	= $this->Pedidos_model->contePedidos($hoje);

				
				$this->load->view('segura/admin/tablets_view', $data);
				

			}else{ 

				redirect('login', 'refresh');
			}
		}

		function prontoTab()
		{
		if ($this->session->userdata('logged_in')) 
		{
			/* Produto Pronto */
			$clienteId 	= $this->input->get('clienteId');
			$prodPronto = 1;
			$proHorario	= date('Y-m-d H:i:s');
			$this->load->model('Pedidos_model');
			$this->Pedidos_model->pronto($clienteId, $prodPronto, $proHorario);

			if (!$clienteId == NULL) {
				
				redirect('administracao/tablets','refresh');

				} else {

					print_r("Erro, a variável está sendo passada NULL");
				}
			

			}else{

				redirect('login', 'refresh');
			}

		}
	#FIM TABLETS ATENDIMENTO

	/**
	* Função de Pagamento da Comanda v.1.008
	* @author Rodrigo Franz
	* @version 1.008
	* @copyright 	Copyright (c) 2015, Agência Zero7 LTDA
	* @package MenFis - Menu Fiscal
	*/

	#INÍCIO FUNÇÃO PAGAMENTO
		function pagCom()
		{
			if ($this->session->userdata('logged_in')) 
			{
				/* Efetuando o pagamento */
				$session_data 		= $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$clienteId 			= $this->input->get("clienteId");
				$impressao			= $this->input->get("impressao");
				$comprador 			= $this->input->get("cliente");
				$metodo				= $this->input->get('metodo');
				$recebido			= $this->input->get('totalRec');
				$pagamento 			= 1;
				$diaHora 			= date('d/m/Y h:i:s');

				$this->load->model('Comanda_model');
				$this->Comanda_model->pagarCom($clienteId, $pagamento, $metodo, $usuario, $comprador);

				$this->load->model('Pedidos_model');
				$this->Pedidos_model->pagComP($clienteId, $pagamento, $metodo, $usuario, $comprador);

				$this->load->model('Caixa_model');
				$caixaTotal 			= $this->Caixa_model->exibirInicial('');
				$countCaixa 			= $this->Caixa_model->contarResultados('');
				$contC 					= $countCaixa - 1; // hack exibir último resultado no BD
				$caixaInicial 			= $caixaTotal[$contC]->entrada;
				$caixaSaida 			= $caixaTotal[$contC]->saida;
				$data['caixaHoje'] 		= $caixaTotal[$contC]->abertura;
				$data['caixaAberto'] 	= $caixaTotal[$contC]->aberto;
				$data['caixaAtual'] 	= $caixaInicial - $caixaSaida;
				$ultID 					= $caixaTotal[$contC]->ID;
				$vendas 				= $caixaTotal[$contC]->total;
				$newVendas 				= $vendas + $recebido;
				$this->Caixa_model->vendasCaixa($ultID, $newVendas);

				/** INICIO FUNÇÃO CONTAR ESTOQUE alacID - cardID - bebID - pizzID **/

					$produtoID 			= $this->input->get("prodid");
					$produtoQTD 		= $this->input->get("prodqtd");
					$tabelaID 			= $this->input->get("tabelid");
					$clienteId 			= $this->input->get('clienteId');
									

					$this->load->model("Comanda_model");
					$contarPedidos  = $this->Comanda_model->contarVendasUser($clienteId);
					$exibeCliente 	= $this->Comanda_model->exibir($clienteId);
					$clienteId 		= $exibeCliente[0]->clienteID;



					$cont = count($contarPedidos) - 1;
					$newCont = 0;

					while ($newCont <= $cont) {

						$alacID 		= $exibeCliente[$newCont]->alacID;
						$cardID 		= $exibeCliente[$newCont]->cardID;
						$bebID 			= $exibeCliente[$newCont]->bebID;
						$pizzID 		= $exibeCliente[$newCont]->pizzID;
						$acomID 		= $exibeCliente[$newCont]->acomID;
						$alacQtd		= $exibeCliente[$newCont]->qntd;

						# INÍCIO DAS FUNÇÕES IF
							if($alacID == NULL) {
								
								if($cardID ==  NULL){

									if($bebID ==  NULL){

										if($pizzID == NULL){

											if($acomID == NULL){

											}else{
											//Função do Estoque de Acompanhamentos
												$ID 			= $acomID;									

												$this->load->model('Acompanhamentos_model');
												$abertura		= date('Y-m-d');
												$valorProduto 	= $this->Acompanhamentos_model->exibeRes($ID);
												$prodValor		= $valorProduto[0]->preco;
												$nome 			= $valorProduto[0]->titulo;			
												
												$alacValor		= $prodValor * $alacQtd;

												$qntd 	 		= $valorProduto[0]->qntd;
												$newQntd        = $qntd - $alacQtd;
												$alacId 		= $ID;


												
												$this->Acompanhamentos_model->atuaEstoque($alacId, $newQntd);
											// Fim do Estoque de Pizzas
											}

										}else{
											//Função do Estoque de Pizzas
												$ID 			= $pizzID;									

												$this->load->model('Pizzas_model');
												$abertura		= date('Y-m-d');
												$valorProduto 	= $this->Pizzas_model->exibeRes($ID);
												$prodValor		= $valorProduto[0]->preco;
												$nome 			= $valorProduto[0]->titulo;			
												
												$alacValor		= $prodValor * $alacQtd;

												$qntd 	 		= $valorProduto[0]->qntd;
												$newQntd        = $qntd - $alacQtd;
												$alacId 		= $ID;


												
												$this->Pizzas_model->atuaEstoque($alacId, $newQntd);
											// Fim do Estoque de Pizzas
										}

									}else{
										//Função do Estoque de Bebidas
											$ID 			= $bebID;											

											$this->load->model('Bebidas_model');
											$abertura		= date('Y-m-d');
											$valorProduto 	= $this->Bebidas_model->exibeRes($ID);
											$prodValor		= $valorProduto[0]->preco;
											$nome 			= $valorProduto[0]->titulo;			
										
											$alacValor		= $prodValor * $alacQtd;

											$qntd 	 		= $valorProduto[0]->qntd;
											$newQntd        = $qntd - $alacQtd;
											$alacId 		= $ID;

											
											$this->Bebidas_model->atuaEstoque($alacId, $newQntd);
										// Fim do Estoque de Bebidas
									}

								}else{
									//Função do Estoque de Lanches
												$ID 			= $cardID;
												

												$this->load->model('Cardapio_model');
												$abertura		= date('Y-m-d');
												$valorProduto 	= $this->Cardapio_model->exibeRes($ID);
												$prodValor		= $valorProduto[0]->preco;
												$nome 			= $valorProduto[0]->titulo;			
											
												$alacValor		= $prodValor * $alacQtd;

												$qntd 	 		= $valorProduto[0]->qntd;
												$newQntd        = $qntd - $alacQtd;
												$alacId 		= $ID;												
												$this->Cardapio_model->atuaEstoque($alacId, $newQntd);
									// Fim do Estoque de Lanches
								}

							}else{
								//Função do Estoque de Buffets
									$ID 			= $alacID;					

									$this->load->model('Alacarte_model');
									$abertura		= date('Y-m-d');
									$valorProduto 	= $this->Alacarte_model->exibeRes($ID);
									$prodValor		= $valorProduto[0]->preco;
									$nome 			= $valorProduto[0]->titulo;			
											
									$alacValor		= $prodValor * $alacQtd;

									$qntd 	 		= $valorProduto[0]->qntd;
									$newQntd        = $qntd - $alacQtd;
									$alacId 		= $ID;

									$this->Alacarte_model->atuaEstoque($alacId, $newQntd);

								// Fim do Estoque de Buffets
							}
						# FIM DAS FUNÇÕES IF
						$newCont++;
					}

				/** FIM DA FUNÇÃO CONTAR ESTOQUE **/


				/** INÍCIO GERAÇÃO DO TEXT DE IMPRESSÃO v.1.0 - VIA MOZILLA **/
					$this->load->model('Comanda_model');
						$pedidos 		= $this->Comanda_model->exibir($clienteId);
						$totalPedido	= $this->Comanda_model->somaValor($clienteId);
						$comanda 		= $this->Comanda_model->comandaExib($clienteId);

						$this->load->helper("funcoes");
						$somaT = implode("", $totalPedido[0]);
						$somaTotal = formata_preco($somaT);

						//var_dump($totalPedido);

						$fp = fopen("uploads/txt/codigo_".$clienteId.".txt", "a");
						$escreve = fwrite($fp, "RLX".$clienteId . "\n");
						fclose($fp);
						
						$fp = fopen("uploads/txt/cliente_".$clienteId.".txt", "a");
						$escreve = fwrite($fp, "Pedido \n");
							foreach ($comanda as $row) {
								
								$ExibeNome = $row->nome;
								$ExibeQntd = $row->qntd;
								$exibObs	= $row->observac;
								$ExibeValor = formata_preco($row->valor);
								
								$escreve = fwrite($fp, "Prod: ". $ExibeNome ." | ");
								$escreve = fwrite($fp, "Qntd:". $ExibeQntd. " \n ");
								$escreve = fwrite($fp, "Obs.: " .$exibObs. "\n");
								$escreve = fwrite($fp, "Valor R$ ". $ExibeValor. "\n ");
								$escreve = fwrite($fp, "\n");
									}
								$escreve =  fwrite($fp, "VALOR TOTAL: " .$somaTotal. "\n");
								$escreve =  fwrite($fp, "TELE-ENTREGA \n ");
							fclose($fp);

							$fp = fopen("uploads/txt/cozinha_".$clienteId.".txt", "a");
							$escreve = fwrite($fp, "PEDIDO RLX".$clienteId ."\n");
								foreach ($comanda as $row) {
									
									$ExibeNome = $row->nome;
									$ExibeQntd = $row->qntd;
									$exibObs	= $row->observac;
									$ExibeValor = formata_preco($row->valor);
									
									$escreve = fwrite($fp, "Prod: ". $ExibeNome ." | ");
									$escreve = fwrite($fp, "Qntd:". $ExibeQntd. " \n ");
									$escreve = fwrite($fp, "Obs.: " .$exibObs. "\n");
									
									$escreve = fwrite($fp, "\n");
										}
								fclose($fp);

						
				/** FIM DA GERAÇÃO DO TEXT DE IMPRESSÃO **/


				/** IMPRESSÃO - ATIVE  WEB ou SEM **/
					
					if($impressao == "sim"){
						//IMPRESSÃO ETHERNET EPSON
						redirect('administracao/imprimiCabe/'. $clienteId);
					}else{
						//SEM IMPRESSÃO PARA DEMONSTRAÇÃO
						redirect('administracao/alacarte/'.$clienteId);
					}
			}else{			

				redirect('login', 'refresh');
			}
		}

		function imprimiCabe($clienteId){
			$textoCabe = file_get_contents("uploads/txt/codigo_".$clienteId.".txt");
	  		$this->load->library('ReceiptPrint');
	  		$this->receiptprint->connect_2('USB');
	  		$this->receiptprint->print_cabecalho($textoCabe);  		
  		
	  		if ($this == TRUE) {

	  			redirect('administracao/imprimiComp/'.$clienteId);
	  		}
		}

		function imprimiComp($clienteId){
			$textoFinal = file_get_contents("uploads/txt/cliente_".$clienteId.".txt");
	  		$this->load->library('ReceiptPrint');
	  		$this->receiptprint->connect_2('USB');
	  		$this->receiptprint->print_via_cliente($textoFinal);  		
  		
	  		if ($this == TRUE) {

	  			redirect('administracao/imprimiCozinha/'.$clienteId);
			  }
			  
		}

		function imprimiCozinha($clienteId){
			$textoFinal = file_get_contents("uploads/txt/cozinha_".$clienteId.".txt");
	  		$this->load->library('ReceiptPrint');
	  		$this->receiptprint->connect_2('USB');
	  		$this->receiptprint->print_via_cozinha($textoFinal);  		
  		
	  		if ($this == TRUE) {

	  			redirect('administracao/alacarte/'.$clienteId);
			  }
			}

	#FIM FUNÇÃO PAGAMENTO

	function delItemCom(){

		if ($this->session->userdata('logged_in')) 
		{
			/* Produto Pronto */
			$clienteId 	= $this->input->get('clienteId');
			$idProduto 	= $this->input->get('iddoproduto');

			$this->load->model('Comanda_model');
			$this->Comanda_model->delItem($idProduto);

			if($this == true) {

				redirect('administracao/alacarte/'.$clienteId, 'refresh');
			}			

		}else{

			redirect('login', 'refresh');
		}
	}

	function prontoCom()
	{
		if ($this->session->userdata('logged_in')) 
		{
			/* Produto Pronto */
			$clienteId 	= $this->input->get('clienteId');
			$prodPronto = 1;
			$proHorario	= date('Y-m-d H:i:s');
			$this->load->model('Pedidos_model');
			$this->Pedidos_model->pronto($clienteId, $prodPronto, $proHorario);

			if (!$clienteId == NULL) {
				
				redirect('administracao/pedidos','refresh');

			} else {

				print_r("Erro, a variável está sendo passada NULL");
			}
			

		}else{

			redirect('login', 'refresh');
		}

	}
	function feConta()
	{
		if ($this->session->userdata('logged_in')) 
		{
			$clienteId 	= $this->input->post('clienteId');
			
			/* Carregando OS PEDIDOS VIA COMANDA MODEL */

			$this->load->model('Comanda_model'); // Comanda Model
			$this->Comanda_model->fechando($clienteId);
			$data['somaValor'] = $this->Comanda_model->somaValor($clienteId);


			$this->load->model('Pedidos_model');
			$this->Pedidos_model->deletarP($clienteId);

			
			redirect('administracao/pedidos','refresh');


		}else{

			redirect('login', 'refresh');
		}

	}
	/** INICIO FUNÇÃO IMPRESSÃO V 1.0 **/
		function verTicketTxt()
		{
			if ($this->session->userdata('logged_in')) 
				{
					
					// GERANDO O TXT Imprimível
					$clienteId = $this->input->get('clienteId');
					$data['clienteId'] = $clienteId;

					$this->load->view('segura/ticket_view', $data);
					
				}
				else
				{
					//Se não tiver Session, redireciona para LOGIN
				 	redirect('login', 'refresh');
				}
		}

		function verRelatTxt()
		{
			if ($this->session->userdata('logged_in')) 
				{
					
					// GERANDO O TXT Imprimível
					$dtrelat = date('dmY');
					$data['relatdata'] = $dtrelat;

					$this->load->view('segura/relat_view', $data);
					
				}
				else
				{
					//Se não tiver Session, redireciona para LOGIN
				 	redirect('login', 'refresh');
				}
		}

	/** FIM FUNÇÃO IMPRESSÃO **/

	/** INICIO FUNÇÃO ABRINDO NOVOS PEDIDOS **/
		function entrarALC()
		{
				$mesaID 	= 0;
				$mesaId 	= 0;
				$entrada 	= date('Y-m-d');
				$abertura	= date('Y-m-d');
				$hoje		= date('Y-m-d');
				$pedhora	= date('Y-m-d H:i:s');
				$proHorario	= date('Y-m-d H:i:s');
				$nome 		= 'Ticket Visitante';
				$qntd 		= 1;
				$pedidoID	= 0;

				$this->load->model('Checkin_model');
				$this->Checkin_model->inserir($mesaID, $entrada, $nome, $pedidoID);

				if ($this == TRUE) {
					
					$countIDs = $this->Checkin_model->countID('') - 1;
					$idComanda = $this->Checkin_model->exibe('');
					$NewCom = $idComanda[$countIDs]->ID;

					$clienteId 	= $NewCom;
					$clienteID 	= $clienteId;
					$confirmado = 1;

					$this->load->model('Pedidos_model');
					$this->Pedidos_model->inserir($clienteId, $mesaId, $hoje, $pedhora, $proHorario);

					$this->load->model('Comanda_model');
					$this->Comanda_model->insPedido($clienteID, $mesaID, $nome, $qntd, $confirmado, $abertura);

					

					if ($this == TRUE) {
						
						redirect('administracao/alacarte/'. $clienteID);
					}

				} else {


					print_r('ERRO!');
				}
		}

		function entrarPIZZA()
		{
				$mesaID 	= 0;
				$mesaId 	= 0;
				$entrada 	= date('Y-m-d');
				$abertura	= date('Y-m-d');
				$hoje 		= date('Y-m-d');
				$pedhora	= date('Y-m-d H:i:s');
				$proHorario	= date('Y-m-d H:i:s');
				$nome 		= 'Ticket Visitante';
				$qntd 		= 1;
				$pedidoID	= 0;

				$this->load->model('Checkin_model');
				$this->Checkin_model->inserir($mesaID, $entrada, $nome, $pedidoID);

				if ($this == TRUE) {
					
					$countIDs = $this->Checkin_model->countID('') - 1;
					$idComanda = $this->Checkin_model->exibe('');
					$NewCom = $idComanda[$countIDs]->ID;

					$clienteId 	= $NewCom;
					$clienteID 	= $clienteId;
					$confirmado = 1;

					$this->load->model('Pedidos_model');
					$this->Pedidos_model->inserir($clienteId, $mesaId, $hoje, $pedhora, $proHorario);

					$this->load->model('Comanda_model');
					$this->Comanda_model->insPedido($clienteID, $mesaID, $nome, $qntd, $confirmado, $abertura);

					

					if ($this == TRUE) {
						
						redirect('administracao/vendapizza/'. $clienteID);
					}

				} else {


					print_r('ERRO!');
				}
		}
	/** FIM DA FUNÇÃO ABRINDO NOVOS PEDIDOS **/

	/** INICIO FUNÇÃO DE VENDAS DE PRODUTOS **/

			# PAGINA DE VENDAS PIZZAS
			# Versão 1.0

				function vendapizza($clienteId)
				{
					if ($this->session->userdata('logged_in')) 
					{
						#Carregando Models Necesários
						
						$hoje = date('Y-m-d');
						$serialAtual = file_get_contents("uploads/txt/serial.txt");
						$session_data = $this->session->userdata('logged_in');
						$usuario 			= $session_data['username'];
						$username 			= $session_data['username'];
						$data['username'] 	= $session_data['username'];
						$data['userid']		= $session_data['ID'];
						$estabID = 1;

						$this->load->model('Estabelecimento_model');
						$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
						$data['nomeEmpresa'] = $estabelecimento[0]->nome;
						$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
						$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
						$data['endEmpresa'] = $estabelecimento[0]->endereco;
						$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
						$data['codeEmpresa'] = $estabelecimento[0]->codigo;
						$data['emailEmpresa'] = $estabelecimento[0]->email;
						$data['telEmpresa'] = $estabelecimento[0]->telefone;
						$data['serialEmpresa'] = $estabelecimento[0]->serial;
						$serialEmpresa = $estabelecimento[0]->serial;
						
						$this->load->model('Pedidos_model');
						$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

						$this->load->model('Cardapio_model');
						$data['cardapio'] 	= $this->Cardapio_model->exibir('');

						$this->load->model('Alacarte_model');
						$data['alacarte'] 	= $this->Alacarte_model->exibir('');

						$this->load->model('Pizzas_model');
						$data['pizzas'] 	= $this->Pizzas_model->exibir('');

						$this->load->model('Bebidas_model');
						$data['bebidas']	= $this->Bebidas_model->exibir('');

						$this->load->model('Layout_model');
						$data['layout']	= $this->Layout_model->exibir('');

						$this->load->model('Comanda_model');
						$exibeCliente = $this->Comanda_model->exibir($clienteId);
						$data['clienteID'] = $exibeCliente[0]->clienteID;
						$data['clienteId'] = $exibeCliente[0]->clienteID;

						$data['comanda'] 		= $this->Comanda_model->comandaExib($clienteId);
						$data['somaValor']		= $this->Comanda_model->somaValor($clienteId);

						$this->load->model('Usuario_model');
						$userList	= $this->Usuario_model->userAtivo($username);
						$data['usuarios'] = $userList[0]->funcao;
						$ID = $userList[0]->ID;

						if ($serialAtual == $serialEmpresa) {
							$this->load->view('segura/header/header_view', $data);
							$this->load->view('segura/admin/vend_pizz_view', $data);
							$this->load->view('segura/footer/footer_view', $data);
						}else{

							$this->load->view('segura/header/header_view', $data);
							$this->load->view('gestao/ative_view', $data);
							$this->load->view('segura/footer/footer_view', $data);
						}
					}else{
						//Se não tiver Session, redireciona para LOGIN
					 	redirect('login', 'refresh');
					}
				}

				function PizInsertTwo()
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$pizId 			= $this->input->get('prodid');
						$ID 			= $pizId;		
						$alacQtd		= $this->input->get('qntd');
						$abertura		= date('Y-m-d');
						$pizzaID 		= "";

						#FOR PARA ADD 2 PIZZAS
							for ($i=0; $i < count($pizId); $i++) {
									$pizzADD = 1;
					    			$pizzaID .= $pizId[$i] .",";
					    			$pId			= rtrim($pizzaID, ',');
					    			$alacId 		= $pizId[$i];
					    			$ID 			=	$alacId;
				    				$this->load->model('Pizzas_model');
					    			$valorProduto 	= $this->Pizzas_model->exibeRes($ID);
					    			$prodValor		= $valorProduto[0]->preco;
									$pNome 			= $valorProduto[0]->titulo;
									$alacValor		= $prodValor;
									$nPizza = $pNome . ",";
									$nome 	= rtrim($nPizza, ",");
									$this->load->model('Comanda_model');			
									$this->Comanda_model->pizAdd($clienteId, $mesaId, $nome, $alacId, $pizzADD, $alacValor, $alacQtd, $abertura);
							}
						#FIM DO FOR 2 PIZZAS

							$pizzADD 	= 1;
							$pizzFCH 	= 0;
							$pizzaQtd 	= 1;

							$this->load->model('Comanda_model');			
							$itens = $this->Comanda_model->exibPizzas($clienteId, $pizzADD);

							$pizza1 = $itens[0]->nome;
							$pizza2 = $itens[1]->nome;
						
							$pizzasSelec = $pizza1 . "," . $pizza2;

							$pizzaV1 = $itens[0]->valor;
							$pizzaV2 = $itens[1]->valor;

							$pizzasValores = $pizzaV1 ."". $pizzaV2;

							$piVal = str_split($pizzasValores, 4);

							$pizzasValor = max($piVal);
							
							$this->Comanda_model->pizAddTwo($clienteId, $mesaId, $pizzasSelec, $pizzFCH, $pizzasValor, $pizzaQtd, $abertura);

							//var_dump($pizzasValor);

						if($this == TRUE) {

							$this->Comanda_model->deleteOutras($clienteId, $pizzADD);

							if($this == TRUE) {

								redirect('administracao/vendapizza/'. $clienteId);
							}
						}
				}

				function PizInsertTree()
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$pizId 			= $this->input->get('prodid');
						$ID 			= $pizId;		
						$alacQtd		= $this->input->get('qntd');
						$abertura		= date('Y-m-d');
						$pizzaID 		= "";

							for ($i=0; $i < count($pizId) ; $i++) {
								$pizzADD = 1;
				    			$pizzaID .= $pizId[$i] .",";
				    			$pId			= rtrim($pizzaID, ',');
				    			$alacId 		= $pizId[$i];
				    			$ID 			=	$alacId;
				    				
				    				$this->load->model('Pizzas_model');
					    				$valorProduto 	= $this->Pizzas_model->exibeRes($ID);
					    				$prodValor		= $valorProduto[0]->preco;
										$pNome 			= $valorProduto[0]->titulo;
										$alacValor		= $prodValor;

										$nPizza = $pNome . ",";
										$nome 	= rtrim($nPizza, ",");

										$this->load->model('Comanda_model');
										
										$this->Comanda_model->pizAdd($clienteId, $mesaId, $nome, $alacId, $pizzADD, $alacValor, $alacQtd, $abertura);
							}

							$pizzADD 	= 1;
							$pizzFCH 	= 0;
							$pizzaQtd 	= 1;

							$this->load->model('Comanda_model');				
							$itens = $this->Comanda_model->exibPizzas($clienteId, $pizzADD);

							$pizza1 = $itens[0]->nome;
							$pizza2 = $itens[1]->nome;
							$pizza3 = $itens[2]->nome;

							$pizzasSelec = $pizza1 . "," . $pizza2 . "," . $pizza3;

							$pizzaV1 = $itens[0]->valor;
							$pizzaV2 = $itens[1]->valor;
							$pizzaV3 = $itens[2]->valor;

							$pizzasValores = $pizzaV1 ."". $pizzaV2 ."". $pizzaV3;

							$piVal = str_split($pizzasValores, 4);

							$pizzasValor = max($piVal);
							
							$this->Comanda_model->pizAddTwo($clienteId, $mesaId, $pizzasSelec, $pizzFCH, $pizzasValor, $pizzaQtd, $abertura);


						if($this == TRUE) {	

							$this->Comanda_model->deleteOutras($clienteId, $pizzADD);

							if($this == TRUE) {

								redirect('administracao/vendapizza/'. $clienteId);
							}
						}	
				}

			# PAGINA DE VENDAS PRODUTOS A LA CARTE
			# Versão 1.0

				function alacarte($clienteId)
				{
					if ($this->session->userdata('logged_in')) 
					{
						$hoje = date('Y-m-d');
						$serialAtual = file_get_contents("uploads/txt/serial.txt");
						$session_data = $this->session->userdata('logged_in');
						$usuario 			= $session_data['username'];
						$username 			= $session_data['username'];
						$data['username'] 	= $session_data['username'];
						$data['userid']		= $session_data['ID'];
						$estabID = 1;
						$this->load->model('Estabelecimento_model');
						$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
						$data['nomeEmpresa'] = $estabelecimento[0]->nome;
						$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
						$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
						$data['endEmpresa'] = $estabelecimento[0]->endereco;
						$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
						$data['codeEmpresa'] = $estabelecimento[0]->codigo;
						$data['emailEmpresa'] = $estabelecimento[0]->email;
						$data['telEmpresa'] = $estabelecimento[0]->telefone;
						$data['serialEmpresa'] = $estabelecimento[0]->serial;
						$serialEmpresa = $estabelecimento[0]->serial;
						

						#Carregando Models Necesários
						$this->load->model('Pedidos_model');
						$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

						$this->load->model('Cardapio_model');
						$data['cardapio'] 	= $this->Cardapio_model->exibir('');

						$this->load->model('Alacarte_model');
						$data['alacarte'] 	= $this->Alacarte_model->exibir('');

						$this->load->model('Pizzas_model');
						$data['pizzas'] 	= $this->Pizzas_model->exibir('');

						$this->load->model('Bebidas_model');
						$data['bebidas']	= $this->Bebidas_model->exibir('');

						$this->load->model('Acompanhamentos_model');
						$data['acompanhamentos']	= $this->Acompanhamentos_model->exibir('');

						$this->load->model('Layout_model');
						$data['layout']	= $this->Layout_model->exibir('');

						$this->load->model('Comanda_model');
						$exibeCliente = $this->Comanda_model->exibir($clienteId);
						$data['clienteID'] = $exibeCliente[0]->clienteID;
						$data['clienteId'] = $exibeCliente[0]->clienteID;

						$data['comanda'] 		= $this->Comanda_model->comandaExib($clienteId);
						$data['somaValor']		= $this->Comanda_model->somaValor($clienteId);

						$this->load->model('Usuario_model');
						$data['userLista'] = $this->Usuario_model->visualiza('');
						$userList	= $this->Usuario_model->userAtivo($username);
						$data['usuarios'] = $userList[0]->funcao;
						$ID = $userList[0]->ID;

						if ($serialAtual == $serialEmpresa) {

							$this->load->view('segura/header/header_view', $data);
							$this->load->view('segura/admin/alacarte_view', $data);
							$this->load->view('segura/footer/footer_view', $data);
						}else{

							$this->load->view('segura/header/header_view', $data);
							$this->load->view('gestao/ative_view', $data);
							$this->load->view('segura/footer/footer_view', $data);
						}
					}
					else
					{
						//Se não tiver Session, redireciona para LOGIN
					 	redirect('login', 'refresh');
					}
				}
			# PAGINA DE INSERÇÃO PRODUTOS ALACARTE
			# Versão 1.0
				function alacPedInsert($clienteId)
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$alacId 		= $this->input->get('prodid');
						$ID 			= $this->input->get('prodid');
					
						
						$this->load->model('Alacarte_model');
						$valorProduto 	= $this->Alacarte_model->exibeRes($ID);
						$alacQntd		= 1;
						$prodValor		= $valorProduto[0]->preco;
						$nome 			= $valorProduto[0]->titulo;			
						$alacPeso		= str_replace(",", ".", $this->input->get('peso'));

						$alacValor		= $prodValor * $alacPeso;
						$abertura	= date('Y-m-d');

						//print_r($prodValor);

						# var_dump($clienteId);
						$this->load->model('Comanda_model');
						$this->Comanda_model->pedAlac($clienteId, $mesaId, $nome, $alacId, $alacQntd, $alacValor, $alacPeso, $abertura);



						if ($this == TRUE) {

							redirect('administracao/alacarte/'. $clienteId);
						}
				}
			# PAGINA DE VENDAS PRODUTOS UNITÁRIOS
			# Versão 1.0
				function alacProInsert()
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$alacId 		= $this->input->get('prodid');
						$vendObs		= $this->input->get('obsv');
						$ID 			= $alacId;
						

						$this->load->model('Cardapio_model');
						$abertura		= date('Y-m-d');
						$valorProduto 	= $this->Cardapio_model->exibeRes($ID);
						$prodValor		= $valorProduto[0]->preco;
						$nome 			= $valorProduto[0]->titulo;			
						$alacQtd		= $this->input->get('qntd');
						$alacValor		= $prodValor * $alacQtd;

						$this->load->model('Comanda_model');
						$this->Comanda_model->proAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura);

						if ($this == TRUE) {

							redirect('administracao/alacarte/'. $clienteId);
						}
				}

			# PAGINA DE VENDAS BEBIDAS
			# Versão 1.0
				function alacBebInsert()
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$alacId 		= $this->input->get('prodid');
						$vendObs		= $this->input->get('obsv');
						$ID 			= $alacId;
						
						$this->load->model('Bebidas_model');
						$valorProduto 	= $this->Bebidas_model->exibeRes($ID);
						$prodValor		= $valorProduto[0]->preco;
						$nome 			= $valorProduto[0]->titulo;	
						$alacQtd		= $this->input->get('qntd');
						$alacValor		= $prodValor * $alacQtd;
						$abertura		= date('Y-m-d');

						$this->load->model('Comanda_model');
						$this->Comanda_model->bebAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura);

						if ($this == TRUE) {

						redirect('administracao/alacarte/'. $clienteId);
						}
				}

			# PAGINA DE VENDAS ACOMPANHAMENTOS
			# Versão 1.0
				function alacAcomInsert()
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$alacId 		= $this->input->get('prodid');
						$vendObs		= $this->input->get('obsv'); // TERMINAR OBSERVAÇÃO
						$ID 			= $alacId;
						
						$this->load->model('Acompanhamentos_model');
						$valorProduto 	= $this->Acompanhamentos_model->exibeRes($ID);
						$prodValor		= $valorProduto[0]->preco;
						$nome 			= $valorProduto[0]->titulo;	
						$alacQtd		= $this->input->get('qntd');
						$alacValor		= $prodValor * $alacQtd;
						$abertura		= date('Y-m-d');

						$this->load->model('Comanda_model');
						$this->Comanda_model->acomAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura);

						if ($this == TRUE) {

						redirect('administracao/alacarte/'. $clienteId);
						}
				}

			# PAGINA DE VENDAS PIZZAS
			# Versão 1.0
				function alacPizInsert()
				{
						$clienteId 		= $this->input->get('clienteId');
						$mesaId 		= 0;
						$alacId 		= $this->input->get('prodid');
						$vendObs		= $this->input->get('obsv');
						$ID 			= $alacId;
						

						$this->load->model('Pizzas_model');
						$valorProduto 	= $this->Pizzas_model->exibeRes($ID);
						$prodValor		= $valorProduto[0]->preco;
						$nome 			= $valorProduto[0]->titulo;			
						$alacQtd		= $this->input->get('qntd');
						$alacValor		= $prodValor * $alacQtd;
						$abertura		= date('Y-m-d');
						
						$this->load->model('Comanda_model');
						$this->Comanda_model->pizAlac($clienteId, $mesaId, $nome, $vendObs, $alacId, $alacValor, $alacQtd, $abertura);


						if($this == TRUE) {	
							
							redirect('administracao/alacarte/'. $clienteId);
						}		
				}

	/** FIM DA FUNÇÃO DE VENDAS DE PRODUTOS **/

	/** INICIO OUTROS DETALHES **/

		function pedidos()
		{
			if ($this->session->userdata('logged_in')) 
			{	
				$serialAtual = file_get_contents("uploads/txt/serial.txt");
				$session_data 		= $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				$data['serialEmpresa'] = $estabelecimento[0]->serial;
				$serialEmpresa = $estabelecimento[0]->serial;
				

				$this->load->model('Pedidos_model');
				$hoje = date('Y-m-d');				
		        $data['pedidos']	= $this->Pedidos_model->contePedidos($hoje);

		        $this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;

				if ($serialAtual == $serialEmpresa) {

					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/pedidos_view', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}else{

					$this->load->view('segura/header/header_view', $data);
					$this->load->view('gestao/ative_view', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}

			}else{ 

				redirect('login', 'refresh');
			}
		}

		function deletarP($ID)
		{
			if ($this->session->userdata('logged_in')) 
			{		
				$this->load->model('Pedidos_model');
				$this->Pedidos_model->deletar($ID);

				$this->load->model('Comanda_model');
				$this->Comanda_model->deletar($ID);

				redirect('administracao/pedidos');
			}else{ 

				redirect('login', 'refresh');
			}
		}

		function visualP($clienteId)
		{
			if ($this->session->userdata('logged_in')) 
			{
				/* Carregando OS PEDIDOS VIA COMANDA MODEL */
				$hoje = date('Y-m-d');
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				

				$this->load->model('Comanda_model'); // Comanda Model
				$data['pedcliente'] = $this->Comanda_model->exibir($clienteId);
				$data['somaValor']	= $this->Comanda_model->somaValor($clienteId);


				$this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;

				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
			
				
				$this->load->view('segura/header/header_view', $data);
				$this->load->view('segura/admin/pedido_view', $data);
				$this->load->view('segura/footer/footer_view', $data);


			}else{

				redirect('login', 'refresh');
			}
		}
	/** FIM DE OUTROS DETALHES **/

	/** INICIO  Colocando produtos no CARDÁPIO  **/
		/** INICIO DA FUNÇÃO PRODUTOS NO SMARTMENU **/
			# Versão 1.0
			function cardapio()
			{		
				if ($this->session->userdata('logged_in')) 
				{

					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
					$estabID = 1;
					$this->load->model('Estabelecimento_model');
					$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
					$data['nomeEmpresa'] = $estabelecimento[0]->nome;
					$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
					$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
					$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
					$data['codeEmpresa'] = $estabelecimento[0]->codigo;
					$data['emailEmpresa'] = $estabelecimento[0]->email;
					$data['telEmpresa'] = $estabelecimento[0]->telefone;
					

					
					$data['msg'] = 'Processando cadastro:  ';
					$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);
					
					//$data = array();
					$this->load->model('Cardapio_model');
					$data['pizzas'] = $this->Cardapio_model->exibir('');

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/cardapio_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

				} else {

					redirect('login', 'refresh');
				}			
			}
			function cardapio_form()
			{
				if ($this->session->userdata('logged_in')) 
				{	

					$this->load->helper("funcoes");
					$this->load->model('Cardapio_model');
					$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Pizza cadastrada!</div>';

					$titulo 	= $_REQUEST['titulo'];
					$descricao 	= $_REQUEST['descricao'];
					$preco		= str_replace(',', '', $_REQUEST['preco']);
					$qntd 		= $_REQUEST['qntd'];
					$custo		= str_replace(',', '', $_REQUEST['custo']);
					$estoque	= 0;
					$imagem		= 'AZ7_PADRAO';

					$this->load->model('Cardapio_model');
					$this->Cardapio_model->inserir($titulo, $descricao, $preco, $qntd, $custo, $estoque, $imagem);
					if ($this == false) {
						
						$data['msg'] = '<div class="alert alert-danger" ><b>ERRO!</b> Não foi possivel cadastrar!</div>';

					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


						$this->load->view('segura/header/header_view', $data);
						$this->load->view('segura/admin/cardapio_view', $data);
						$this->load->view('segura/footer/footer_view', $data);

					} else {

						$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];

						redirect ('administracao/cardapio');
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}
			function upimg_c()
			{
			        if ($this->session->userdata('logged_in')) 
					{	        
			                $dia = date('Ydm_his');
			                $nome = 'AZ7';

			                $config['upload_path']          = './uploads/';
			                $config['allowed_types']        = 'jpg';
			                $config['max_size']             = 1200;
			                $config['max_width']            = 2024;
			                $config['max_height']           = 1768;
			                $config['file_name']            = $nome.'_'.$dia;

			                $this->load->library('upload', $config);

			                if ( ! $this->upload->upimg_c('userfile'))
			                {
			                        $erros 					= array('error' => $this->upload->display_errors());
			                        $ID 					= $this->input->post('ID');
			                        $session_data = $this->session->userdata('logged_in');
									$data['link']			= base_url() . 'index.php/administracao/editarB/' . $ID;
									$this->load->model('Pedidos_model');
									$hoje = date('Y-m-d');
									$session_data = $this->session->userdata('logged_in');
									$data['username'] = $session_data['username'];
									$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

									$usuario 			= $session_data['username'];
									$username 			= $session_data['username'];
									$data['username'] 	= $session_data['username'];
									$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
									
									$this->load->model('Usuario_model');
									$userList	= $this->Usuario_model->userAtivo($username);
									$data['usuarios'] = $userList[0]->funcao;
									$ID = $userList[0]->ID;

									$estabID = 1;
									$this->load->model('Estabelecimento_model');
									$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
									$data['nomeEmpresa'] = $estabelecimento[0]->nome;
									$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
									$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
									$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
									$data['codeEmpresa'] = $estabelecimento[0]->codigo;
									$data['emailEmpresa'] = $estabelecimento[0]->email;
									$data['telEmpresa'] = $estabelecimento[0]->telefone;

			                        $this->load->view('segura/header/header_view', $data);
			                        $this->load->view('segura/upload_erro', $erros, $data );
			                        $this->load->view('segura/footer/footer_view', $data);
			                        
			                }
			                else
			                {	
			                	$ID	= $this->input->post('ID');

			                      if ($ID == NULL) {

			                      		$this->editar($this->input->post('ID'));
			                      		
			                      } else {


			                      		$imagem = $config['file_name'];
				                      	$this->load->model('Cardapio_model');
				                      	$this->Cardapio_model->atualizarI($ID, $imagem);

			                      			redirect('administracao/editar/'.$ID);
			                      }
			                      
			                }
			        }else{ 

						redirect('login', 'refresh');
					}
			}
			function editar($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$this->load->model('Cardapio_model', '', TRUE);		
			    	$data['dados_pizza'] = $this->Cardapio_model->editar($ID);
			    	$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

			 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/cardapio_edit', $data);
					$this->load->view('segura/footer/footer_view', $data);

				}else{ 

					redirect('login', 'refresh');
				}
			}
			function atualizar()
			{
				if ($this->session->userdata('logged_in')) 
				{

					/* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
					$this->load->library('form_validation');
			 
					/* Define as tags onde a mensagem de erro será exibida na página */
					$this->form_validation->set_error_delimiters('<span>', '</span>');
				 
					/* Aqui estou definindo as regras de validação do formulário, assim como 
					   na função inserir do controlador, porém estou mudando a forma de escrita */
					$validations = array(
						array(
							'field' => 'titulo',
							'label' => 'Titulo',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'preco',
							'label' => 'Preço',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'descricao',
							'label' => 'Descrição',
							'rules' => 'trim|required'
						)
					);
					$this->form_validation->set_rules($validations);
					
					/* Executa a validação... */
					if ($this->form_validation->run() === FALSE) {

						/* Caso houver erro chama função editar do controlador novamente */
						$this->editar($this->input->post('ID'));

					} else {
						/* Senão obtém os dados do formulário */
						$data['ID'] 		= $this->input->post('ID');
						$data['titulo'] 	= ucwords($this->input->post('titulo'));
						$data['preco'] 		= str_replace(',', '', $this->input->post('preco'));
						$data['qntd'] 		= $this->input->post('qntd');
						$data['custo'] 		= str_replace(',', '', $this->input->post('custo'));
						$data['descricao'] 	= $this->input->post('descricao');
				 
				 		/* Carrega o modelo */
						$this->load->model('Cardapio_model');
				 
						/* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
						if ($this->Cardapio_model->atualizar($data)) {
							/* Caso sucesso ao atualizar, recarrega a página principal */
							redirect('administracao/cardapio');
						} else {
							/* Senão exibe a mensagem de erro */
							log_message('error', 'Erro ao atualizar.');
						}
					}

				}else{ 

						redirect('login', 'refresh');
				}
			}
			function excluir($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					$this->load->model('Cardapio_model');
					$this->Cardapio_model->deletar($ID);	

					if ($this == false)
					{
						echo '<script type="text/javascript">alert("ERRO");</script>';
						redirect ('administracao/cardapio');
					} 
					else
					{
						echo '<script type="text/javascript">alert("DELETADO");</script>';
						redirect ('administracao/cardapio');
					}
				}else{ 

						redirect('login', 'refresh');
				}
			}
		/** FIM DA FUNÇÃO PRODUTOS NO SMARTMENU **/

		/** INICIO DA FUNÇÃO BUFFET NO SMARTMENU **/
			# Versão 1.0
			function buffet()
			{		
				if ($this->session->userdata('logged_in')) 
				{

					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$username = $session_data['username'];
					$data['msg'] = 'Processando cadastro:  ';
					$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');					
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);
					
					//$data = array();
					$this->load->model('Alacarte_model');
					$data['prato'] = $this->Alacarte_model->exibir('');

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/buffet_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

				} else {

					redirect('login', 'refresh');
				}			
			}

			function buffet_form()
			{
				if ($this->session->userdata('logged_in')) 
				{	

					$this->load->helper("funcoes");
					$this->load->model('Alacarte_model');
					$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Buffet Cadastrado!</div>';

					$titulo 	= $_REQUEST['titulo'];
					$descricao 	= $_REQUEST['descricao'];
					$preco		= str_replace(',', '', $_REQUEST['preco']);
					$qntd 		= $_REQUEST['qntd'];
					$imagem		= 'AZ7_PADRAO';

					$this->load->model('Alacarte_model');
					$this->Alacarte_model->inserir($titulo, $descricao, $preco, $qntd, $imagem);
					if ($this == false) {
						
						$data['msg'] = '<div class="alert alert-danger" ><b>ERRO!</b> Não foi possivel cadastrar!</div>';

						$session_data = $this->session->userdata('logged_in');
						$usuario 			= $session_data['username'];
						$username 			= $session_data['username'];
						$data['username'] 	= $session_data['username'];
						$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
						
						
						$this->load->model('Pedidos_model');
						$hoje = date('Y-m-d');
						$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

						$this->load->model('Usuario_model');
						$userList	= $this->Usuario_model->userAtivo($username);
						$data['usuarios'] = $userList[0]->funcao;
						$ID = $userList[0]->ID;

						$estabID = 1;
						$this->load->model('Estabelecimento_model');
						$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
						$data['nomeEmpresa'] = $estabelecimento[0]->nome;
						$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
						$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
						$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
						$data['codeEmpresa'] = $estabelecimento[0]->codigo;
						$data['emailEmpresa'] = $estabelecimento[0]->email;
						$data['telEmpresa'] = $estabelecimento[0]->telefone;

						$this->load->view('segura/header/header_view', $data);
						$this->load->view('segura/admin/buffet_view', $data);
						$this->load->view('segura/footer/footer_view', $data);

					} else {

						$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];

						redirect ('administracao/buffet');
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}

			function upimg_Bu()
			{
			        if ($this->session->userdata('logged_in')) 
					{	        
			                $dia = date('Ydm_his');
			                $nome = 'AZ7';

			                $config['upload_path']          = './uploads/';
			                $config['allowed_types']        = 'jpg';
			                $config['max_size']             = 1200;
			                $config['max_width']            = 2024;
			                $config['max_height']           = 1768;
			                $config['file_name']            = $nome.'_'.$dia;

			                $this->load->library('upload', $config);

			                if ( ! $this->upload->upimg_bu('userfile'))
			                {
			                        $erros 					= array('error' => $this->upload->display_errors());
			                        $ID 					= $this->input->post('ID');
			                        $session_data 			= $this->session->userdata('logged_in');
									$data['username'] 		= $session_data['username'];
									$data['link']			= base_url() . 'index.php/administracao/editarBu/' . $ID;
									$this->load->model('Pedidos_model');
									$hoje = date('Y-m-d');
									$session_data = $this->session->userdata('logged_in');
									$usuario 			= $session_data['username'];
									$username 			= $session_data['username'];
									$data['username'] 	= $session_data['username'];
									$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
									
									
									$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

									$this->load->model('Usuario_model');
									$userList	= $this->Usuario_model->userAtivo($username);
									$data['usuarios'] = $userList[0]->funcao;
									$ID = $userList[0]->ID;

									$estabID = 1;
									$this->load->model('Estabelecimento_model');
									$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
									$data['nomeEmpresa'] = $estabelecimento[0]->nome;
									$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
									$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
									$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
									$data['codeEmpresa'] = $estabelecimento[0]->codigo;
									$data['emailEmpresa'] = $estabelecimento[0]->email;
									$data['telEmpresa'] = $estabelecimento[0]->telefone;

			                        $this->load->view('segura/header/header_view', $data);
			                        $this->load->view('segura/upload_erro', $erros, $data );
			                        $this->load->view('segura/footer/footer_view', $data);
			                        
			                }
			                else
			                {	
			                	$ID	= $this->input->post('ID');

			                      if ($ID == NULL) {

			                      		$this->editar($this->input->post('ID'));
			                      		
			                      } else {


			                      		$imagem = $config['file_name'];
				                      	$this->load->model('Alacarte_model');
				                      	$this->Alacarte_model->atualizarI($ID, $imagem);

			                      			redirect('administracao/editarBu/'.$ID);
			                      }
			                      
			                }
			        }else{ 

						redirect('login', 'refresh');
					}
			}

			function editarBu($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					

					$this->load->model('Alacarte_model', '', TRUE);		
			    	$data['dados_prato'] = $this->Alacarte_model->editar($ID);
			    	$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

			 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/buffet_edit', $data);
					$this->load->view('segura/footer/footer_view', $data);

				}else{ 

					redirect('login', 'refresh');
				}
			}

			function atualizarBu()
			{
				if ($this->session->userdata('logged_in')) 
				{

					/* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
					$this->load->library('form_validation');
			 
					/* Define as tags onde a mensagem de erro será exibida na página */
					$this->form_validation->set_error_delimiters('<span>', '</span>');
				 
					/* Aqui estou definindo as regras de validação do formulário, assim como 
					   na função inserir do controlador, porém estou mudando a forma de escrita */
					$validations = array(
						array(
							'field' => 'titulo',
							'label' => 'Titulo',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'preco',
							'label' => 'Preço',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'descricao',
							'label' => 'Descrição',
							'rules' => 'trim|required'
						)
					);
					$this->form_validation->set_rules($validations);
					
					/* Executa a validação... */
					if ($this->form_validation->run() === FALSE) {

						/* Caso houver erro chama função editar do controlador novamente */
						$this->editar($this->input->post('ID'));

					} else {
						/* Senão obtém os dados do formulário */
						$data['ID'] 		= $this->input->post('ID');
						$data['titulo'] 	= ucwords($this->input->post('titulo'));
						$data['preco'] 		= str_replace(',', '', $this->input->post('preco'));
						$data['qntd'] 		= $this->input->post('qntd');
						$data['descricao'] 	= $this->input->post('descricao');
				 
				 		/* Carrega o modelo */
						$this->load->model('Alacarte_model');
				 
						/* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
						if ($this->Alacarte_model->atualizar($data)) {
							/* Caso sucesso ao atualizar, recarrega a página principal */
							redirect('administracao/buffet');
						} else {
							/* Senão exibe a mensagem de erro */
							log_message('error', 'Erro ao atualizar.');
						}
					}

				}else{ 

						redirect('login', 'refresh');
				}
			}
				
			function excluirBu($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

					$this->load->model('Alacarte_model');
					$this->Alacarte_model->deletar($ID);	

					if ($this == false)
					{
						echo '<script type="text/javascript">alert("ERRO");</script>';
						redirect ('administracao/buffet');
					} 
					else
					{
						echo '<script type="text/javascript">alert("DELETADO");</script>';
						redirect ('administracao/buffet');
					}
				}else{ 

						redirect('login', 'refresh');
				}
			}
		/** FIM DA FUNÇÃO BUFFET NO SMARTMENU **/

		/** INICIO DA FUNÇÃO BEBIDAS NO SMARTMENU **/
			# Versão 1.0
			function bebidas()
			{		
				if ($this->session->userdata('logged_in')) 
				{
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					$data['msg'] = 'Processando cadastro:  ';
					
					//$data = array();
					$this->load->model('Bebidas_model');
					$data['bebidas'] = $this->Bebidas_model->exibir('');
					$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/bebidas_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

				}else{ 

					redirect('login', 'refresh');
				}			
			}

			function bebidas_form()
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$this->load->helper("funcoes");
					$this->load->model('Bebidas_model');
					$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Bebida cadastrada!</div>';

					$titulo 	= $_REQUEST['titulo'];
					$descricao 	= $_REQUEST['descricao'];
					$preco		= str_replace(',', '', $_REQUEST['preco']);
					$qntd 		= $_REQUEST['qntd'];
					$custo		= str_replace(',', '', $_REQUEST['custo']);
					$imagem		= 'AZ7_PADRAO';

					$this->load->model('Bebidas_model');
					$this->Bebidas_model->inserir($titulo, $descricao, $preco, $qntd, $custo, $imagem);
					if ($this == false) {
						
						$data['msg'] = '<div class="alert alert-danger" ><b>ERRO!</b> Não foi possivel cadastrar!</div>';

						$session_data = $this->session->userdata('logged_in');
						$usuario 			= $session_data['username'];
						$username 			= $session_data['username'];
						$data['username'] 	= $session_data['username'];
						$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
						
						
						$this->load->model('Pedidos_model');
						$hoje = date('Y-m-d');
						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];
						$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

						$this->load->model('Usuario_model');
						$userList	= $this->Usuario_model->userAtivo($username);
						$data['usuarios'] = $userList[0]->funcao;
						$ID = $userList[0]->ID;

						$estabID = 1;
						$this->load->model('Estabelecimento_model');
						$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
						$data['nomeEmpresa'] = $estabelecimento[0]->nome;
						$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
						$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
						$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
						$data['codeEmpresa'] = $estabelecimento[0]->codigo;
						$data['emailEmpresa'] = $estabelecimento[0]->email;
						$data['telEmpresa'] = $estabelecimento[0]->telefone;

						$this->load->view('segura/header/header_view', $data);
						$this->load->view('segura/admin/bebidas_view', $data);
						$this->load->view('segura/footer/footer_view', $data);

					} else {

						$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];

						redirect ('administracao/bebidas');
					}
				}else{ 

						redirect('login', 'refresh');
				}
			}

			function upimg_b()
			{
			    if ($this->session->userdata('logged_in')) 
				{       
			                $dia = date('Ydm_his');
			                $nome = 'AZ7';

			                $config['upload_path']          = './uploads/';
			                $config['allowed_types']        = 'jpg';
			                $config['max_size']             = 1200;
			                $config['max_width']            = 2024;
			                $config['max_height']           = 1768;
			                $config['file_name']            = $nome.'_'.$dia;

			                $this->load->library('upload', $config);

			                if ( ! $this->upload->upimg_b('userfile'))
			                {
			                        $erros 					= array('error' => $this->upload->display_errors());
			                        $ID 					= $this->input->post('ID');
			                        $session_data 			= $this->session->userdata('logged_in');
									$data['username'] 		= $session_data['username'];
									$data['link']			= base_url() . 'index.php/administracao/editarB/' . $ID;
									$this->load->model('Pedidos_model');
									$hoje = date('Y-m-d');
									$session_data = $this->session->userdata('logged_in');
									$usuario 			= $session_data['username'];
									$username 			= $session_data['username'];
									$data['username'] 	= $session_data['username'];
									$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
									
									
									$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

									$this->load->model('Usuario_model');
									$userList	= $this->Usuario_model->userAtivo($username);
									$data['usuarios'] = $userList[0]->funcao;
									$ID = $userList[0]->ID;

									$estabID = 1;
									$this->load->model('Estabelecimento_model');
									$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
									$data['nomeEmpresa'] = $estabelecimento[0]->nome;
									$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
									$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
									$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
									$data['codeEmpresa'] = $estabelecimento[0]->codigo;
									$data['emailEmpresa'] = $estabelecimento[0]->email;
									$data['telEmpresa'] = $estabelecimento[0]->telefone;

			                        $this->load->view('segura/header/header_view', $data);
			                        $this->load->view('segura/upload_erro', $erros, $data );
			                        $this->load->view('segura/footer/footer_view', $data);
			                        
			                }
			                else
			                {	
			                	$ID	= $this->input->post('ID');

			                      if ($ID == NULL) {

			                      		$this->editar($this->input->post('ID'));
			                      		
			                      } else {


			                      		$imagem = $config['file_name'];
				                      	$this->load->model('Bebidas_model');
				                      	$this->Bebidas_model->atualizarI($ID, $imagem);

			                      			redirect('administracao/editarB/'.$ID);
			                      }
			                      
			                }
			    }else{ 

					redirect('login', 'refresh');
				}
			}


			function editarB($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					$this->load->model('Bebidas_model', '', TRUE);		
			    	$data['dados_bebidas'] = $this->Bebidas_model->editar($ID);
			    	$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

			 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/bebidas_edit', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}else{ 

					redirect('login', 'refresh');
				}
			}

			function atualizarB()
			{
				if ($this->session->userdata('logged_in')) 
				{

					/* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
					$this->load->library('form_validation');
				 
					/* Define as tags onde a mensagem de erro será exibida na página */
					$this->form_validation->set_error_delimiters('<span>', '</span>');
				 
					/* Aqui estou definindo as regras de validação do formulário, assim como 
					   na função inserir do controlador, porém estou mudando a forma de escrita */
					$validations = array(
						array(
							'field' => 'titulo',
							'label' => 'Titulo',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'preco',
							'label' => 'Preço',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'descricao',
							'label' => 'Descrição',
							'rules' => 'trim|required'
						)
					);
					$this->form_validation->set_rules($validations);
					
					/* Executa a validação... */
					if ($this->form_validation->run() === FALSE) {

						/* Caso houver erro chama função editar do controlador novamente */
						$this->editar($this->input->post('ID'));

					} else {
						/* Senão obtém os dados do formulário */
						$data['ID'] 		= $this->input->post('ID');
						$data['titulo'] 	= ucwords($this->input->post('titulo'));
						$data['preco'] 		= str_replace(',', '', $this->input->post('preco'));
						$data['qntd'] 		= $this->input->post('qntd');
						$data['custo'] 		= str_replace(',', '', $this->input->post('custo'));
						$data['descricao'] 	= ucwords($this->input->post('descricao'));
				 
				 		/* Carrega o modelo */
						$this->load->model('Bebidas_model');
				 
						/* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
						if ($this->Bebidas_model->atualizar($data)) {
							/* Caso sucesso ao atualizar, recarrega a página principal */
							redirect('administracao/bebidas');
						} else {
							/* Senão exibe a mensagem de erro */
							log_message('error', 'Erro ao atualizar.');
						}
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}
				
			function excluirB($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					$this->load->model('Bebidas_model');
					$this->Bebidas_model->deletar($ID);	

					if ($this == false)
					{
						echo '<script type="text/javascript">alert("ERRO");</script>';
						redirect ('administracao/bebidas');
					} 
					else
					{
						echo '<script type="text/javascript">alert("DELETADO");</script>';
						redirect ('administracao/bebidas');
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}
		/** FIM DA FUNÇÃO BEBIDAS NO SMARTMENU **/

		/** INICIO DA FUNÇÃO PIZZAS NO SMARTMENU **/
			function pizzas()
			{		
				if ($this->session->userdata('logged_in')) 
				{

					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$data['msg'] = 'Processando cadastro:  ';
					$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);


					
					//$data = array();
					$this->load->model('Pizzas_model');
					$data['pizzas'] = $this->Pizzas_model->exibir('');

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/pizza_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

				} else {

					redirect('login', 'refresh');
				}			
			}

			function pizzas_form()
			{
				if ($this->session->userdata('logged_in')) 
				{	

					$this->load->helper("funcoes");
					$this->load->model('Pizzas_model');
					$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Pizza cadastrada!</div>';

					$titulo 	= $_REQUEST['titulo'];
					$descricao 	= $_REQUEST['descricao'];
					$preco		= str_replace(',', '', $_REQUEST['preco']);
					$qntd 		= $_REQUEST['qntd'];
					$estoque	= 1;
					$imagem		= 'AZ7_PADRAO';

					$this->load->model('Pizzas_model');
					$this->Pizzas_model->inserir($titulo, $descricao, $preco, $qntd, $estoque, $imagem);
					if ($this == false) {
						
						$data['msg'] = '<div class="alert alert-danger" ><b>ERRO!</b> Não foi possivel cadastrar!</div>';

						$session_data = $this->session->userdata('logged_in');
						$usuario 			= $session_data['username'];
						$username 			= $session_data['username'];
						$data['username'] 	= $session_data['username'];
						$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
						
					
						$this->load->model('Pedidos_model');
						$hoje = date('Y-m-d');
					
						$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

						$this->load->model('Usuario_model');
						$userList	= $this->Usuario_model->userAtivo($username);
						$data['usuarios'] = $userList[0]->funcao;
						$ID = $userList[0]->ID;

						$estabID = 1;
						$this->load->model('Estabelecimento_model');
						$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
						$data['nomeEmpresa'] = $estabelecimento[0]->nome;
						$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
						$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
						$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
						$data['codeEmpresa'] = $estabelecimento[0]->codigo;
						$data['emailEmpresa'] = $estabelecimento[0]->email;
						$data['telEmpresa'] = $estabelecimento[0]->telefone;

						$this->load->view('segura/header/header_view', $data);
						$this->load->view('segura/admin/pizza_view', $data);
						$this->load->view('segura/footer/footer_view', $data);

					} else {

						$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];

						redirect ('administracao/pizzas');
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}

			function upimg_piz()
			{
			        if ($this->session->userdata('logged_in')) 
					{	        
			                $dia = date('Ydm_his');
			                $nome = 'AZ7';

			                $config['upload_path']          = './uploads/';
			                $config['allowed_types']        = 'jpg';
			                $config['max_size']             = 1200;
			                $config['max_width']            = 2024;
			                $config['max_height']           = 1768;
			                $config['file_name']            = $nome.'_'.$dia;

			                $this->load->library('upload', $config);

			                if ( ! $this->upload->upimg_piz('userfile'))
			                {
			                        $erros 					= array('error' => $this->upload->display_errors());
			                        $ID 					= $this->input->post('ID');
			                        $session_data 			= $this->session->userdata('logged_in');
									$data['username'] 		= $session_data['username'];
									$data['link']			= base_url() . 'index.php/administracao/editarPiz/' . $ID;
									$this->load->model('Pedidos_model');
									$hoje = date('Y-m-d');
									$session_data = $this->session->userdata('logged_in');
									$usuario 			= $session_data['username'];
									$username 			= $session_data['username'];
									$data['username'] 	= $session_data['username'];
									$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
									
									
									$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

									$this->load->model('Usuario_model');
									$userList	= $this->Usuario_model->userAtivo($username);
									$data['usuarios'] = $userList[0]->funcao;
									$ID = $userList[0]->ID;

									$estabID = 1;
									$this->load->model('Estabelecimento_model');
									$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
									$data['nomeEmpresa'] = $estabelecimento[0]->nome;
									$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
									$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
									$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
									$data['codeEmpresa'] = $estabelecimento[0]->codigo;
									$data['emailEmpresa'] = $estabelecimento[0]->email;
									$data['telEmpresa'] = $estabelecimento[0]->telefone;

			                        $this->load->view('segura/header/header_view', $data);
			                        $this->load->view('segura/upload_erro', $erros, $data );
			                        $this->load->view('segura/footer/footer_view', $data);
			                        
			                }
			                else
			                {	
			                	$ID	= $this->input->post('ID');

			                      if ($ID == NULL) {

			                      		$this->editar($this->input->post('ID'));
			                      		
			                      } else {


			                      		$imagem = $config['file_name'];
				                      	$this->load->model('Pizzas_model');
				                      	$this->Pizzas_model->atualizarI($ID, $imagem);

			                      			redirect('administracao/editarPiz/'.$ID);
			                      }
			                      
			                }
			        }else{ 

						redirect('login', 'refresh');
					}
			}

			function editarPiz($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					

					$this->load->model('Pizzas_model', '', TRUE);		
			    	$data['dados_pizza'] = $this->Pizzas_model->editar($ID);
			    	$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

			 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/pizza_edit', $data);
					$this->load->view('segura/footer/footer_view', $data);

				}else{ 

					redirect('login', 'refresh');
				}
			}

			function atualizarPiz()
			{
				if ($this->session->userdata('logged_in')) 
				{

					/* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
					$this->load->library('form_validation');
			 
					/* Define as tags onde a mensagem de erro será exibida na página */
					$this->form_validation->set_error_delimiters('<span>', '</span>');
				 
					/* Aqui estou definindo as regras de validação do formulário, assim como 
					   na função inserir do controlador, porém estou mudando a forma de escrita */
					$validations = array(
						array(
							'field' => 'titulo',
							'label' => 'Titulo',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'preco',
							'label' => 'Preço',
							'rules' => 'trim|required'
						)
					);
					$this->form_validation->set_rules($validations);
					
					/* Executa a validação... */
					if ($this->form_validation->run() === FALSE) {

						/* Caso houver erro chama função editar do controlador novamente */
						$this->editar($this->input->post('ID'));

					} else {
						/* Senão obtém os dados do formulário */
						$data['ID'] 		= $this->input->post('ID');
						$data['titulo'] 	= ucwords($this->input->post('titulo'));
						$data['preco'] 		= str_replace(',', '', $this->input->post('preco'));
						$data['qntd'] 		= $this->input->post('qntd');
						$data['descricao'] 	= $this->input->post('descricao');
				 
				 		/* Carrega o modelo */
						$this->load->model('Pizzas_model');
				 
						/* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
						if ($this->Pizzas_model->atualizar($data)) {
							/* Caso sucesso ao atualizar, recarrega a página principal */
							redirect('administracao/pizzas');

						} else {
							/* Senão exibe a mensagem de erro */
							log_message('error', 'Erro ao atualizar.');
						}
					}

				}else{ 

						redirect('login', 'refresh');
				}
			}
				
			function excluirPiz($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					$this->load->model('Pizzas_model');
					$this->Pizzas_model->deletar($ID);	

					if ($this == false)
					{
						echo '<script type="text/javascript">alert("ERRO");</script>';
						redirect ('administracao/pizzas');
					} 
					else
					{
						echo '<script type="text/javascript">alert("DELETADO");</script>';
						redirect ('administracao/pizzas');
					}
				}else{ 

						redirect('login', 'refresh');
				}
			}
		/** FIM FUNÇÃO PIZZAS **/

		/** INICIO DA FUNÇÃO ACOMPANHAMENTOS NO SMARTMENU **/
			# Versão 1.0
			function acompanhamentos()
			{		
				if ($this->session->userdata('logged_in')) 
				{
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$data['msg'] = 'Processando cadastro:  ';
					
					//$data = array();
					$this->load->model('Acompanhamentos_model');
					$data['acompanhamentos'] = $this->Acompanhamentos_model->exibir('');
					$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/acompanhamentos_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

				}else{ 

					redirect('login', 'refresh');
				}			
			}

			function acompanhamentos_form()
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$this->load->helper("funcoes");
					$this->load->model('Acompanhamentos_model');
					$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Acompanhamento Cadastrado</div>';

					$titulo 	= $_REQUEST['titulo'];
					$descricao 	= $_REQUEST['descricao'];
					$preco		= str_replace(',', '', $_REQUEST['preco']);
					$qntd 		= $_REQUEST['qntd'];

					$this->load->model('Acompanhamentos_model');
					$this->Acompanhamentos_model->inserir($titulo, $descricao, $preco, $qntd);
					if ($this == false) {
						
						$data['msg'] = '<div class="alert alert-danger" ><b>ERRO!</b> Não foi possivel cadastrar!</div>';

						$session_data = $this->session->userdata('logged_in');
						$usuario 			= $session_data['username'];
						$username 			= $session_data['username'];
						$data['username'] 	= $session_data['username'];
						$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
						

						$hoje = date('Y-m-d');
						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];
						$this->load->model('Usuario_model');
						$userList	= $this->Usuario_model->userAtivo($username);
						$data['usuarios'] = $userList[0]->funcao;
						$ID = $userList[0]->ID;
						
						$this->load->model('Pedidos_model');
						$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

						$estabID = 1;
						$this->load->model('Estabelecimento_model');
						$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
						$data['nomeEmpresa'] = $estabelecimento[0]->nome;
						$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
						$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
						$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
						$data['codeEmpresa'] = $estabelecimento[0]->codigo;
						$data['emailEmpresa'] = $estabelecimento[0]->email;
						$data['telEmpresa'] = $estabelecimento[0]->telefone;

						$this->load->view('segura/header/header_view', $data);
						$this->load->view('segura/admin/acompanhamentos_view', $data);
						$this->load->view('segura/footer/footer_view', $data);

					} else {

						$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];

						redirect ('administracao/acompanhamentos');
					}
				}else{ 

						redirect('login', 'refresh');
				}
			}


			function editarAc($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					

					$hoje = date('Y-m-d');

					$this->load->model('Acompanhamentos_model', '', TRUE);		
			    	$data['dados_bebidas'] = $this->Acompanhamentos_model->editar($ID);

			    	$this->load->model('Pedidos_model');
			    	$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);
					
					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

			 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/acompanhamentos_edit', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}else{ 

					redirect('login', 'refresh');
				}
			}

			function atualizarAc()
			{
				if ($this->session->userdata('logged_in')) 
				{

					/* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
					$this->load->library('form_validation');
				 
					/* Define as tags onde a mensagem de erro será exibida na página */
					$this->form_validation->set_error_delimiters('<span>', '</span>');
				 
					/* Aqui estou definindo as regras de validação do formulário, assim como 
					   na função inserir do controlador, porém estou mudando a forma de escrita */
					$validations = array(
						array(
							'field' => 'titulo',
							'label' => 'Titulo',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'preco',
							'label' => 'Preço',
							'rules' => 'trim|required'
						),
						array(
							'field' => 'descricao',
							'label' => 'Descrição',
							'rules' => 'trim|required'
						)
					);
					$this->form_validation->set_rules($validations);
					
					/* Executa a validação... */
					if ($this->form_validation->run() === FALSE) {

						/* Caso houver erro chama função editar do controlador novamente */
						$this->editar($this->input->post('ID'));

					} else {
						/* Senão obtém os dados do formulário */
						$data['ID'] 		= $this->input->post('ID');
						$data['titulo'] 	= ucwords($this->input->post('titulo'));
						$data['preco'] 		= str_replace(',', '', $this->input->post('preco'));
						$data['qntd'] 		= $this->input->post('qntd');
						$data['descricao'] 	= ucwords($this->input->post('descricao'));
				 
				 		/* Carrega o modelo */
						$this->load->model('Acompanhamentos_model');
				 
						/* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
						if ($this->Acompanhamentos_model->atualizar($data)) {
							/* Caso sucesso ao atualizar, recarrega a página principal */
							redirect('administracao/acompanhamentos');
						} else {
							/* Senão exibe a mensagem de erro */
							log_message('error', 'Erro ao atualizar.');
						}
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}
				
			function excluirAc($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					$this->load->model('Acompanhamentos_model');
					$this->Acompanhamentos_model->deletar($ID);	

					if ($this == false)
					{
						echo '<script type="text/javascript">alert("ERRO");</script>';
						redirect ('administracao/acompanhamentos');
					} 
					else
					{
						echo '<script type="text/javascript">alert("DELETADO");</script>';
						redirect ('administracao/acompanhamentos');
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}

		/** FIM DA FUNÇÃO ACOMPANHAMENTOS NO SMARTMENU **/

	/** FIM Colocando produtos no CARDÁPIO  **/

	/** INICIO FUNÇÃO CAIXA E GESTÃO **/
		function caixa()
		{
			
			if ($this->session->userdata('logged_in')) 
			{
				
				$serialAtual = file_get_contents("uploads/txt/serial.txt");
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				$data['serialEmpresa'] = $estabelecimento[0]->serial;
				$serialEmpresa = $estabelecimento[0]->serial;

				$countUser 			= $data['userid'] - 1;

				$pago 	= 1;
				$hoje 	= date('Y-m-d');
				$aberto = 1;
				$metdin = 'dinheiro';

				$this->load->model('Produtos_model');
				$data['produtos'] = $this->Produtos_model->exibir('');

				$this->load->model('Pedidos_model');
				$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

				$this->load->model('Comanda_model');
				$data['contvendas'] = $this->Comanda_model->conteVendas($pago, $hoje);
				$data['contvdin'] = $this->Comanda_model->conteVDin($pago, $hoje, $metdin);

				$this->load->model('Layout_model');
				$data['layout']	= $this->Layout_model->exibir('');

				$this->load->model('Usuario_model');
				$data['userLista'] = $this->Usuario_model->visualiza('');
				$userList	= $this->Usuario_model->userAtivo($username);				
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;


			/** Inicio Funções do Caixa **/
				$this->load->model('Caixa_model');
				$caixaTotal 		= $this->Caixa_model->exibirInicial('');
				$countCaixa			= $this->Caixa_model->contarResultados('');
				$contC 				= $countCaixa - 1; // hack exibir último resultado no BD
				$caixaInicial 		= $caixaTotal[$contC]->entrada;
				$caixaSaida 		= $caixaTotal[$contC]->saida;
				$caixaVendas 		= $caixaTotal[$contC]->total;
				$data['caixaHoje'] 	= $caixaTotal[$contC]->abertura;
				$data['caixaAberto']= $caixaTotal[$contC]->aberto;
				$data['caixaAtual'] = ($caixaInicial - $caixaSaida) + $caixaVendas;
			/** Fim das Funções do Caixa **/
				
				if ($serialAtual == $serialEmpresa) {
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/caixa/caixa_view', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}else{

					$this->load->view('segura/header/header_view', $data);
					$this->load->view('gestao/ative_view', $data);
					$this->load->view('segura/footer/footer_view', $data);
				}
			}
			else
			{
				//Se não tiver Session, redireciona para LOGIN
			 	redirect('login', 'refresh');
			}
		}

		function abreCaixa()
		{
			$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
					
					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;


					$dataHoje		= date('Y-m-d');
					$aberto			= 1;			
					


			$this->load->model('Caixa_model');
			$caixaVendas 	= $caixaTotal[$contC]->total;
			$entrada 		= $caixaVendas; 
			$this->Caixa_model->abrirCaixa($dataHoje, $aberto, $usuario, $entrada);

			if ($this ==  TRUE) {
				
				redirect('administracao/caixa/');
			}
		}
		
		function entraCaixa()
		{
			$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];

					$dataHoje		= date('Y-m-d');
					$aberto			= 1;
					$newEntrada 	= str_replace(',', '', $this->input->get('entrada'));

			$this->load->model('Caixa_model');
				$caixaTotal = $this->Caixa_model->exibirInicial('');
				$countCaixa = $this->Caixa_model->contarResultados('');
				$contC = $countCaixa - 1; // hack exibir último resultado no BD
				$atualEntrada 	= $caixaTotal[$contC]->entrada;
				$ultID 		= $caixaTotal[$contC]->ID;
			
			$entrada = $atualEntrada + $newEntrada; 


			$this->load->model('Caixa_model');
			$this->Caixa_model->entradaCaixa($ultID, $entrada);

			$this->load->model('Usuario_model');
			$userList	= $this->Usuario_model->userAtivo($username);
			$data['usuarios'] = $userList[0]->funcao;
			$ID = $userList[0]->ID;

			if ($this ==  TRUE) {
				
				redirect('administracao/caixa/');
			}
		}
		
		function saidaCaixa()
		{
			$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
					
					

			$dataHoje		= date('Y-m-d');
			$saida_1 		= str_replace(',', '', $this->input->get('retirada'));

			$this->load->model('Caixa_model');
				$caixaTotal = $this->Caixa_model->exibirInicial('');
				$countCaixa = $this->Caixa_model->contarResultados('');
				$contC 		= $countCaixa - 1; // hack exibir último resultado no BD
				$ultID 		= $caixaTotal[$contC]->ID;
				$saida_2 	= $caixaTotal[$contC]->saida;

				$retirada = $saida_1 + $saida_2;


			$this->load->model('Caixa_model');
			$this->Caixa_model->retiradaCaixa($ultID, $retirada);

			$this->load->model('Usuario_model');
			$userList	= $this->Usuario_model->userAtivo($username);
			$data['usuarios'] = $userList[0]->funcao;
			$ID = $userList[0]->ID;

			if ($this ==  TRUE) {
				
				redirect('administracao/caixa/');
			}
		}

		function fecharCaixa()
		{
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
			
			$dataHoje		= date('Y-m-d');
			$aberto			= 0;

			$this->load->model('Caixa_model');
				$caixaTotal = $this->Caixa_model->exibirInicial('');
				$countCaixa = $this->Caixa_model->contarResultados('');
				$contC 		= $countCaixa - 1; // hack exibir último resultado no BD
				$ultID 		= $caixaTotal[$contC]->ID;

			$this->load->model('Caixa_model');
			$this->Caixa_model->fechandoCaixa($ultID, $aberto);

			if ($this ==  TRUE) {
				
				redirect('administracao/caixa/');
			}
		}

	/** FIM DA FUNÇÃO CAIXA E GESTÃO **/

	/** INICIO DA FUNÇÃO USUARIOS **/
		function addUser()
		{
			$usuario = $this->input->get('username');
			$funcao = $this->input->get('funcao');
			$nome = $this->input->get('nome');
			$email = $this->input->get('email');
			$getSenha = $this->input->get('senha');
			$senha = md5($getSenha);

			$this->load->model('Usuario_model');
			$this->Usuario_model->cadastro($usuario, $nome, $email, $senha, $funcao);

			if ($this == TRUE) {
				
				redirect('administracao/caixa','refresh');
			}

		}

		function editarUser($ID)
		{
			$serialAtual = file_get_contents("uploads/txt/serial.txt");
			$session_data = $this->session->userdata('logged_in');
			$usuario 			= $session_data['username'];
			$username 			= $session_data['username'];
			$data['username'] 	= $session_data['username'];
			$data['userid']		= $session_data['ID'];

			$estabID = 1;
			$this->load->model('Estabelecimento_model');
			$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
			$data['nomeEmpresa'] = $estabelecimento[0]->nome;
			$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
			$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
			$data['endEmpresa'] = $estabelecimento[0]->endereco;
			$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
			$data['codeEmpresa'] = $estabelecimento[0]->codigo;
			$data['emailEmpresa'] = $estabelecimento[0]->email;
			$data['telEmpresa'] = $estabelecimento[0]->telefone;
			$data['serialEmpresa'] = $estabelecimento[0]->serial;
			$serialEmpresa = $estabelecimento[0]->serial;			

			$pago 	= 1;
			$hoje 	= date('Y-m-d');
			$aberto = 1;
			$metdin = 'dinheiro';

			$this->load->model('Pedidos_model');
			$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

			$this->load->model('Comanda_model');
			$data['contvendas'] = $this->Comanda_model->conteVendas($pago, $hoje);
			$data['contvdin'] = $this->Comanda_model->conteVDin($pago, $hoje, $metdin);

			$this->load->model('Layout_model');
			$data['layout']	= $this->Layout_model->exibir('');

			$this->load->model('Usuario_model', '', TRUE);
			$data['usuario'] 	= $this->Usuario_model->editar($ID);
			$userList			= $this->Usuario_model->userAtivo($username);
			$data['usuarios'] 	= $userList[0]->funcao;				
			

			
			$this->load->view('segura/header/header_view', $data);
			$this->load->view('segura/caixa/user_view', $data);
			$this->load->view('segura/footer/footer_view', $data);
		}

		function atualizarUser()
		{
			$session_data = $this->session->userdata('logged_in');
			$usuario 			= $session_data['username'];
			$username 			= $session_data['username'];
			$data['username'] 	= $session_data['username'];
			$data['userid']		= $session_data['ID'];

			$ID = $this->input->get('ID');
			$nome = $this->input->get('nome');
			$email = $this->input->get('email');
			$senha = md5($this->input->get('senha'));
			$funcao = $this->input->get('funcao');

			$this->load->model('Usuario_model');
			$this->Usuario_model->atualiza($ID, $nome, $email, $senha, $funcao);

			if ($this == TRUE) {
					
				redirect('administracao/caixa', 'refresh');
			}
		}

		function deleteUser($ID)
		{
			$session_data = $this->session->userdata('logged_in');
			$usuario 			= $session_data['username'];
			$username 			= $session_data['username'];
			$data['username'] 	= $session_data['username'];
			$data['userid']		= $session_data['ID'];

			$this->load->model('Usuario_model');
			$this->Usuario_model->delete($ID);

			if ($this == TRUE) {
					
				redirect('administracao/caixa', 'refresh');
			}
		}
	/** FIM DA FUNÇÃO USUÁRIOS **/

	/** INICIO DA FUNÇÃO ESTOQUE **/

			function produtos_form()
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$this->load->helper("funcoes");
					$this->load->model('Produtos_model');
					$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Bebida cadastrada!</div>';

					$titulo 	= $_REQUEST['titulo'];
					$preco		= str_replace(',', '', $_REQUEST['preco']);
					$qntd 		= $_REQUEST['qntd'];
					

					$this->load->model('Produtos_model');
					$this->Produtos_model->inserir($titulo, $preco, $qntd);
					if ($this == TRUE) {
						
						$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

						$session_data = $this->session->userdata('logged_in');
						$data['username'] = $session_data['username'];

						redirect ('administracao/caixa');

					} else {

						redirect ('administracao/caixa');
					}
				}else{ 

						redirect('login', 'refresh');
				}
			}

			function editarProduto($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$serialAtual = file_get_contents("uploads/txt/serial.txt");
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
					$estabID = 1;
					$this->load->model('Estabelecimento_model');
					$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
					$data['nomeEmpresa'] = $estabelecimento[0]->nome;
					$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
					$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
					$data['endEmpresa'] = $estabelecimento[0]->endereco;
					$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
					$data['codeEmpresa'] = $estabelecimento[0]->codigo;
					$data['emailEmpresa'] = $estabelecimento[0]->email;
					$data['telEmpresa'] = $estabelecimento[0]->telefone;
					$data['serialEmpresa'] = $estabelecimento[0]->serial;
					$serialEmpresa = $estabelecimento[0]->serial;
					

					$this->load->model('Produtos_model', '', TRUE);		
			    	$data['dados_bebidas'] = $this->Produtos_model->editar($ID);

			    	$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');					
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

			 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/caixa/produto_edit', $data);
					$this->load->view('segura/footer/footer_view', $data);

				}else{ 

					redirect('login', 'refresh');
				}
			}

			function atualizandoProduto()
			{
				if ($this->session->userdata('logged_in')) {
					
					$data['ID'] 		= $this->input->post('ID');
					$data['titulo'] 	= ucwords($this->input->post('titulo'));
					$data['preco'] 		= str_replace(',', '', $this->input->post('preco'));
					$data['qntd'] 		= $this->input->post('qntd');
				 
					$this->load->model('Produtos_model');
					
					if ($this->Produtos_model->atualizar($data)) {
						redirect('administracao/caixa');
					} else {
							
						redirect('administracao/editarProduto'. $data['ID']);
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}
				
			function excluirProdutos($ID)
			{
				if ($this->session->userdata('logged_in')) 
				{	
					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					$this->load->model('Produtos_model');
					$this->Produtos_model->deletar($ID);	

					if ($this == false)
					{
						echo '<script type="text/javascript">alert("ERRO");</script>';
						redirect ('administracao/bebidas');
					} 
					else
					{
						echo '<script type="text/javascript">alert("DELETADO");</script>';
						redirect ('administracao/bebidas');
					}
				}else{ 

					redirect('login', 'refresh');
				}
			}
	/** FIM DA FUNÇÃO ESTOQUE **/

	/** INICIO FUNÇÃO PUBLICIDADE **/

		function publicidade()
		{		
			if ($this->session->userdata('logged_in')) 
			{
				$hoje = date('Y-m-d');
					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$data['msg'] = 'Processando cadastro:  ';
					$this->load->model('Pedidos_model');
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);
				
				//$data = array();
				$this->load->model('Publicidade_model');
				$data['publicidade'] = $this->Publicidade_model->exibir('');

				$this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;

				$this->load->view('segura/header/header_view', $data);
				$this->load->view('segura/publicidade_view', $data);
				$this->load->view('segura/footer/footer_view', $data);

			} else {

				redirect('login', 'refresh');
			}			
		}

		function pubForm()
		{
			if ($this->session->userdata('logged_in')) 
			{	

				$this->load->helper("funcoes");
				$this->load->model('Cardapio_model');
				$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Pizza cadastrada!</div>';

				$descricao 	= $this->input->post('descricao');
				$link 		= $this->input->post('link');
				$imagem		= 'AZ7_PADRAO';

				$this->load->model('Publicidade_model');
				$this->Publicidade_model->inserir($descricao, $link, $imagem);
				if ($this == false) {
					
					$data['msg'] = '<div class="alert alert-danger" ><b>ERRO!</b> Não foi possivel cadastrar!</div>';

					$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$hoje = date('Y-m-d');
					$this->load->model('Pedidos_model');
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

					$this->load->model('Publicidade_model');
					$data['publicidade'] = $this->Publicidade_model->exibir('');

					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/admin/publicidade_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

				} else {

					$data['msg'] = '<div class="alert alert-success"><b>Feito!</b> Cadastrado</a></div>';

					$session_data = $this->session->userdata('logged_in');
					$data['username'] = $session_data['username'];

					redirect ('administracao/publicidade');
				}
			}else{ 

				redirect('login', 'refresh');
			}
		}

		function up_publicidade()
		{
		    if ($this->session->userdata('logged_in')) 
			{       
		                $diames = date('Ydm_his');
		                $nome 	= 'logo_'.$diames;

		                $config['upload_path']          = './uploads/publicidade/';
		                $config['allowed_types']        = 'png';
		                $config['max_size']             = 1200;
		                $config['max_width']            = 2024;
		                $config['max_height']           = 1768;
		                $config['file_name']            = $nome;
		                $config['overwrite'] 			= TRUE;

		                $this->load->library('upload', $config);

		                if ( ! $this->upload->up_publicidade('userfile'))
		                {
		                        $erros 					= array('error' => $this->upload->display_errors());
		                        $ID 					= $this->input->post('ID');
		                        $session_data 			= $this->session->userdata('logged_in');
								$data['username'] 		= $session_data['username'];
								$data['link']			= base_url() . 'index.php/administracao/editarPublicidade/' . $ID;
								$this->load->model('Pedidos_model');
								$hoje = date('Y-m-d');
								$session_data = $this->session->userdata('logged_in');
								$usuario 			= $session_data['username'];
								$username 			= $session_data['username'];
								$data['username'] 	= $session_data['username'];
								$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
								

								$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

								$this->load->model('Usuario_model');
								$userList	= $this->Usuario_model->userAtivo($username);
								$data['usuarios'] = $userList[0]->funcao;
								$ID = $userList[0]->ID;

		                        $this->load->view('segura/header/header_view', $data);
		                        $this->load->view('segura/upload_erro', $erros, $data );
		                        $this->load->view('segura/footer/footer_view', $data);
		                        
		                }
		                else
		                {	
		                	$ID	= $this->input->post('ID');

		                      if ($ID == NULL) {

		                      		$this->editar($this->input->post('ID'));
		                      		
		                      } else {


		                      		$imagem = $config['file_name'];
			                      	$this->load->model('Publicidade_model');
			                      	$this->Publicidade_model->atualizarI($ID, $imagem);

		                      			redirect('administracao/editarPublicidade/'.$ID);
		                      }
		                      
		                }
		    }else{ 

				redirect('login', 'refresh');
			}
		}

		function editarPublicidade($ID)
		{
			if ($this->session->userdata('logged_in')) 
			{	
				$session_data = $this->session->userdata('logged_in');
					$usuario 			= $session_data['username'];
					$username 			= $session_data['username'];
					$data['username'] 	= $session_data['username'];
					$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
					
					
					$this->load->model('Publicidade_model', '', TRUE);		
			    	$data['publicidade'] = $this->Publicidade_model->editar($ID);
			    	$this->load->model('Pedidos_model');
					$hoje = date('Y-m-d');
					$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);
				
					$this->load->model('Usuario_model');
					$userList	= $this->Usuario_model->userAtivo($username);
					$data['usuarios'] = $userList[0]->funcao;
					$ID = $userList[0]->ID;

		 
					$this->load->view('segura/header/header_view', $data);
					$this->load->view('segura/editarpub_view', $data);
					$this->load->view('segura/footer/footer_view', $data);

			}else{ 

				redirect('login', 'refresh');
			}
		}

		function atualizarPub()
		{
			if ($this->session->userdata('logged_in')) 
			{
					/* Obtendo Dados do Formulário */
					$data['ID'] 		= $this->input->post('ID');
					$data['descricao'] 	= $this->input->post('descricao');
					$data['link'] 		= $this->input->post('link');
			 
			 		/* Carrega o modelo */
					$this->load->model('Publicidade_model');
			 
					/* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
					if ($this->Publicidade_model->atualizar($data)) {
						/* Caso sucesso ao atualizar, recarrega a página principal */
						redirect('administracao/publicidade');
					} else {
						/* Senão exibe a mensagem de erro */
						log_message('error', 'Erro ao atualizar.');
					}
			}else{ 

					redirect('login', 'refresh');
			}
		}

		function excluirPub($ID)
		{
			if ($this->session->userdata('logged_in')) 
			{	
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				
					
				$this->load->model('Publicidade_model');
				$this->Publicidade_model->deletar($ID);

				$this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;


				if ($this == false)
				{
					echo '<script type="text/javascript">alert("ERRO");</script>';
					redirect ('administracao/cardapio');
				} 
				else
				{
					echo '<script type="text/javascript">alert("DELETADO");</script>';
					redirect ('administracao/cardapio');
				}
			}else{ 

					redirect('login', 'refresh');
			}
		}
	/** FIM DA FUNÇÃO PUBLICIDADE **/
			
	/** INICIO DA FUNÇÃO MESAS **/
		function mesas() 
		{
			if ($this->session->userdata('logged_in')) 
			{
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];
				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				

				$img_qr = base_url().'includes/uploads/teste.png';
				$data['imagem'] = $img_qr;

				$this->load->model('Mesas_model');
				$data['mesa'] = $this->Mesas_model->exibir('');

				$this->load->model('Pedidos_model');
				$hoje = date('Y-m-d');
				$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);

				$this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;


				$this->load->view('segura/header/header_view', $data);
				$this->load->view('segura/admin/mesas_view', $data);
				$this->load->view('segura/footer/footer_view', $data);
			}else{ 

			redirect('login', 'refresh');
			}	
		}

		function mesas_form()
		{
			if ($this->session->userdata('logged_in')) 
			{		
				$this->load->model('Mesas_model');
				$data['sucesso'] = '<div class="alert alert-success" role="alert" style="display:none;"><b>Sucesso!</b> Mesas Cadastradas!</div>';

				$qtdmesas 	= $_REQUEST['qtdmesas'];
				$mesa 		= $_REQUEST['mesa'];

					for ($i=0; $i < $qtdmesas ; $i++) { 
						
						$this->load->model('Mesas_model');
						$this->Mesas_model->inserir($mesa++);
					}

				redirect('administracao/gerar_qr');
			}else{ 

				redirect('login', 'refresh');
			}
		}
		
		function gerar_qr()
		{
			if ($this->session->userdata('logged_in')) 
			{		
				$this->load->library('ciqrcode');
				$this->load->model('Mesas_model');
				$contemesas = $this->Mesas_model->contMesas();
				
				for($i = 1; $i <= $contemesas; $i++){
				
					$id_mesa = $i;

					$params['data'] = site_url() .'?ID='.$id_mesa;
					$params['level'] = 'H';
					$params['size'] = 10;
					$params['savename'] = FCPATH.'includes/uploads/cdqr/mesa'.$id_mesa.'.png';

					$this->ciqrcode->generate($params);

					$data = $params['savename'];

				}

				redirect('administracao/mesas', 'refresh');

			}else{ 

				redirect('login', 'refresh');
			}
		}
	/** FIM DA FUNÇÃO MESAS **/

	/** INICIO FUNÇÃO DE RELATÓRIOS v. 1.0 */
		function relatorio()
		{
			if ($this->session->userdata('logged_in')) 
			{
				$serialAtual = file_get_contents("uploads/txt/serial.txt");
				$session_data = $this->session->userdata('logged_in');
				$usuario 			= $session_data['username'];
				$username 			= $session_data['username'];
				$data['username'] 	= $session_data['username'];
				$data['userid']		= $session_data['ID'];

				$estabID = 1;
				$this->load->model('Estabelecimento_model');
				$estabelecimento = $this->Estabelecimento_model->exibir($estabID);
				$data['nomeEmpresa'] = $estabelecimento[0]->nome;
				$data['slogamEmpresa'] = $estabelecimento[0]->slogam;
				$data['mensEmpresa'] = $estabelecimento[0]->mensagem;
				$data['endEmpresa'] = $estabelecimento[0]->endereco;
				$data['cnpjEmpresa'] = $estabelecimento[0]->cnpj;
				$data['codeEmpresa'] = $estabelecimento[0]->codigo;
				$data['emailEmpresa'] = $estabelecimento[0]->email;
				$data['telEmpresa'] = $estabelecimento[0]->telefone;
				$data['serialEmpresa'] = $estabelecimento[0]->serial;
				$serialEmpresa = $estabelecimento[0]->serial;
				
				
				$this->load->model('Pedidos_model');
				$hoje = date('Y-m-d');					
				$data['contpedi']	= $this->Pedidos_model->contePedidos($hoje);
				$data['contTotal']	= $this->Pedidos_model->contePedidos($hoje);

				$pago 		= 1;
				$hoje 		=	date('Y-m-d');
				$metdin 	= 'dinheiro';
				$metVisa 	= 'visa';
				$metCred 	= 'mastercard';
				$metBanr 	= 'banricompras';


				$this->load->model('Comanda_model');
				$data['contvendas'] 	= $this->Comanda_model->conteVendas($pago, $hoje);
				$data['contvdin'] 		= $this->Comanda_model->conteVDin($pago, $hoje, $metdin);


				$this->load->model('Layout_model');
				$data['layout']	= $this->Layout_model->exibir('');

				$this->load->model('Usuario_model');
				$userList	= $this->Usuario_model->userAtivo($username);
				$data['usuarios'] = $userList[0]->funcao;
				$ID = $userList[0]->ID;

				$this->load->model('Relatorio_model');
				$totalEmVendas			= $this->Relatorio_model->conteVendasTotais($pago);
				$data['contVenTot'] 	= (implode("", $totalEmVendas[0]));
				$data['contMetDinh'] 	= $this->Relatorio_model->conteVDin($pago, $hoje, $metdin);
				$data['contMetCred']	= $this->Relatorio_model->conteVCred($pago, $hoje, $metCred);
				$data['contMetVisa']	= $this->Relatorio_model->conteVVisa($pago, $hoje, $metVisa);
				$data['contMetBanr']	= $this->Relatorio_model->conteVBanr($pago, $hoje, $metBanr);
				$contUser 				= $this->Relatorio_model->contarUsuarios();
				$contarUserSistema 		= $this->Relatorio_model->listarUsuarios('');
				$fechado 				= 1;
				$user 					= 0;
				$maximo 				= $contUser - 1;				
				$data['vendasHoje'] 	= $this->Relatorio_model->totalProdHoje($pago, $hoje);
				$totalVendido 			= $this->Relatorio_model->visProdVen($pago, $hoje);
				$data['qntdTotais'] 	= $this->Relatorio_model->visProdQntd($pago, $hoje);
				$vendas 				= 0;
				$numVendas 				= count($totalVendido);
				$contVendProd 			= $numVendas - 1;//hack

				while ( $vendas <= $contVendProd) {
					
					$vendasTotais = $totalVendido[$vendas];

					$vendas++;
				}

				$data['vendasProdT'] 	= $this->Relatorio_model->verProdVend('');
				$vendasProdT 			= $data['vendasProdT'];
				$data['vendasUsuario']	= $this->Relatorio_model->visualizaCaixa('');

				//GERANDO TXT RELATORIO
					$dtrelat = date('dmY');
					$diaHora = date('d-m-Y h:i:s');
					$vendasTot = (implode(" ", $data['contvendas'][0]));
					$cartTotal = (implode(" ", $data['contvendas'][0])) - (implode(" ", $data['contvdin'][0]));
					$dinhTotal = (implode(" ", $data['contvdin'][0]));

					$fp = fopen("uploads/txt/relatorioCab_" .$dtrelat.".txt" , "a");
					$escreve = fwrite($fp, "Relatório do Dia: " . $diaHora ."\n");
					fclose($fp);

					$fp = fopen("uploads/txt/relatorio_".$dtrelat.".txt", "a");				
					$escreve =  fwrite($fp, "Hora do Fechamento: ". $diaHora ."\n");
					$this->load->helper("funcoes");
					$escreve =  fwrite($fp, "TOTAL RECEBIDO: R$ " .formata_preco($vendasTot). "\n");

					$vendasHojeR	= $this->Relatorio_model->totalProdHoje($pago, $hoje);
					$numTickets 	= $vendasProdT[0]->Qtd;
					$ticketMedio 	= $vendasTot / $numTickets;
					$totalVendidoR 	= $this->Relatorio_model->visProdVen($pago, $hoje);
					$qntdTotaisR 	= $this->Relatorio_model->visProdQntd($pago, $hoje);
					$escreve = fwrite($fp,"Produtos \n");

					foreach ($vendasProdT as $row) {

						$escreve =  fwrite($fp, "".  $row->nome ."\n");
						$escreve =  fwrite($fp, "".  $row->Qtd ."\n");
					}
					$this->load->helper("funcoes");

					$escreve = fwrite($fp,"Ticket Médio: R$ ". formata_preco($ticketMedio) . "\n");
					$escreve = fwrite($fp,"Total em Dinheiro: R$ ". formata_preco($dinhTotal) . "\n");
					$escreve = fwrite($fp,"Total em Cartões: R$ ". formata_preco($cartTotal) . "\n");
					$escreve = fwrite($fp,"Total em Vendas: R$ ". formata_preco($vendasTot) . "\n");
					
					fclose($fp);
				//FIM GERANDO TXT RELATORIO
					$data['ticketMedioE'] = $ticketMedio;

				$this->load->view('segura/header/header_view', $data);
				$this->load->view('segura/relatorio_view', $data);
				$this->load->view('segura/footer/footer_view', $data);
			}
			else //Se não estiver logado, redireciona para LOGIN
			{
				
			 	redirect('login', 'refresh');
			}
		}

		public function imprimiCabRelatorio(){

			$dtrelat = date('dmY');
			$textoFinal = file_get_contents("uploads/txt/relatorioCab_".$dtrelat.".txt");
	  		$this->load->library('ReceiptPrint');
	  		$this->receiptprint->connect_2('USB');
	  		$this->receiptprint->print_cab_relat($textoFinal);  		
  		
	  		if ($this == TRUE) {

	  			redirect('administracao/imprimiRelatorio');
	  		}
		}

		public function imprimiRelatorio(){

			$dtrelat = date('dmY');
			$textoFinal = file_get_contents("uploads/txt/relatorio_".$dtrelat.".txt");
	  		$this->load->library('ReceiptPrint');
	  		$this->receiptprint->connect_2('USB');
	  		$this->receiptprint->print_relatorio($textoFinal);  		
  		
	  		if ($this == TRUE) {

	  			redirect('administracao');
	  		}
		}
	/** FIM FUNÇÃO DE RELATÓRIOS v. 1.0 */
	
	/** INICIO FUNÇÃO VISUALIZAÇÃO AUTOMÁTICA DE PRODUTOS PRONTOS **/
		function pool()
		{
			$this->load->model('Pedidos_model');
			$data['contpedi'] = $this->Pedidos_model->contarPedidos();

				echo $data['contpedi'];
		}
	/** FIM DA FUNÇÃO VISUALIZAÇÃO AUTOMÁTICA DE PRODUTOS PRONTOS **/
	
}
/* End of file administracao.php */
/* Location: ./application/controllers/administracao.php */