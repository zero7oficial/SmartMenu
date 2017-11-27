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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo $nomeEmpresa; ?></title>
        <meta name="keywords" content="SmartMenu, Pizzaria Expresso, Cardápio Online, Pizzas" />
        <meta name="description" content="SmartMenu, um cardápio tecnológico, facilitando sua comunicação conosco.>" />
        <meta property="og:locale" content="pt_BR">
        <meta property="og:title" content="SmartMenu" />
        <meta property="og:description" content="SmartMenu, um cardápio tecnológico, facilitando sua comunicação conosco. " />
        <meta property="og:url" content="<?php echo base_url(); ?>">
        <meta property="og:site_name" content="<?php echo base_url(); ?>" />
        <meta property="og:image" content="<?php echo base_url(); ?>uploads/layout/logo.png">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="350">
        <meta property="og:image:height" content="200">
        <meta name="author" content="AgênciaZero7 - contato@agencia07.com.br" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="<?php echo base_url(); ?>" />

        <!-- CSS STYLOS -->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/css/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>includes/font-awesome/css/font-awesome.min.css">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>includes/uploads/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>includes/uploads/favicon.ico" type="image/x-icon">


        <!-- JS STYLOS -->
        
        <script src="<?php echo base_url(); ?>includes/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>includes/js/bootstrap.min.js"></script>
        <script type="text/javascript" href="<?php echo base_url(); ?>includes/js/bootstrap.js" ></script>
        <style type="text/css">
            body{font-family:Open Sans, sans-serif; font-weight:normal; }
            h1{font-family:Open Sans, sans-serif; font-weight:700; }
            h2{font-family:Open Sans, sans-serif; font-weight:600; }
            h3{font-family:Open Sans, sans-serif; font-weight:normal; }
            h4{font-family:Open Sans, sans-serif; font-weight:700; }
            h5{font-family:Open Sans, sans-serif; font-weight:600; }
            h6{font-family:Open Sans, sans-serif; font-weight:600; }
        </style>
    </head>
    <body>
    <section id="login">
        <div class="perfil"> Versão 1.0</a></div>
        <div class="titulo">PAINEL DE CONTROLE</div>
    </section>
    <br />
    <div class="sist_login">
        <img src="<?php echo base_url(); ?>uploads/layout/logo.png" width="280px">
        <h3>PAINEL DE CONTROLE</h3>
        <?php echo validation_errors(); ?>
        <?php echo form_open('validar_login'); ?>
         <label for="username">Usuário:</label>
         <input type="text" size="20" class="form-control" id="username" name="username"/>
         <br/>
         <label for="password">Senha:</label>
         <input type="password" size="20" class="form-control" id="senha" name="senha"/>
         <br/>
         <input  class="btn btn-lg btn-primary" type="submit" value="ENTRAR"/>
       </form>       
    </div>
   </body>
   <br />
    <div id="footer" class="footer copy_pc" style="position: fixed;  bottom: 0; padding: 2%;">
        <p>Painel de Administração desenvolvido por <b><a href="https://www.agencia07.com.br/">Agência Zero7</a></b> | <b>Menfis - Versão 1.0</b></p>
    </div>