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
class Cidade_model extends CI_Model {

    private $tabela;

    public function __construct() {
        parent::__construct();

        $this->tabela = 'municipio';
    }

    public function select_all() {
        return $this->db->get($this->tabela)->result();
    }

    public function select_cidade_estado($uf = null) {
        $this->db->select('*')
                ->from($this->tabela)
                ->where('Uf', $uf);

        return $this->db->get()->result();
    }
}
