
<div class="container p-1">
  <div class="row">
    <div class="col-12 my-3 mb-80">
         <h4 class=""><i class="fas fa-shopping-cart"></i> Carrinho de compras</h4>
      
     <?php if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho'])> 0):    ?>
        <?php $total_amount = $total_amount; ?>
          <div class="row mb-80 py-3">
            
             <table class="table">
              <thead>
                <tr>
                <th></th>
                <th>PRODUTO</th>
                <th>QUANTIDADE</th>
                <th class="text-end">VALOR</th>
                <th class="text-end"></th>
                </tr>
               </thead>
              <tbody class="">

              <?php
                if($carrinho != null) :
                     foreach($carrinho as $cart) :   ?>
             
                    <tr class="justify-content-center align-items-center">
                      <td><img class="img-thumbnail img-fluid img-responsive" src="assets/images/produtos/<?= $cart['imagem']?>" alt=""></td>
                      <td class="align-middle"><a href="?a=produto&_item=<?=$cart['id_produto']?>"><?= $cart['titulo']?></a></td>
                      <td class="align-middle">x <?= $cart['quantidade']?></td>
                      <td class="text-end align-middle">R$ <?= number_format($cart['preco'],2,",",".") ?></td>
                      <td class="text-end align-middle">
                        <button class="btn btn-sm btn-danger" onclick="remove_item(this)" data-id="<?= $cart['id_produto']?>"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>

                 <?php endforeach;  ?>
              </tbody>
             </table> 
             <div class="row">
              <div class="text-end">
              <div class="">
                <h4>Total R$ <?= number_format($total_amount,2,",",".") ?></h4>
              </div>
             </div>
             <?php endif; ?>
             <div class="row my-5">
        
             <div class="col">
                  <button onclick="limpar_carrinho();" class="btn btn-warning btn-checkout" id="btn-limpar-carrinho">Limpar carrinho</button>
              </div>
              <div class="col confirm text-start">
                 <p>Deseja limpar o carrinho ?</p>
                  <button class="btn btn-sm btn-primary">NÃO</button>
                  <a class="ms-3" href="?a=limpar_carrinho">SIM</a>
              </div>
             <div class="col text-end">
               <a href="?a=checkout" class="btn btn-success btn-checkout">Prosseguir</a>
              </div>
              </div>

            </div>
          </div>
          
      <?php else : ?>
        <div class="row">
          <div class="text-muted">
              <h4 class="text-center">Seu carrinho está vazio ! :( </h4>
          </div>
        </div>
      <?php endif; ?>
       </div>
  </div>
</div>
