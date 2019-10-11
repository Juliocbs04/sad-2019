<?php
namespace dimensoes;

class Sumario{
    public $quantidadeInclusoes;
    public $quantidadeAlteracoes;

    public function setQuantidadeInclusoes(){
        $this->quantidadeInclusoes ++;
    }
    public function setQuantidadeAlteracoes(){
        $this->quantidadeAlteracoes ++
    }
}

?>