<div class="container">
     <div class="row justify-content-center my-3">
       <h5>Histórico de pedidos</h5>
        <div>

            <table id="table" class="table table-striped">
                <thead>
                    <th>Pedido Nº</th>
                    <th>Data Pedido</th>
                    <th>Status</th>
                    <th>Valor</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $pedidos[0]->cod_pedido?></td>
                        <td><?= $pedidos[0]->data_pedido?></td>
                        <td><?= $pedidos[0]->status_pedido?></td>
                        <td>R$ <?= number_format($pedidos[0]->valor_pedido,2,",",".")?></td>
                    </tr>
                </tbody>
            </table>
        </div>

     </div>
</div>