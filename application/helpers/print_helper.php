<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	/**
	 * 
	 * HELPER DE IMPRESSÃO
	 * 
	 * @version 1.0
	 * @author Rodrigo Franz
	 * @package Helper de Impressão em uma Epson
	 * 
	 * 
	 * 
	 */ 
	require_once __DIR__ . '..\..\vendor\autoload.php';
	use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
	use Mike42\Escpos\PrintConnectors\FilePrintConnector;
	use Mike42\Escpos\Printer;

	function connect($ip_address, $port)
  {
    $this->connector = new NetworkPrintConnector($ip_address, $port);
    $this->printer = new Printer($this->connector);
  }

  function check_connection()
  {
    if (!$this->connector OR !$this->printer OR !is_a($this->printer, 'Mike42\Escpos\Printer')) {
      throw new Exception("Tried to create receipt without being connected to a printer.");
    }
  }
  function close_after_exception()
  {
    if (isset($this->printer) && is_a($this->printer, 'Mike42\Escpos\Printer')) {
      $this->printer->close();
    }
    $this->connector = null;
    $this->printer = null;
    $this->emc_printer = null;
  }
  // Calls printer->text and adds new line
  function add_line($text = "", $should_wordwrap = true)
  {
    $text = $should_wordwrap ? wordwrap($text, $this->printer_width) : $text;
    $this->printer->text($text."\n");
  }
  
  function print_test_receipt($text = "")
  {
    $this->check_connection();
    $this->printer->setJustification(Printer::JUSTIFY_CENTER);
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->add_line("TESTING");
    $this->add_line("Receipt Print");
    $this->printer->selectPrintMode();
    $this->add_line(); // blank line
    $this->add_line($text);
    $this->add_line(); // blank line
    $this->add_line(date('Y-m-d H:i:s'));
    $this->printer->cut(Printer::CUT_PARTIAL);
    $this->add_line();
    $this->add_line($textCozinha);
    $this->add_line();
    $this->printer->cut(Printer::CUT_PARTIAL);
    $this->add_line();
    $this->add_line($textCaixa);
    $this->add_line();
    $this->printer->cut(Printer::CUT_PARTIAL);
    $this->printer->close();
  }
	
/* End of file print_helper.php */