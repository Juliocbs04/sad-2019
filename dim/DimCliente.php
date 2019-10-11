<?php
    namespace dimensoes;
    mysqli_report(MYSQLI_REPORT_STRICT);
    require_once('Cliente.php');
    use dimensoes\Cliente;
    

    class DimCliente{
        
        public function carregarDimCliente(){
            $dataAtual = date('Y-m-d');
            try{
                $conexaoDimensao = $this->conectarBanco('dm_comercial');
                $conexaoComercial = $this->conectarBanco('bd_comercial');
            }catch(\Exception $e){
                die($e->getMessage());
            }
            $sqlDim = $conexaoDimensao->prepare('select sk_cliente, cpf, nome, sexo, idade, rua, bairro, cidade,uf from dim_cliente');

            $sqlDim->execute();
            $result = $sqlDim->get_result();
            if( $result->num_rows === 0 ) {
                $sqlComercial = $conexaoComercial->prepare("select * from cliente"); // Aqui cria a variável com sentença SQL 
                $sqlComercial->execute();
                $resultComercial = $sqlComercial->get_result();
                if( $resultComercial->num_roms !== 0 ) { // Testa se a consulta retornou dados
                    while( $linhaCliente = $resultComercial->fetch_assoc() ){ // Atribui a váriavel cada linha até o fim do loop
                        $cliente = new Cliente();
                        $cliente->setCliente($linhaCliente['cpf'], $linhaCliente['nome'], $linhaCliente['sexo'], $linhaCliente['idade'], $linhaCliente['rua'], $linhaCliente['bairro'], $linhaCliente['cidade'],$linhaCliente['uf']);
                        
                        $sqlInsertDim = $conexaoDimensao->prepare('insert into dim_cliente cpf, nome, sexo, idade, rua, bairro, cidade, uf, data_ini 
                        values(?,?,?,?,?,?,?,?,?)');

                        $sqlInsertDim->bind_param('sssisssss', $cliente->cpf, $cliente->nome, $cliente->sexo, $cliente->idade, $cliente->rua, $cliente->bairro, $cliente->cidade, $cliente->uf, $dataAtual);
                        $sqlInsertDim->execute();
                    }
                    $sqlComercial->close();
                    $sqlDim->close();
                    $sqlInsertDim->close();
                    $conexaoComercial->close();
                    $conexaoDimensao->close();
                }else{

                }
            }else{

            }
            
        }
        
        private function conectarBanco($banco){
            if(!define('DS')){
                define('DS', DIRECTORY_SEPARATOR);
            }
            if(!define('BASE_DIR')){
                define('BASE_DIR', dirname(__FILE__).DS);
            }
            require_once(BASE_DIR.'config.php');

            try{
                $conexao = new \MySQLi($dbhost, $user, $password ,$banco);
                return $con;
            }catch(mysqli_sqlexception $e){
                throw new \Exception($e);
                die;
            }


        }

    }
?>