<?php

if (!defined('BASEPATH'))
    exit('Sem permissao de acesso direto ao Script.');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade_model
 *
 * @author DANILO
 */
class Estado_model extends CI_Model {

    private $tabela;

    public function __construct() {
        parent::__construct();

        $this->tabela = 'estado';
    }

    public function select_all_estados() {
        return $this->db->get($this->tabela)->result();
    }
}
