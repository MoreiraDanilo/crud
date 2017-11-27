<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estabelecimentos_model
 *
 * @author MASTER
 */
class Estabelecimento_model extends CI_Model {
	private $tabela;

	public function __construct(){
            parent::__construct();
            $this->tabela       = 'estabelecimento';
        }
        
        public function select_estabelecimento($id = null){
            $this->db->select('e.*, c.id_categoria as categoria, cid.Id as cidade, est.Uf as estado, c.descricao as des_categoria')
                    ->from($this->tabela.' as e')
                    ->join('categoria as c', 'c.id_categoria = e.categoria_id', 'left')
                    ->join('municipio as cid', 'e.cidade_id = cid.Id', 'left')
                    ->join('estado as est', 'est.Uf = cid.Uf', 'left');
            
            if($id){
                $this->db->where('e.id_estabelecimento',$id);
            }
                       
            $query = $this->db->get();
            
            return $query->result();
        }
               
        public function insert($estabelecimento){
            return $this->db->insert($this->tabela, $estabelecimento);
        }
        
        public function update($estabelecimento){
            $this->db->where('id_estabelecimento', $estabelecimento->id_estabelecimento)
                    ->update($this->tabela, $estabelecimento);
        }
        
        public function delete($id_estabelecimento){
            $this->db->where('id_estabelecimento', $id_estabelecimento)
                    ->delete($this->tabela);
        }
}
