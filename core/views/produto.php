<div class="container mb-80">
    <div class="row my-3">
        <div class="col">
           <?php if($produto != null) : ?>
             <img class="img-fluid img-vw-100" src="assets/images/produtos/<?= $produto->url_imagem;?>">
            <?php endif; ?> 
        </div>
        <div class="col">
           <h4><?= $produto->nome_produto ?></h4>
           <p><?= $produto->descricao?> lorem ipsum donet klkadajd ajhd asdah hasdh ahdah dhad ahsd adhas dald asd</p>
            <div>
                <p>Preço </p>
                <h5>R$ <?= number_format($produto->preco,2,",",".") ?></h5>
            </div>
            <div class="col my-4">
                <button onclick="adiciona_carrinho(<?= $produto->id_produto?>);" class="btn btn-primary">Adicionar ao carrinho <i class="fas fa-shopping-cart"></i></button>
            </div>
        
        </div>
        
    </div>
</div>
