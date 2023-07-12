<div class="container">
  <div class="row justify-content-center py-3">
    <div class="col-sm-4  mb-5">
         <h4 class="text-center">Cadastre-se</h4>
          <?php if(isset($_SESSION['error'])) : ?>
                    <?php foreach($_SESSION['error'] as $error) : ?>
           <div class="alert alert-danger my-2">
                <?= $error;?>
           </div>
           <?php endforeach;?>
        <?php endif; ?>
     <form class="form-signin" action="?a=cadastrar" method="POST">
       <div class="my-3  form-label-group">
        <input type="text" name="u_name" class="form-control" placeholder="" required autofocus>
        <label>Nome Completo</label>
      </div>
       <div class="my-3 form-label-group">
        <input type="email" name="u_email" class="form-control" placeholder="" required>
        <label>E-mail</label> 
      </div>
       <div class="my-3 form-label-group">
        <input type="password" name="u_pass" class="form-control" placeholder="" required>
        <label>Senha</label>
      </div>
       <div class="my-3 form-label-group">
        <input type="password" name="u_confirm" class="form-control" placeholder="" required>
        <label>Confirme sua senha</label>
      </div>
       <hr>
          <h4 class="text-center">Endereço e contato</h4>
       <div class="my-3 form-label-group">
          <input type="text" name="u_endereco" class="form-control" placeholder="" required>
          <label>Endereço</label>
         </div>
       <div class="my-3 form-label-group">
          <input type="text" name="u_cidade" class="form-control" placeholder="" required>
          <label>Cidade </label>
         </div>
       <div class="my-3 form-label-group">
          <input type="tel" name="u_telefone" class="form-control" placeholder="" required>
          <label>Contato whatsapp</label>
         </div>
       <div class="my-3  py-3">
        <input type="checkbox" class="text-start" name="u_checkbox" required>
        <a href="" class="m-2"> concordo com os termos de uso</a>
       </div>
       <div class="my-3 py-3">
       <input class="btn btn-primary flex-end" type="submit" value="Criar conta">
       </div>
     </form>
     
    </div>
  </div>
</div>
<?php unset($_SESSION['error']);?>
