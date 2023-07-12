<?php

 //ROUTES PARA CONTROLLERS
 $routes = [
     /** LOJA */
    'home' => 'main@index',
    'loja' => 'main@loja',
    'checkout'=>'main@checkout_carrinho',
    'produto'=>'main@produto',
   
    /**CARRINHO */
    'carrinho'=>'carrinho@carrinho',
    'adiciona_carrinho'=> 'carrinho@adiciona_carrinho',
    'limpar_carrinho'=> 'carrinho@limpar_carrinho',
    'remove_item' => 'carrinho@remove_item',

    /** CLIENTE */
    'minha-conta'=>'main@minha_conta',
    'sair'=>'main@logout',
    'login'=> 'main@login',
    'autenticacao'=>'main@logar',
    'cadastro'=>'main@cadastro',
    'cadastrar'=>'main@cadastrar',
    'confirm-cadastro'=>'main@confirmar_cadastro'
 ];

 $action = 'home';

 if(isset($_GET['a'])) {

     if(!key_exists($_GET['a'],$routes)){
          $action = 'home';
     }else {
          $action = $_GET['a'];
     }
 }

$parts = explode('@',$routes[$action]);
$controller = ucfirst($parts[0]);
$controller = "core\\controllers\\".$controller;
$method = $parts[1];

$ctrl = new $controller();
$ctrl->$method();


