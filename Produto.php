<?php
    class Produto{
        public $nome;
        public $unidade_medida;
        public $preco;
        
        public function setProduto($nome, $unidadeMedida, $preco){
            $this->nome= $nome;
            $this->unidade_medida = $unidadeMedida;
            $this->preco = $preco;
        }
    }


?>