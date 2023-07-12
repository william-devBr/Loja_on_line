<?php 

 namespace core\models;
 use core\classes\Database;
 use core\classes\Store;

 class Pessoa {
     //confirmação de email da pessoa
      public static function verificaEmail($email) {
         
         $db = new Database();
         $email = [':email' => strtolower(trim($email))];
         $query = $db->select("SELECT email FROM clientes WHERE email = :email", $email);
      
          if(count($query) !== 0) {
              return true;
          }else {
            return false;
          }
    }
    //cadastrar
    public static function cadastroPessoa(){

        $purl = Store::criarHash();
        $params = [
            ':nome'=> filter_var(trim($_POST['u_name']), FILTER_SANITIZE_STRING),
            ':email' => strtolower(trim($_POST['u_email'])),
            ':senha'=> password_hash($_POST['u_pass'], PASSWORD_DEFAULT),
            ':cidade'=> filter_var($_POST['u_cidade'], FILTER_SANITIZE_STRING),
            ':endereco' => filter_var($_POST['u_endereco'], FILTER_SANITIZE_STRING),
            ':telefone' => $_POST['u_telefone'],
            ':verificacao'=> $purl,
            ':ativo'=> 0
        ];
        $db = new Database();

        $db->insert("INSERT clientes VALUES (0,:nome,:email,:senha,:cidade,:endereco,:telefone,:verificacao,:ativo,NOW(),NOW(),NULL)", $params);

        return $purl;
    }
     //logar
     public static function logarPessoa($email, $senha){

          if(!Pessoa::verificaEmail($email)) {
              return false;
          } else {

            $params = [
              ':email' => $email
            ];

            $db = new Database();
            $query = $db->select("
                        SELECT * FROM clientes 
                        WHERE email=:email 
                        AND ativo = 1
                        AND  delete_at IS NULL
                        ",$params);

            if(count($query) > 0){

                $usuario = $query[0];

                if(password_verify($senha,$usuario->senha)){
                     return $usuario;
                }else {
                    return false;
                }
               
            }else {
                return false;
            }
           
          }      
     } 
    //retorna da dos de um cliente da tabela
   public static function dados_cliente($id) {
        
     $sql = new Database();
     $params = [':id'=> $id];
     return $sql->select("SELECT nome,email,cidade,endereço,telefone FROM clientes WHERE id = :id", $params)[0];
   }
 }
