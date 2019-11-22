<?php
namespace FATOS;
require_once('FatoVenda.php');
require_once('../dim/Data.php');
require_once('../dim/Sumario.php');

use dimensoes\Data;
use dimensoes\Sumario;
use FATOS\FatoVenda;

class CargaFatosVenda{
    public function carregarFatos($dataInicial){
        $sumario = new Sumario();

        try{
            $connComercial = $this->conectarBanco('bd_comercial');
            $connDimensional = $this->conectarBanco('dm_comercial');
        }catch(\Exception $e){
            die($e->getMessage());
        }
        /*
        *Apagando os registros da tabela de fatos de venda com base na data inicial passada
        */
        $sqlData = $connDimensional->prepare('SELECT SK_data, data FROM dim_data WHERE data > ?');
        $sqlData->bind_param('s',$dataInicial);
        $sqlData->execute();

        $resultData = $sqlData->get_result();
        while($linhaData = $resultData->fetch_assoc()){
            $sqlDeleteFatoVenda = $connDimensional->prepare('DELETE FROM fato_vendas WHERE SK_data = ?');
            $sqlDeleteFatoVenda->bind_param('i',$linhaData['SK_data']);
            $sqlDeleteFatoVenda->execute();
        }

        $resultData->data_seek(0);
        while($linhaData = $resultData->fetch_assoc()){
            $sqlPedidos = $connComercial->prepare('SELECT cod_pedido, cliente, data_pedido FROM pedido WHERE data_pedido = ?');
            $sqlPedidos->bind_param('s',$linhaData['data']);
            $sqlPedidos->execute();
            $resultPedidos = $sqlPedidos->get_result();
            while($linhaPedidos = $resultPedidos->fetch_assoc()){
                /*
                *Busca os itens de cada pedido
                */
                $sqlItem = $connComercial->prepare('SELECT pedido, produto, cod_item_pedido, quantidade, preco_unit FROM item_pedido WHERE pedido =? ');
                $sqlItem->bind_param('i',$linhaPedidos['cod_pedido']);
                $sqlItem->execute();
                $resultItem = $sqlItem->get_result();
                while($linhaItem = $resultItem->fetch_assoc()){

                    $sqlDimCliente = $connDimensional->prepare('SELECT SK_cliente FROM dim_cliente WHERE cpf = ? and data_fim is null');
                    $sqlDimCliente->bind_param('i', $linhaPedidos['cliente']);
                    $sqlDimCliente->execute();
                    $resultDimcliente = $sqlDimCliente->get_result();
                    $cliente = $resultDimcliente->fetch_assoc();

                    $sqlDimProduto = $connDimensional->prepare('SELECT SK_produto FROM dim_produto WHERE codigo = ? AND data_fim IS NULL');
                    $sqlDimProduto->bind_param('i', $linhaItem['produto']);
                    $sqlDimProduto->execute();
                    $resultDimProduto = $sqlDimProduto->get_result();
                    $produto = $resultDimProduto->fetch_assoc();
                    
                    $fatoGravar = new FatoVenda();
                    $fatoGravar->setFatoVenda($cliente['SK_cliente'], $produto['SK_produto'], $linhaData['SK_data'], $linhaPedidos['cod_pedido'], $linhaItem['quantidade'],$linhaItem['preco_unit']);

                    $sqlFatoVenda = $connDimensional->prepare('SELECT cod_fato_vendas, SK_produto, SK_data, pedido, valor_venda, quantidade_venda FROM fato_vendas WHERE pedido = ? AND SK_produto = ?');
                    $sqlFatoVenda->bind_param('ii', $fatoGravar->pedido,$fatoGravar->SK_produto);
                    $sqlFatoVenda->execute();

                    $resultFatoVenda = $sqlFatoVenda->get_result();
                    if($resultFatoVenda->num_rows === 0 ){
                        $sqlInsertFatoVendas = $connDimensional->prepare('INSERT INTO fato_vendas (SK_cliente, SK_produto, SK_data, pedido, valor_venda, quantidade_venda) VALUES (?,?,?,?,?,?)');
                        
                        $sqlInsertFatoVendas->bind_param('iiiidi', $fatoGravar->SK_cliente, $fatoGravar->SK_produto, $fatoGravar->SK_data, $fatoGravar->pedido, $fatoGravar->valor_venda, $fatoGravar->quantidade_venda);
                        $sqlInsertFatoVendas->execute();
                        
                        $sumario->setQuantidadeInclusoes();

                    }
                    
                }
               
            }

        
        }
        return $sumario;
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