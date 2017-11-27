<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estabelecimento
 *
 * @author DANILO
 */
class Estabelecimento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->data['js'][]  = 'assets/js/jquery-3.2.1.min';
        $this->data['js'][] = 'assets/js/jquery.validate';
        $this->data['css'][] = 'assets/bootstrap/css/bootstrap';
        $this->data['css'][] = 'assets/css/template';
        $this->data['js'][]  = 'assets/bootstrap/js/bootstrap.min';       
        $this->data['js'][] = 'assets/js/jquery.mask';

        $this->data['js'][] = 'assets/bootstrap/js/bootstrap-toggle.min';       
        $this->data['js'][]  = 'assets/js/pages/estabelecimento';
        
        $this->load->model(array('estado_model','categoria_model', 'estabelecimento_model', 'cidade_model'));
        
        $this->load->helper('formata_data');
    }

    public function index() {
        $this->data['tabela'] = $this->estabelecimento_model->select_estabelecimento();
        $this->data['view']             = 'estabelecimento/index';
        $this->data['titulo']           = 'Estabelecimentos';
        
        $this->data['tabela'] = $this->tabela($this->data['tabela']);
        
        $this->load->view('template', $this->data);
    }
    
    private function tabela($dados = null){
        $tabela = '';
        if(!isset($dados) || empty($dados)){
            $tabela = '<tr>'
                    . '<td colspan="5">Nenhum registro encontrado!</td>'
                    .'</tr>';
        }else{
            foreach ($dados as $value) {
                $tabela .= '<tr>';
                    $tabela .= '<td>'.$value->razao_social.'</td>';
                    $tabela .= '<td>'.$value->cnpj.'</td>';
                    $tabela .= '<td>'.$value->des_categoria.'</td>';
                    $tabela .= '<td>'.($value->status?'Ativo':'Inativo').'</td>';
                    $tabela .= '<td style="text-align: center;">'
                            . '<a class="btn btn-primary" href="'.base_url('estabelecimento/alterar/').$value->id_estabelecimento.'">'
                            . '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp&nbsp'
                            . '<a class="btn btn-danger" onclick="return confirm(\'Deseja excluir o estabelecimento '.$value->razao_social.'?\')" href="'.base_url('estabelecimento/excluir/').$value->id_estabelecimento.'">'
                            . '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>'
                            . '</td>';
                $tabela .= '</tr>';           
            }
        }
        return $tabela;
    }
    
    public function novo(){
        $this->data['view']             = 'estabelecimento/formulario';
        $this->data['titulo']           = 'Formulário de Cadastro';
        $this->data['url']              = base_url('estabelecimento/salvar');
        $this->selects();

        $this->load->view('template', $this->data);
    }
    
    private function selects($uf_selecionada = null){
        $this->load->model(array('estado_model','cidade_model','categoria_model'));
        
        $estados = $this->estado_model->select_all_estados();
        
        $this->data['ufs_banco'][''] = 'Selecione';
        
        foreach ($estados as $value){
            $this->data['ufs_banco'][$value->Uf] = $value->Nome;
        }
        
        $this->data['cidades_banco'][''] = 'Selecione o estado';
        
        if(isset($uf_selecionada)){
            $cidades = $cidades = $this->cidade_model->select_cidade_estado($uf_selecionada);

            foreach ($cidades as $value) {
                $this->data['cidades_banco'][$value->Id] = $value->Nome;
            }
            unset($this->data['cidades_banco']['']);
        }
        
        $this->data['categorias_banco'][''] = 'Selecione';
        
        $categorias = $this->categoria_model->select_all_categoria();
        
        foreach ($categorias as $value){
            $this->data['categorias_banco'][$value->id_categoria] = $value->descricao;
        }
    }
    
    public function select_cidade(){
        $uf_estado = $this->input->post('uf_estado');
        
        $cidades = '';
        
        if(isset($uf_estado) && !empty($uf_estado)){
            $cidades = $this->cidade_model->select_cidade_estado($uf_estado);
        }
        
        echo '<option value="">Selecione</option>';
        foreach($cidades as $value){
            echo '<option value="' . $value->Id . '">' . $value->Nome . '</option>';
        }
        return;
    }
    
    public function salvar(){
        $estabelecimento = $this->post();  
        
        if(!isset($estabelecimento->id_estabelecimento)){
            $this->estabelecimento_model->insert($estabelecimento);
        }else{
            $this->estabelecimento_model->update($estabelecimento);
        }
        redirect(base_url());
    }
    
    private function post(){
        $estabelecimento = new stdClass();
        $post = $this->input->post();
         
        if(isset($post['id_estabelecimento']) && !empty($post['id_estabelecimento'])){
            $estabelecimento->id_estabelecimento = $post['id_estabelecimento'];
        }
               
        $estabelecimento->razao_social  = (!empty($post['razaosocial'])) ? $post['razaosocial'] : '';
        $estabelecimento->nome_fantasia = (!empty($post['nomefantasia'])) ? $post['nomefantasia'] : '';
        $estabelecimento->cnpj          = (!empty($post['cnpj'])) ? $post['cnpj'] : '';
        $estabelecimento->email         = (!empty($post['email'])) ? $post['email'] : '';
        $estabelecimento->endereco      = (!empty($post['endereco'])) ? $post['endereco'] : '';
        $estabelecimento->numero        = (!empty($post['numero'])) ? $post['numero'] : '';
        $estabelecimento->complemento   = (!empty($post['complemento'])) ? $post['complemento'] : '';
        $estabelecimento->bairro        = (!empty($post['bairro'])) ? $post['bairro'] : '';
        $estabelecimento->cidade_id     = (!empty($post['cidade'])) ? $post['cidade'] : null;
        $estabelecimento->telefone      = (!empty($post['telefone'])) ? $post['telefone'] : '';
        $estabelecimento->categoria_id  = (!empty($post['categoria'])) ? $post['categoria'] : null;
        $estabelecimento->status        = (!empty($post['status'])) ? $post['status'] : '0';
        
        $estabelecimento->data_cadastro = (!empty($post['data_cadastro'])) ? data_banco($post['data_cadastro']) :  date('Y-m-d H:i:s');
 
        return $estabelecimento;
    }
    
    public function alterar($id = null){
        if ((isset($id)) && !(empty($id)) && ($this->input->post('cnpj'))){
            $this->salvar($id);
        }
        
        $this->data = array_merge((array) $this->estabelecimento_model->select_estabelecimento($id)[0], $this->data);
        $this->data['view']   = 'estabelecimento/formulario';
        $this->data['titulo'] = 'Edição de Cadastro';
        $this->data['url']    = 'estabelecimento/alterar/'.$id;
        $this->data['id_estabelecimento'] = $id;
        $uf_selecionada = $this->estabelecimento_model->select_estabelecimento($id)[0]->estado;
        
        $this->selects($uf_selecionada);


        $this->load->view('template', $this->data);
    }
    
    public function excluir($id = null){
        if(isset($id) && !empty($id)){
            $this->estabelecimento_model->delete($id);
        }
        redirect(base_url());
    }
}
