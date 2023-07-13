<?php 
  namespace  core\controllers;
  use core\classes\Store;
  use core\classes\Database;
  use core\models\Pessoa;
  use core\classes\Email;
  use core\models\Produto;
  use core\models\Pedido;


 class Main {

    public function index(){

       $produto    = new Produto();
       $categorias = $produto->getCategorias();

       $_arg = [];
       foreach($categorias as $id_cate) {
          array_push($_arg, $id_cate->id_categoria);
       }

      $c = '';

      if(isset($_GET['_cat'])) {
           $get = base64_decode($_GET['_cat']);
           if(in_array($get, $_arg)){
            $c = base64_decode($_GET['_cat']);
           } 
      }
        
      $produtos = $produto->getProdutos($c);
      
       $data = ['title'=> APP_NAME." ".APP_VERSION,
                'produto' => $produtos,
                'categorias'=>$categorias,
                'nome_categoria'=> !empty($c) ? $produto->nome_categoria($c)->nome : 'Todos',
               ];

       Store::Layout([
          'layouts/html_header', 
          'layouts/header',
          'home',
          'layouts/footer',
          'layouts/html_footer'
        ], 
        $data);
    }

  public function loja(){

      $data = ['title'=> APP_NAME." ".APP_VERSION];
      Store::Layout([
        'layouts/html_header', 
        'layouts/header',
        'loja',
        'layouts/footer',
        'layouts/html_footer'
      ], 
      $data);
  }


    public function login(){

      if(Store::clientSession()){
        $this->index(); return;
      }

      $data = ['title'=> APP_NAME." ".APP_VERSION];
      Store::Layout([
        'layouts/html_header', 
        'layouts/header',
        'login',
        'layouts/footer',
        'layouts/html_footer'
      ], 
      $data);
    }

  public function minha_conta(){

      $data = ['title'=> APP_NAME." ".APP_VERSION];
      Store::Layout([
        'layouts/html_header', 
        'layouts/header',
        'minha-conta',
        'layouts/footer',
        'layouts/html_footer'
      ], 
      $data);
  }

    public function cadastro() {

      if(Store::clientSession()){
          $this->index(); return;
      }

      $data = ['title'=> APP_NAME." ".APP_VERSION];
      Store::Layout([
        'layouts/html_header', 
        'layouts/header',
        'cadastro',
        'layouts/footer',
        'layouts/html_footer'
      ], 
      $data);
       
    }
    public function cadastrar(){
          //verifica ao enviar form se tem sessão
      if(Store::clientSession()){
        $this->index(); return;
      }
        //verifica se dados vieram do form
      if($_SERVER['REQUEST_METHOD'] != 'POST'){
        $this->index(); return;
      }

      if($_POST['u_pass'] !== $_POST['u_confirm']){
         
            $_SESSION['error'][] = '*Senhas não conferem';
           
      }
      if(strlen($_POST['u_name']) < 5 ) {
            $_SESSION['error'][] = '*Campo nome precisa ser completo';
      }
      if(isset($_SESSION['error'])){
           $this->cadastro(); return;
      }

    
     /** verifica se existe o email passado na base */
      $email = [':email' => $_POST['u_email']];
      if(Pessoa::verificaEmail($email[':email'])) {
          $_SESSION['error'][] ='*Já existe uma conta cadastrada nesse e-mail '.$email[':email'];
          $this->cadastro(); return;
        }

      /** cadastro pessoa */  

       $purl = @Pessoa::cadastroPessoa();
       $this->confirmar_cadastro();
       //DADOS A VRIFICAR;
      // Email::confirmacao_email("email@email");
       echo "Link de confirmação enviado por e-mail";

      // $link_purl = "http://http://localhost/projeto_lojaWeb/public/?a=confirmacao_email&auth=".$purl;
   
      }

    public function confirmar_cadastro(){


      $data = ['title'=> APP_NAME." ".APP_VERSION];
      Store::Layout([
        'layouts/html_header', 
        'layouts/header',
        'confirm-cadastro',
        'layouts/footer',
        'layouts/html_footer'
      ], 
      $data);
    }
      //==============Logar

      public function logar(){

        if(Store::clientSession()){
          $this->index(); return;
        }

         if($_SERVER['REQUEST_METHOD'] != 'POST'){
              $this->index(); return;
         }

         if(!isset($_POST['u_email']) || !isset($_POST['u_pass']) || !filter_var(trim($_POST['u_email']), FILTER_VALIDATE_EMAIL)) {
             $_SESSION['error'][] = '*Campo E-mail ou senha não podem ser vazios';
             $this->login();return;
         }

          $senha = $_POST['u_pass'];
          $email = $_POST['u_email'];
         
          $usuario = Pessoa::logarPessoa($email, $senha);
         if(is_bool($usuario)) {
               $_SESSION['error'][] = '*E-mail ou senha inválidos';
               Store::redirect('login');
         } else {

                 $_SESSION['client'] = $usuario->nome;
                 $_SESSION['id_client'] = $usuario->id;

                 if(isset($_SESSION['tmp_referrer'])){
                     unset($_SESSION['tmp_referrer']);
                     Store::redirect('checkout');
                 }

             
                Store::redirect('home');
         }

      }

      /** LOGOUT SESSION */

      public function logout(){

        if(Store::clientSession()){
           unset($_SESSION['client']);
           Store::redirect('home');
           return;
        }
           Store::redirect('home');
      }

     //checkou da loja
     public function checkout_carrinho(){

        if(!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
          Store::redirect('home');
          return;
        }

         if(!isset($_SESSION['client'])) {
          $_SESSION['tmp_referrer'] = true;
           Store::redirect('login');
           return;
         }

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

     $pessoa = Pessoa::dados_cliente($_SESSION['id_client']);

     if(!isset($_SESSION['cod_pedido'])) {
          $num_pedido = Store::gera_num_pedido();
          $_SESSION['cod_pedido'] = $num_pedido;
     }


    $data = [
       'title'=> APP_NAME." | Checkout ".APP_VERSION,
       'carrinho'=>$data_tmp,
       'pessoa'=>$pessoa
      ];
        Store::Layout([
          'layouts/html_header', 
          'layouts/header',
          'checkout',
          'layouts/footer',
          'layouts/html_footer'
        ], 
        $data);
      }

       //confirmacao do pedido
       public function confirmacao(){

            if(!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
                 Store::redirect('home');
                 return;
            }

            $ids = [];
         

            foreach($_SESSION['carrinho'] as $produto_id => $quantidade) {
              array_push($ids, $produto_id);
        
          }
          
              $ids = implode(",", $ids);
              $produto = new Produto();
              $result = $produto->lista_produtos_id($ids);

              //==================cria os dados da pedido
              $pedido = [];
             

              foreach($result as $produto ){
                    $pedido []= [
                      'id_produto'=>$produto->id_produto,
                      'nome_produto'=>$produto->nome_produto,
                      'valor_unitario'=>$produto->preco,
                      'quantidade'=>$_SESSION['carrinho'][$produto->id_produto]
                    ];
              }
              //==============================
              $dados_pedido = [
                  'id_cliente' => $_SESSION['id_client'],
                  'cod_pedido' => $_SESSION['cod_pedido'],
                  'valor'=> $_SESSION['valor_total'],
              ];
            
              $item_pedido = new Pedido();
              $id_pedido = $item_pedido->grava_pedido($dados_pedido, $pedido);
               //==============================
               
               //====== limpa as sessões
                unset( $_SESSION['cod_pedido']);
                unset( $_SESSION['valor_total']);
                unset ( $_SESSION['carrinho']);
                die("dados do pedido grvado com sucesso!...");
             

       }


      public function produto(){

      
         $id_produto = $_GET['_item'];

         if(!Produto::getProduto($id_produto)) {
          return Store::redirect('home');
       }
        $produto = Produto::dados_produto($id_produto);

        $data = [
           'title'=>APP_NAME,
          'produto'=>$produto
        ];

        Store::Layout([
          'layouts/html_header', 
          'layouts/header',
          'produto',
          'layouts/footer',
          'layouts/html_footer'
        ], 
        $data);
         
      }


}
