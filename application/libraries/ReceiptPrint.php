<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// IMPORTANT - Replace the following line with your path to the escpos-php autoload script

require_once __DIR__ . '..\..\vendor\autoload.php';

//use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;

class ReceiptPrint {

    private $CI;
    private $connector;
    private $printer;
    // TODO: printer settings
    // Make this configurable by printer (32 or 48 probably)
    private $printer_width = 32;

    function __construct()
    {
      $this->CI =& get_instance(); // This allows you to call models or other CI objects with $this->CI->... 
    }

    function connect($ip_address, $port)
    {
      $this->connector = new NetworkPrintConnector($ip_address, $port);
      $this->printer = new Printer($this->connector);
    }

    function connect_2($file)
    {
      $this->connector = new WindowsPrintConnector($file);
      $this->printer = new Printer($this->connector);
    }

    private function check_connection()
    {
      if (!$this->connector OR !$this->printer OR !is_a($this->printer, 'Mike42\Escpos\Printer')) {
        throw new Exception("Tried to create receipt without being connected to a printer.");
      }
    }
    public function close_after_exception()
    {
      if (isset($this->printer) && is_a($this->printer, 'Mike42\Escpos\Printer')) {
        $this->printer->close();
      }
      $this->connector = null;
      $this->printer = null;
      $this->emc_printer = null;
    }
    // Calls printer->text and adds new line
    private function add_line($text = "", $should_wordwrap = true)
    {
      $text = $should_wordwrap ? wordwrap($text, $this->printer_width) : $text;
      $this->printer->text($text."\n");
    }

     public function print_cabecalho($textCab = "")
    {
          $this->check_connection();
          $this->printer->setJustification(Printer::JUSTIFY_CENTER);
          $img_logo = EscposImage::load(__DIR__.'\logo.png', false);
          $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
          $this->printer->graphics($img_logo);
          $this->add_line(); // blank line
          $this->add_line("ROLE LANCHES 3274-8072");
          $this->printer->selectPrintMode();
          $this->add_line("Rua Evaristo de Souza, 681 - Col. Z3 - Pelotas/RS - CNPJ 17.254.945/0001-32");
          $this->add_line(); // blank line
          $this->add_line("TICKET NÃO FISCAL");
          $this->add_line(); // blank line
          $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
          $this->add_line($textCab);
          $this->printer->selectPrintMode();
          $this->add_line(date('Y-m-d H:i:s'));
          $this->printer->close();
    }

     public function print_cab_relat($textCab = "")
    {
          $this->check_connection();
          $this->printer->setJustification(Printer::JUSTIFY_CENTER);
          $img_logo = EscposImage::load(__DIR__.'\logo.png', false);
          
          $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
          $this->printer->graphics($img_logo);
          $this->add_line("RELATÓRIO DIA");
          $this->add_line(); // blank line
          $this->printer->selectPrintMode();
          $this->add_line(date('Y-m-d H:i:s'));
          $this->printer->close();
    }

    public function print_via_cliente($text = "")
    {
          $this->check_connection();
          $this->printer->setJustification(Printer::JUSTIFY_CENTER);
          $this->printer->selectPrintMode();
          $this->add_line(); // blank line
          $this->add_line($text);
          $this->add_line(); // blank line
          $this->add_line("10 Tickets valem 1 X-Tudo");
          $this->add_line(); // blank line
          $this->add_line(">>>> ATENÇÃO <<<<");
          $this->add_line("SORTEIO ESPECIAL 22 DEZEMBRO");
          $this->add_line("2 Fardos de Skol + 1 Torta de Morangos + 100 Salgados Variados");
          $this->add_line("Peça também pelo WhatsApp 98108-5010");
          $this->add_line(); // blank line
          $this->add_line("Obrigado pela preferência! Boa Sorte!");
          $this->add_line(); // blank line'1    
          $this->printer->cut();
          $this->printer->close();
    }

    public function print_relatorio($text = "")
    {
          $this->check_connection();
          $this->printer->setJustification(Printer::JUSTIFY_CENTER);
          $this->printer->selectPrintMode();
          $this->add_line(); // blank line
          $this->add_line($text);
          $this->add_line(); // blank line
          $this->printer->cut();
          $this->printer->close();
    }

    public function print_via_cozinha($textCoz = "")
    {
      $this->check_connection();
      $this->printer->setJustification(Printer::JUSTIFY_CENTER);
      $this->add_line("VIA DA COZINHA");
      $this->add_line(date('Y-m-d H:i:s'));
      $this->printer->selectPrintMode();
      $this->add_line(); // blank line
      $this->add_line($textCoz);
      $this->add_line(); // blank line
      $this->printer->cut(Printer::CUT_PARTIAL);
      $this->printer->close();
    }

    public function print_via_caixa($textCaix = "")
    {
      $this->check_connection();
      $this->printer->setJustification(Printer::JUSTIFY_CENTER);
      $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $this->add_line("TESTING");
      $this->add_line("Receipt Print");
      $this->printer->selectPrintMode();
      $this->add_line(); // blank line
      $this->add_line($textCaix);
      $this->add_line(); // blank line
      $this->add_line(date('Y-m-d H:i:s'));
      $this->printer->cut(Printer::CUT_PARTIAL);
      $this->printer->close();
    }
}