<?php
    namespace DIM;

    /*
        Model da entidade cliente
        @author Júlio César Belenke Dos Santos
    */
    class Cliente{
        /** 
        *CPF do cliente
        *@var string
        */
        public $cpf;
        /** 
        *nome do cliente
        *@var string
        */
        public $nome;
        /** 
        *Sexo do cliente
        *@var string
        */
        public $sexo;
        /** 
        *Idade do cliente
        *@var int
        */
        public $idade;
        /** 
        *Email do cliente
        *@var string
        */
        public $email;
        /** 
        *Rua do cliente
        *@var string
        */
        public $rua;
        /** 
        *Bairro do cliente
        *@var string
        */
        public $bairro;
        /** 
        *Cidade do cliente
        *@var string
        */
        public $cidade;
        /** 
        *UF do cliente
        *@var string
        */
        public $uf;
    
        /** 
        * Carrega os atributos da classe Prospect
        * @param $cpf CPF do cliente
        * @param $nome nome do cliente
        * @param $sexo sexo do cliente
        * @param $idade Idade do cliente
        * @param $rua rua do cliente
        * @param $bairro bairro do cliente
        * @param $uf UF do cliente
        * @return Void  
        */
        
        public function setProspect( $cpf,$nome, $sexo, $idade, $rua, $bairro, $cidade, $uf ){
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->idade = $idade;
            $this->rua = $rua;
            $this->bairro = $bairro;
            $this->cidade = $cidade;
            $this->uf = $uf;
        }
    }
?>