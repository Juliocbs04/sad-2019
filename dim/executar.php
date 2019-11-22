<?php
   require_once('DimCliente.php');
   require_once('DimData.php');
   require_once('DimProduto.php');
   require_once('../fato/CargaFatosVenda.php');
   require_once('Sumario.php');
   //require_once('../fatos/ETLFatosVenda.php');
   use FATOS\CargaFatosVenda;
   use dimensoes\Sumario;
   use dimensoes\DimData;
   use dimensoes\DimProduto;
   use dimensoes\DimCliente;
   $dimCliente = new DimCliente();
   $sumCliente = $dimCliente->carregarDimCliente();
   echo "Clientes: <br>";
   echo "Inclusões: ".$sumCliente->quantidadeInclusoes."<br>";
   echo "Alterações: ".$sumCliente->quantidadeAlteracoes."<br>";
   echo "<br>==============================================<br>";
   $dimData = new DimData();
   $sumData = $dimData->extrairTransformarDatas();
   echo "Datas: <br>";
   echo "Inclusões: ".$sumData->quantidadeInclusoes."<br>";
   echo "Alterações: ".$sumData->quantidadeAlteracoes."<br>";
   echo "<br>==============================================<br>";
   $dimProduto = new DimProduto();
   $sumProduto = $dimProduto->carregarDimProduto();
   echo "Produtos: <br>";
   echo "Inclusões: ".$sumProduto->quantidadeInclusoes."<br>";
   echo "Alterações: ".$sumProduto->quantidadeAlteracoes."<br>";
   echo "<br>==============================================<br>";

   $fatosVenda = new CargaFatosVenda();
   $sumFatos = $fatosVenda->carregarFatos('2017-01-01');
   echo "Fatos: <br>";
   echo "Inclusões: ".$sumFatos->quantidadeInclusoes."<br>";
   echo "<br>==============================================<br>";
?>