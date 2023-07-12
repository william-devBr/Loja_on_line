<div class="container-fluid">
  <div class="row justify-content-center py-3">
    <div class="col-sm-3">
         <h4 class="text-center">Login</h4>
         <?php if(isset($_SESSION['error'])) : ?>
          <?php foreach($_SESSION['error'] as $error) : ?>
                <div class="alert alert-danger my-2">
                  <?= $error; ?>
                </div>
            <?php endforeach; endif; ?>    
       <form action="?a=autenticacao" method="POST" class="form-signin">
          <div class="my-3 form-label-group">
             <input type="email" class="form-control" name="u_email" id="" required autofocus>
             <label>E-mail:</label>
            </div>
          <div class="my-3  form-label-group">
             <input type="password" class="form-control" name="u_pass" id="" required>
             <label>Senha:</label>
            </div>
          <div class="my-3 w-vw">
             <input class="btn btn-primary btn-block " type="submit" value="Entrar" id="">
             <div class="flex flex-left">
              <a href="">esqueci a senha</a>
            </div>
            </div>
          
       </form>
       <hr>
       <div class="text-center">
          <p>Ainda não tem cadastro ?</p>
          <a href="?a=cadastro">Quero me cadastrar</a>
       </div>
    </div>
  </div>
</div>
<?php unset($_SESSION['error']);?>
