<?php
namespace dimensoes;
mysqli_report(MYSQLI,REPORT,STRICT);

require_once('Data.php');
require_once('Sumario.php');

use dimensoes\Data;
use dimensoes\Sumario;

class DimData{
    

    public function extrairTransformarDatas(){
        $sumario = new Sumario();

        try{
            $connDimensao = $this->conectarBanco('dm_comercial');
            $connComercial = $this->conectarBanco('bd_comercial');
         }catch(\Exception $e){
            die($e->getMessage());
         }

         $sqlDimData = $connDimensao->prepare('SELECT data FROM dim_data');
         $sqlDimData->execute();

         $resultDimData = $sqlDimData->get_result();
         if ( $resultDimData->num_rows ===0 ) {// Dimensão está vazia
            $sqlDataPedido = $connComercial->prepare('SELECT data_pedido FROM pedido');
            $sqlDataPedido->execute();

            $resultDataPedido = $sqlDataPedido->get_result();
            while($linhaDataPedido = $resultDataPedido->fetch_assoc()){
                $dataDimensao = new Data();
                $dataDimensao->setData($linhaDataPedido['data_pedido']);
                $this->carregarNovaData($dataDimensao);
                $sumario->setQuantidadeInclusoes();
            }
         }else{ // Dimensão já contém dados

         }
    }

    public function carregarNovaData($objData){
        try{
            $connDimensao = $this->conectarBanco('dm_comercial');
        }catch(\Exception $e){
            die($e->getMessage());
        }
        $sqlInsertData = $connDimensao->prepare('INSERT INTO dim_data(data,dia,mes,ano,semana_ano,bimestre, trimestre,semestre) VALUES (?,?,?,?,?,?,?,?)');
        $sqlInsertData->bind_param('ssssssss',$objData->data, $objData->dia,  $objData->mes,  $objData->ano,  $objData->semanaAno,$objData->bimestre,  $objData-> $objData->trimestre,  $objData->semestre);
        $sqlInsertData->execute();

    }   

    private function conectarBanco($banco){
        if(!defined('DS')){
           define('DS', DIRECTORY_SEPARATOR);
        }
        if(!defined('BASE_DIR')){
           define('BASE_DIR', dirname(__FILE__).DS);
        }
        require(BASE_DIR.'config.php');
        try{
           $conn = new \MySQLi($dbhost, $user, $password, $banco);
           return $conn;
        }catch(mysqli_sql_exception $e){
           throw new \Exception($e);
           die;
        }
     }
}




?>