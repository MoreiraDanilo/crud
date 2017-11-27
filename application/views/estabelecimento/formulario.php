<?php

$id_estabelecimento = (isset($id_estabelecimento))?$id_estabelecimento:null;
$razao_social = (isset($razao_social)) ? $razao_social : '';
$nome_fantasia = (isset($nome_fantasia)) ? $nome_fantasia : '';
$cnpj = (isset($cnpj)) ? $cnpj : '';
$email = (isset($email)) ? $email : '';
$endereco = (isset($endereco)) ? $endereco : '';
$numero = (isset($numero)) ? $numero : '';
$complemento = (isset($complemento)) ? $complemento : '';
$bairro = (isset($bairro)) ? $bairro : '';
$estado = (isset($estado)) ? $estado : '';
$cidade = (isset($cidade)) ? $cidade : '';
$telefone = (isset($telefone)) ? $telefone : '';
$data_cadastro = (isset($data_cadastro)) ? data_exibicao($data_cadastro) : '';
$categoria = (isset($categoria)) ? $categoria : '';
$status = (isset($status)) ? $status : '';
?>
<form action="<?php echo $url; ?>" method="post" accept-charset="utf-8" class="form" name="formulario" id="formulario">    

    <input type="hidden" name="id_estabelecimento" id="id_estabelecimento" value="<?php echo $id_estabelecimento; ?>">
    
    <!--campo hide para pegar base_url para carregar via ajax a cidades dos estados--> 
    <?php
    echo '<input type="hidden" id="url_cidade_ajax" value="' . base_url('estabelecimento/select_cidade') . '" />';
    ?>

    <div class="grid-form1">
        <h4 class="heading_a"><b><?php echo $titulo;?>:</b></h4>

        <div class="row">
            <div class="form-group col-md-5">
                <label class="control-label" for="razaosocial">Razão Social:</label>  
                <input id="razaosocial" name="razaosocial" type="text" placeholder="Razão social" class="form-control" value="<?php echo $razao_social;?>">
            </div>
            <div class="form-group col-md-5">
                <label class="control-label" for="nomefantasia">Nome Fantasia:</label>  
                <input id="nomefantasia" name="nomefantasia" type="text" placeholder="Nome fantasia" class="form-control" value="<?php echo $nome_fantasia;?>">
            </div>
            <div class="form-group col-md-2">
                <label class="control-label" for="cnpj">CNPJ:</label>  
                <input id="cnpj" name="cnpj" type="text" placeholder="00.000.000/0000-00" class="form-control" value="<?php echo $cnpj;?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label" for="endereco">Endereço:</label>  
                <input id="endereco" name="endereco" type="text" placeholder="Endereço" class="form-control" value="<?php echo $endereco;?>">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label" for="numero">Numero:</label>  
                <input id="numero" name="numero"type="text" placeholder="Número" class="form-control" value="<?php echo $numero;?>">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label" for="numero">Complemento:</label>  
                <input id="complemento" name="complemento"type="text" placeholder="Complemento" class="form-control" value="<?php echo $complemento;?>">
            </div>          
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="numero">Bairro:</label>  
                <input id="bairro" name="bairro" type="text" placeholder="Bairro" class="form-control" value="<?php echo $bairro;?>">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label" for="estado">Estado</label>
                <?php 
                echo form_dropdown('estado', $ufs_banco, $estado, 'class="form-control" id="estado" name="estado"'); 
                ?>
            </div>
            <div class="form-group col-md-5">
                <label class="control-label" for="cidade">Cidade</label>
                <?php 
                    echo form_dropdown('cidade', $cidades_banco, $cidade, 'class="form-control" id="cidade" name="cidade"'.((empty($cidade))?' disabled':''));
                ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <label class="control-label" for="numero">E-mail:</label>  
                <input id="email" name="email" type="text" placeholder="exemplo@exemplo.com" class="form-control" value="<?php echo $email;?>">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label" for="numero">Telefone:</label>  
                <input id="telefone" name="telefone" type="text" placeholder="(00)0000-00000" class="form-control" value="<?php echo $telefone;?>">
            </div>
            <div class="form-group col-md-4">
                <label class="control-label" for="numero">Categoria:</label>  
                <?php echo form_dropdown('categoria', $categorias_banco, $categoria, 'class="form-control" id="categoria" name="categoria"'); ?>
            </div>
        </div>    
        
        <div class="row">
            <div class="form-group col-md-3">
                <label class="control-label" for="numero">Data Cadastro:</label>  
                <input id="data_cadastro" name="data_cadastro" type="text" placeholder="01/01/1970" class="form-control" value="<?php echo $data_cadastro;?>">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label" for="status">Status</label>

                <label class="radio" for="status" style="margin-left: 20px;">
                    <?php 
                    if(($status == '1')){
                        echo '<input type="radio" name="status" id="status_1" value="1" checked>';
                    }else{
                        echo '<input type="radio" name="status" id="status_1" value="1">';
                    }
                    ?>
                    Ativo
                </label> 
                <label class="radio" for="status-1" style="margin-left: 20px;">
                    <?php 
                    if(($status == '0')){
                        echo '<input type="radio" name="status" id="status_0" value="0" checked>';
                    }else{
                        echo '<input type="radio" name="status" id="status_0" value="0">';
                    }
                    ?>
                    Inativo
                </label>
                
            </div>
        </div>
        <div class="row">
            <div class="profile-btn">
                <button type="submit" href="#" class="btn btn-success bg-red">Salvar</button>
                <a class="btn-default btn" href="javascript: history.back();">Voltar</a>
            </div>
        </div>
    </div>
</form>