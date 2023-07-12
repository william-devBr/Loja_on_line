<?php
 namespace core\models;
 use core\classes\Database;

 class Produto {
    //busca todos os produtos na tabela produto filtrando por categoria
    public static function getProdutos($categoria){
      $db = new Database();
    
      $id_categoria = $categoria;
      $sql = "SELECT * FROM produto";
      $sql .= " WHERE ativo = 1 ";
        if(!empty($id_categoria)){
            $sql .= "AND categoria = $id_categoria ";
         }
      return $db->select($sql);
    }
         //pegas as categorias na tabela categoria
    public static function getCategorias(){
        $sql = new Database();
        return $sql->select("SELECT * FROM categoria WHERE ativo = 1");
    }
     // retornas as categorias
     public static function nome_categoria($c){
        $db = new Database();
        $params = [':id'=> $c];
        return $db->select("SELECT nome FROM categoria WHERE id_categoria = :id",$params)[0];   
     }
      // retorna dados de um único item
     public static function getProduto($id_produto) {
     
      if(empty($id_produto) || !is_numeric($id_produto)) {
           return false;
       }
  
       $db = new Database();
       $params = [':id_produto' => $id_produto];
     
        $result = $db->select("
          SELECT * FROM produto
           WHERE id_produto = :id_produto
           AND ativo = 1
           AND estoque > 0
           ", $params);
       
           return count($result) != 0 ? true : false;
     }

     //busca produto para listar no carrinho
     public function lista_produtos_id($ids){

       $db = new Database();
       return $db->select("SELECT * FROM produto WHERE id_produto IN ($ids)");
     }

     public static function dados_produto($id_produto){

        $db = new Database();
        $params = [":id_produto"=> $id_produto];
        return $db->select("SELECT * FROM produto WHERE id_produto = :id_produto",$params)[0];
     }
 } 
