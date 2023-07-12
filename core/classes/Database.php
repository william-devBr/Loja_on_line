<?php
 /** CLASS DATA */

 namespace core\classes;
 use PDO;
 use Exception;


 class Database {
    /**CRUD PHP */
 
      private $conn;

     // 
      private function connect(){

        
          //CONNECT
           $this->conn = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT=> true)
           );

           //debug PDO

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }

      private function closeConect(){
           $this->conn = null;
      }

      // methods
      public function select($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(!preg_match("/^SELECT/i",$sql)){
             die("Error Processing Request for SELECT");
        }

           $this->connect();
              
            $results = null;

            try {
                    if(!empty($params)) {

                          $exec = $this->conn->prepare($sql);
                          $exec->execute($params);
                          $results = $exec->fetchAll(PDO::FETCH_CLASS);
                    } else {

                        $exec = $this->conn->prepare($sql);
                        $exec->execute();
                        $results = $exec->fetchAll(PDO::FETCH_CLASS);
                    }

            } catch (PDOException $e) {
               return false;        
            }

           $this->closeConect();
           return $results;
      }

      public function insert($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(!preg_match("/^INSERT/i",$sql)){
            die("Error Processing Request for INSERT");
       }

          $this->connect();
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }
      
      public function update($sql, $params = null){
        $sql = trim($sql);
        //apenas para debugs em ambiente de desenvolvimento
        if(!preg_match("/^UPDATE/i",$sql)){
            die("Error Processing Request for UPDATE");
       }

          $this->connect();
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }

      public function delete($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(!preg_match("/^DELETE/i",$sql)){
            die("Error Processing Request for DELETE");
       }

          $this->connect();
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }
      //STATEMENT
      public function statement($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(preg_match("/^(DELETE|UPDATE|SELECT|INSERT)/i",$sql)){
            die("Error Processing Request STATEMENT");
       }

          $this->connect();
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }
 }

 /*
  */
