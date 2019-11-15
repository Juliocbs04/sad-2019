<?php
namespace FATOS;

class FatoVenda{
    public $SK_cliente;
    public $SK_produto;
    public $SK_data;
    public $pedido;
    public $valor_venda;
    public $quantidade_venda; 

    public function setFatoVenda($cliente, $produto, $data, $pedido, $valor, $quantidade){
        $this->SK_cliente = $cliente;
        $this->SK_produto = $produto;
        $this->SK_data = $data;
        $this->pedido = $pedido;
        $this->valor_venda = $valor;
        $this->quantidade_venda = $quantidade;
    }
}
?>