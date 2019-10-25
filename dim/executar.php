<?php
   require_once('DimCliente.php');
   use dimensoes\DimCliente;
   $dimCliente = new DimCliente();
   try{
      $sumCliente = $dimCliente->carregarDimCliente();
      echo "Quantidade de Inclusões: ".$sumCliente->quantidadeInclusoes."<br>";
      echo "Quantidade de Alterações: ".$sumCliente->quantidadeAlteracoes;
   }catch(Exception $e){
      die($e->getMessage());
   }
    
?>