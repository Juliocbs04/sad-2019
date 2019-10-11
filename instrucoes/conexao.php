<?php 
    require_once('../Produto.php');
    $conexao = new mysqli('localhost', 'root', '', 'bd_comercial');
    
    $sql = $conexao->prepare('select * from produto');

    $sql->execute();

   
    $produtos = array();
    $resultado = $sql->get_result();
    if( $resultado->num_rows !== 0 ) {
        while( $linha = $resultado->fetch_assoc() ) {
            $produto = new Produto();
            $produto->setProduto($linha['nome_produto'], $linha['unid_medida'], $linha['preco'] );
            $produtos[]= $produto;
        }
    }
    foreach($produtos as $registro){
        echo $registro->nome;
    }



?>