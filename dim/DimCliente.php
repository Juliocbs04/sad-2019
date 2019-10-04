<?php
    namespace dimensoes;
    mysqli_report(MYSQLI_REPORT_STRICT);
    require_once('Cliente.php');
    use dimensoes\Cliente;
    

    class DimCliente{
        
        public function carregarDimCliente(){
            try{
                $conexaoDimensao = $this->conectarBanco('dm_comercial');
                $conexaoComercial = $this->conectarBanco('bd_comercial');
            }catch(\Exception $e){
                die($e->getMessage());
            }
            $sqlDim = $conexaoDimensao->prepare('select sk_cliente, cpf, nome, sexo, idade, rua, bairro, cidade,uf from dim_cliente');

            $sqlDim->execute();
            $result = $sqlDim->get_result();
            if($result->num_rows !== 0) {

            }
            
        }
        
        private function conectarBanco($banco){
            define('DS', DIRECTORY_SEPARATOR);
            define('BASE_DIR', dirname(__FILE__).DS);
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