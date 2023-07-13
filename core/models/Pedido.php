<?php

 namespace core\models;
 use core\classes\Database;


 class Pedido {

    public function grava_pedido($pedido, $itens_pedido){

        $db = new Database();

        $params = [
            ':id_cliente' => $pedido['id_cliente'],
            ':cod_pedido' => $pedido['cod_pedido'],
            ':status_pedido' => "PENDENTE",
            ':valor'=> $pedido['valor'],
        ];

        $query = $db->insert("INSERT INTO pedido
             VALUES(0,:id_cliente,
                      :cod_pedido,
                       NOW(),
                       NOW(),
                      :status_pedido,
                      :valor
                     )
             ",$params);

     
              $id_pedido = $db->select(" SELECT MAX(id_pedido) id_pedido FROM pedido")[0]->id_pedido;
             
              //==============
              foreach($itens_pedido as $itens){   
                  //insere os itens na tabela

              $params = [
                   ':id_pedido' =>  $id_pedido,
                    ':id_produto'=> $itens['id_produto'],
                     ':nome_produto' => $itens['nome_produto'],
                     ':quantidade_produto' => $itens['quantidade'],
                     ':valor_unitario' => $itens['valor_unitario']
              ];


              $db->insert("INSERT INTO itens_pedido
                           VALUES (
                                  :id_pedido,
                                  :id_produto,
                                  :nome_produto,
                                  :quantidade_produto,
                                  :valor_unitario
                                )
                            ", $params); 
              }
           
         
    }

    

 }
