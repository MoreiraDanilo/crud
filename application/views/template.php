<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Estabelecimento</title>

        <meta charset="utf-8">
        <meta http-equiv="content-language" content="pt-br">
        
        <?php
        foreach ($css as $value) {            
            echo '<link rel="stylesheet" type="text/css" href="' . base_url($value) . '.css">';
        }
        ?>
    </head>
    <body>
        <div class="globalbar">
            <img src="https://www.fitcard.com.br/$res/imgs/logoRodape.png" 
                 alt="FiTCARD" 
                 title="FiTCARD">    
        </div>
        <div>
            <div class="container">
                <?php $this->load->view($view); ?>
            </div>
        </div>
<!--        <div id="rodape grid">
            <div class="grid1000">      	
                <a id="logoRodape" href="javascript:;" title=""></a>            

            </div>
        </div>-->

    </body>
    <footer>
        <?php
        foreach ($js as $value) {
            echo '<script type="text/javascript" src="' . base_url($value) . '.js"></script>';
        }
        ?>        
    </footer>
</html>

