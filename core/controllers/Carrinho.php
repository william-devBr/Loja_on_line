<?php
namespace core\controllers;
use core\classes\Store;
use core\models\Produto;

    class Carrinho {
        //inicia o carrinho
       public function adiciona_carrinho(){

        $id_produto = $_GET['id'];

        
                    if(Produto::getProduto($id_produto)){

                $carrinho = [];

                if(isset($_SESSION['carrinho'])) {
                    $carrinho = $_SESSION['carrinho'];
                }
                
                if(key_exists($id_produto, $carrinho)){

                    $carrinho[$id_produto]++;
                }else {

                    $carrinho[$id_produto] = 1;
                }

                $_SESSION['carrinho'] = $carrinho;

                $total_itens_carrinho = 0;

                foreach($carrinho as $itens => $quantidade) {
                    
                        $total_itens_carrinho += $quantidade;
                }
                
                echo json_encode(array(
                        'status'=> 'Ok',
                        'msg'=>"Item adicionado ao carrinho...",
                        'total_carrinho' => $total_itens_carrinho
                        ), true);
                }else {
                    echo json_encode(array(
                        'status'=> false,
                        'msg'=> " ",
                        'total_carrinho' => count($_SESSION['carrinho'])
                        ), true);
                }
        }
    //limpar o crrinho
        public function limpar_carrinho(){

            if(isset($_SESSION['carrinho'])){
                unset($_SESSION['carrinho']);
            }
            header('Location:./?a=carrinho'); exit();
    }
    //view carrinho
    public function carrinho(){

        if(!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0){
            $data = ['carrinho' => null];
        } else {

            $ids = [];

            foreach($_SESSION['carrinho'] as $produto_id => $quantidade) {
                array_push($ids, $produto_id);
            }
            
        $ids = implode(",", $ids);
        $produto = new Produto();
        $result = $produto->lista_produtos_id($ids);

        $data_tmp = [];
        

        foreach($_SESSION['carrinho'] as $id_produto => $quantidade) {

                foreach($result as $item) {
                    if($item->id_produto == $id_produto){
                        array_push($data_tmp,[
                        'id_produto'=> $item->id_produto,
                        'titulo'=> $item->nome_produto, 
                        'imagem'=>$item->url_imagem,
                        'preco'=>$item->preco * $quantidade,
                        'quantidade'=> $quantidade,
                        ]);
                        break;
                    }   
                }
        }

        $total_amount = 0;
        foreach($data_tmp as $total){
            $total_amount += $total['preco'];
        }

        $data = [
            'carrinho'=> $data_tmp,
            'total_amount' => $total_amount,
            'title'=>APP_NAME
        ];
        }

        Store::Layout([
        'layouts/html_header', 
        'layouts/header',
        'carrinho',
        'layouts/footer',
        'layouts/html_footer'
        ], 
        $data);
    }

    public function remove_item() {

            if(!isset($_GET['_id'])) {
                return;
            }

            $id_produto = $_GET['_id'];
        
             $carrinho = $_SESSION['carrinho'];

            if(key_exists($id_produto, $carrinho)){

                 unset($carrinho[$id_produto]);
            }
            
            $_SESSION['carrinho'] = $carrinho;
            echo json_encode(array(
                 "status"=>"Ok",
                 "url"=>"?a=carrinho"
            ), true);
            
       }
    }
