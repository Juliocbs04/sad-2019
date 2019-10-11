<?php
    require_once('DimCliente.php');

    use dimensoes\DimCliente;

    $dimCliente = new DimCliente();
    $sumCliente = $dimCliente->carregarDimCliente();
    echo $sumCliente->quantidadeInclusoes;
    
?>