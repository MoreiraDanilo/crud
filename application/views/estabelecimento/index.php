<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="panel-body">
    <div class="row form-group">
        <div class="col-md-12">
            <form action="<?php echo base_url('estabelecimento/novo'); ?>" id="form" method="post" accept-charset="utf-8">
                <button type="submit" class="btn btn-primary form-control" style="width: 85px;">
                    <span class="glyphicon glyphicon-plus"> <b>Novo</b></span>
                </button>
            </form>
        </div>
    </div>
    
    <table class="table table-striped table-responsive table-hover">
        <thead class="thead-inverse" style="background-color: #ac1f2d; color: #fff;">
            <tr>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Categoria</th>
                <th>Status</th>
                <th style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $tabela; ?>
        </tbody>
    </table>
</div>