<?php $pagamento_total = 0 ; ?>
 <div class="container mb-80">
    <div class="row">
        <div class="col my-3">
            <h2>Confirmação e pagamento</h2>
        </div>
     </div>
     <div class="row">
            <div class="col-9 offset-1">
             <table class="table">
                 <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                 </tr>
                <tbody>
                    <?php foreach($carrinho as $produto) : ?>
                          <?php $pagamento_total +=$produto['preco']; ?>
                        <tr>
                            <td><?= $produto['titulo']?></td>
                            <td> x <?= $produto['quantidade']?></td>
                            <td> R$<?= number_format($produto['preco'],2,",",".")?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody> 
             </table>

            </div>
    </div>
    <div class="row m-3">
    <div class="col mb-3">
    <h4 class="bg-dark p-2 text-light"><i class="fa-solid fa-credit-card"></i> Dados para pagamento</h4>
       <p>Pedido N° - <?= $_SESSION['cod_pedido']?></p>
       <p>Forma de pagamento</p>
       <p>Valor Total <strong>R$ <?= number_format($pagamento_total,2,",",".")?> </strong></p>
    </div>
   </div>

      <div class="row m-3">
        <h4 class="bg-dark p-2 text-light"><i class="fas fa-clipboard-list"></i> Dados do comprador</h4>
        <div class="col mb-3">
            <label class="form-label" for="">Nome:</label>
            <input class="form-control" type="text" value="<?= $pessoa->nome?>" disabled>
            <label class="form-label" for="">E-mail:</label>
             <input class="form-control" type="text" value="<?= $pessoa->email?>" disabled>
            <p>Telefone: <input class="form-control" type="text" value="<?= $pessoa->telefone?>" disabled></p>
        </div>
         <div class="col mb-3">
         <label class="form-label" for="">Documento</label>
            <input class="form-control" type="text" value="00.000.000-00" disabled>
         </div>
     </div>
     <div class="row m-3">
        <h4 class="bg-dark p-2 text-light"><i class="fas fa-truck"></i> Endereço de entrega</h4>
        <div class="col mb-3">
         <label class="form-label" for="">Endereço</label>
            <input class="form-control" type="text" value="<?= $pessoa->endereço?>, 50" disabled>
         <label class="form-label" for="">Cidade</label>
            <input class="form-control" type="text" value="<?= $pessoa->cidade?>" disabled>
        </div>
            <div class="col mb-3">
             <label class="form-label" for="">Cep</label>
                <input class="form-control" type="text" value="00000-000" disabled>
            </div>
            <div class="col mb-3">
            <label class="form-label" for="">UF</label>
            <input class="form-control" type="text" value="UF" disabled>
            </div>
       
            <div class="my-3">
                <div class="form-group">
                    <input type="checkbox" name="edit_endereco" id="edit_endereco">
                    <label for="edit_endereco">Alterar endereço da entrega</label>
                </div>
            </div>
      </div>

      <div class="row m-3">
        <div class="col">
            <div id="novo_endereco">
                Novo endereco
            </div>
        </div>
      </div>
</div>
<script>
  edit_endereco.addEventListener("click", (evt)=> {
    
      let novo_endereco = document.getElementById("novo_endereco");
       if(evt.target.checked) {
           novo_endereco.setAttribute("style","display:block");
       }else {
            novo_endereco.setAttribute("style","display:none");
       }
  });


</script>
