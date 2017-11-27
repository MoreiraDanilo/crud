<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categorias_model
 *
 * @author MASTER
 */
class Categoria_model extends CI_Model {
	private $tabela;

	public function __construct(){
		parent::__construct();

		$this->tabela = 'categoria';
	}
        
        public function select_all_categoria(){
            return $this->db->get($this->tabela)->result();
        }
               
        public function insert($estabelecimento){
            $this->db->insert($this->tabela, $estabelecimento);
            
            return $this->db->insert();
        }
        
        public function update($estabelecimento){
            $this->db->where('id', $estabelecimento->id)
                     ->update($this->tabela, $estabelecimento);
        }
        
        public function delete($id){
            //$id = (is_object($param)) ? $param->est_id : $param;
            $this->db->where('id', $id)
                     ->delete($this->tabela);
        }
        
}
