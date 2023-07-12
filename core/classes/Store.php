<?php 

namespace core\classes;
use core\Main;

 class Store {

    public static function Layout($arr, $dados = null){
         
        if(!is_array($arr)) {
             throw new Exception("Error Processing Request Layout Class Store", 1);    
        }

        if(!empty($dados) && is_array($dados)) {
              extract($dados);
        }

        foreach($arr as $files) {
             include('../core/views/'.$files.".php");
        }
    }
  //verifica se tem cliente logado
    public static function clientSession(){
             return isset($_SESSION['client']);
     }
      //redirect
     public static function redirect($page = '') {
       header('Location:'.BASE_URL."?a=".$page); exit();
   }
    //cria hash para o PURL ( Persnal URL ) para verificar email
     public static function criarHash($caracters = 12) {
       $chars = '0123456789abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ';
        return substr(str_shuffle($chars),0,$caracters);
    }
    
     /**cria número de pedido no checkout */
    public static function gera_num_pedido(){
    
      $cod = " ";
      $chars = "ABCDEFGHIJKLMNOPQRSTUVXYWZABCDEFGHIJKLMNOPQRSTUVXYWZABCDEFGHIJKLMNOPQRSTUVXYWZ";
      $cod   .= substr(str_shuffle($chars),0,2);
      $cod   .= rand(100000, 999999);
      return $cod;

    }
 }
