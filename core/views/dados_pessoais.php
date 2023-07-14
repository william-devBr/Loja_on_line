<div class="container">
     <div class="row justify-content-center my-3">
       <h5>Dados pessoais</h5>
        <table class="table table-striped">
        <tr>
                <td class="text-end" width="40%">Nome:</td>
                <td width="60%"><strong><?= $dados_pessoais->nome?></strong></td>
            </tr>
            <tr>
                <td class="text-end" width="40%">Email:</td>
                <td width="60%"><strong><?= $dados_pessoais->email?></strong></td>
            </tr>
            <tr>
                <td class="text-end" width="40%">Cidade:</td>
                <td width="60%"><strong><?= $dados_pessoais->cidade?></strong></td>
            </tr>
            <tr>
                <td class="text-end" width="40%">Endereço:</td>
                <td width="60%"><strong><?= $dados_pessoais->endereço?></strong></td>
            </tr>
            <tr>
                <td class="text-end" width="40%">Telefone</td>
                <td width="60%"><strong><?= $dados_pessoais->telefone?></strong></td>
            </tr>
        </table>
         <div class="col">
            <a href="" class="btn"><i class="far fa-edit"></i> Editar dados pessoais</a>
         </div>

     </div>
</div>