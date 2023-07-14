<div class="container mb-80">
  <div class="row">
     <div class="col-12 text-center my-4">
      <a href="?a=home&_cat=todos" class="btn btn-default"> Todos </a>
        <?php foreach($categorias as $cat) : ?>
          <a href="?a=home&_cat=<?=base64_encode($cat->id_categoria)?>" class="btn btn-default"> <?= $cat->nome ?> </a>
          <?php endforeach; ?>
          <h3 class="my-2 title-categoria"><?= $nome_categoria ?></h3>
      </div>
  </div>


  <?php if(count($produto) == 0): ?>
     <div class="row text-muted my-2 text-center">
        <h3>Não há produtos disponíveis</h3>
     </div>

    <?php else : ?>
  <div class="row">
  
  <?php foreach($produto as $item) : ?>
    
        <div class="col-sm-4 col-6 p-2">
          <div class="text-center p-3  produtos">
              <img class="img-fluid img-size" src="assets/images/produtos/<?= $item->url_imagem?>">
              <h5><a href="?a=produto&_item=<?=$item->id_produto?>"><?= $item->nome_produto?></a></h5>
              <h5>R$ <?= number_format($item->preco, 2,",",".")?></h5>
              <div>
                <?php if($item->estoque > 0): ?>
                <button onclick="adiciona_carrinho({id :<?= $item->id_produto?>, item : '<?= $item->nome_produto?> '});" class="btn btn-primary bt-cart" data-bs-toggle="modal" data-bs-target="#exampleModal">Adicionar <i class="fas fa-shopping-cart"> </i></button>
                <?php else: ?>
                  <span class="text-muted">indisponível</span>
                <?php endif; ?>
              </div>
            </div>
        </div>
  <?php endforeach; ?>  
  </div>
  <?php endif;?>
</div>