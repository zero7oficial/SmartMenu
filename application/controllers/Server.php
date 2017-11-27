<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends CI_Controller{

	/**
	*  	PIZZARIA EXPRESSO AGENCIA07
	* 
	*	Sistema para Apresentação do Cardápio de Pizzarias Expresso e Padrão 
	*	Desenvolvido para facilitar a apresentação do cardápio online. Em todas as plataformas.
	*
	* @package		Pizzaria Expresso - Server
	* @version  	1.0
	* @author   	Agência07
	* @copyright 	Copyright (c) 2015, Agência Zero7 LTDA
	* @link 		http://pizzaria.agencia07.com.br/
	*
	*
	*/

    function __construct(){
        parent::__construct();
    }
    
    public function index(){

        error_reporting(E_ALL);
        set_time_limit(0);
        ob_implicit_flush();    
        
        $master = $this->WebSocket("0.0.0.0", 12345);
        $sockets = array($master);
        $users   = array();
        $debug   = false;
        
        while(true){
          $changed = $sockets;

          socket_select($changed,$write=NULL,$except=NULL,NULL);

          foreach($changed as $socket){

            if($socket==$master){

              $client=socket_accept($master);

              if($client<0){ console("socket_accept() failed"); continue; }
              else{ $this->connect($client); }
            }
            else{
              $bytes = @socket_recv($socket,$buffer,2048,0);
              if($bytes==0){ $this->disconnect($socket); }//
              else{
              	
                $user = $this->getuserbysocket($socket);//

                if(!$user->handshake){ $this->dohandshake($user, $buffer); }//
                else{ $this->process($user, $buffer); }//
              }
            }
          }
        }
    }
    
    function process($user,$msg){
       
    }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */