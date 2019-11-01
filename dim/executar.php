<?php
/*
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
*/

$data = "2019-10-31";
echo $data."<br>";
echo "Dia:".date('d',strtotime($data))."<br>";
echo "Mês:".date('m',strtotime($data))."<br>";
echo "Ano:".date('y',strtotime($data))."<br>";



    
?>