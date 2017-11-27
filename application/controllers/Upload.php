<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

        /**
        *       MENFIS - MENU FISCAL - ZERO7
        * 
        *       Sistema para gestão de praças de alimentação em eventos. 
        *       Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
        *       Sistema de Pedido Pronto para exibição em TV, SMART TVS E PAINEIS DE LED
        *
        * @package              MENFIS 
        * @version      1.0
        * @author       Agência Zero7
        * @copyright    Copyright (c) 2017, Agência Zero7 - 17.254.945/0001-32
        * @link                 http://menfis.agencia07.com.br/
        *
        *
        */

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('segura/imagem_up', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $data = date('Ydm_his');
                $nome = 'AZ7';

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 500;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $config['file_name']            = $nome.'_'.$data;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('segura/upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('segura/upload_success', $data);
                }
        }
}
/* End of file imagem.php */
/* Location: ./application/controllers/imagem.php */