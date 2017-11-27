<!DOCTYPE html>
<html lang="pt-br">
<?php 

    /**
    *   MENFIS - MENU FISCAL - ZERO7
    * 
    *   Sistema para gestão de praças de alimentação em eventos. 
    *   Cardápio virtual, para fazer pedidos nas mesas, multiplataforma.
    *   Sistema de Pedido Pronto para exibição em TV, SMART TVS E PAINEIS DE LED
    *
    * @package      MENFIS 
    * @version      1.0
    * @author       Agência Zero7
    * @copyright    Copyright (c) 2017, Agência Zero7 - 17.254.945/0001-32
    * @link         http://menfis.agencia07.com.br/
    *
    *
    */
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Painel de Controle - Pizzarias">
        <meta name="author" content="Agência07 - Tecnologia Brasileira">

        <title>Painel de Controle</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/font-awesome/css/font-awesome.min.css">

        <script type="text/javascript" src="<?php echo base_url(); ?>includes/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>includes/js/bootstrap.min.js"></script>

         <!-- JS STYLOS -->
         <style type="text/css" media="screen">

            #notificacao{
                background: #800000;
            }

            #loading{
                color: #800000;
            }
             
         </style>


        <!-- JS STYLOS -->
        <script type="text/javascript">
        (function($)
            {
                $(document).ready(function()
                {
                    $.ajaxSetup(
                    {
                        cache: false,
                        beforeSend: function() {
                            $('#notificacao').hide();
                            $('#loading').show();
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#notificacao').show();
                        },
                        success: function() {
                            $('#loading').hide();
                            $('#notificacao').show();
                        }
                    });
                    var $container = $("#notificacao");
                    var carurl = '<?php echo base_url() ?>index.php/administracao/pool';
                        $container.load(carurl);
                    var refreshId = setInterval(function()
                    {
                        $container.load(carurl);
                    }, 10000);
                });
            })(jQuery);
        </script>
        <script type="text/javascript">
            function limitaTextarea(valor) {
                quantidade = 200;
                total = valor.length;

                if(total <= quantidade) {
                    resto = quantidade- total;
                    document.getElementById('contador').innerHTML = resto;
                } else {
                    document.getElementById('texto').value = valor.substr(0, quantidade);
                }
            }
        </script>
    </head>
    <body style="background-color: #F3F0EC;">
    <!-- INÍCIO DO CORPO DO SITE-->
        <div class="container fundo fill" role="main">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#barra">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/administracao"><img src="<?php echo base_url(); ?>uploads/layout/logo.png" width="75px"></a>
                </div>            
                <div id="barra" class="collapse navbar-collapse">
                     <ul class="nav navbar-nav"> 
                        <li role="presentation"><a href="<?php echo base_url(); ?>index.php/administracao/pedidos"><i class="fa fa-bolt"></i> PEDIDOS</a></li>
                        <li role="separator" class="divider"></li>
                        <li role="presentation"><a href="<?php echo base_url(); ?>/index.php/administracao/logout"><i class="fa fa-times"></i> SAIR</a></li>
                         <li class="right" role="presentation"><a href="#"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $username ?></a></li>
                    </ul>
                </div>
            </nav>
            