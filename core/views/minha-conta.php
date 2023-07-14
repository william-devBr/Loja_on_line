
<?php 

 if(isset($_GET['action'])) {
      
        @include($_GET['action'].".php");
 }else {
        @include('historico_pedido.php');
 }

?>