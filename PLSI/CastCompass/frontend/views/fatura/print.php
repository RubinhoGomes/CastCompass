
<script>
  window.print();
</script>

<!-- Fatura Start -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                    <h4 class="float-end font-size-15">Fatura #<?= $fatura->id ?> <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">Cast&Compass</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">Morada da Empresa</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> xyz@987.com</p>
                            <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Faturado Para:</h5>
                                <h5 class="font-size-15 mb-2"><?= Yii::$app->user->identity->username ?></h5>
                                <p class="mb-1"> <?= Yii::$app->user->identity->profile->morada ?> </p>
                                <p class="mb-1"><?= Yii::$app->user->identity->email ?></p>
                                <p><?= Yii::$app->user->identity->profile->telemovel ?></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Fatura No:</h5>
                                    <p>#<?= $fatura->id?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Data da Fatura:</h5>
                                    <p><?= Yii::$app->formatter->asDate($fatura->data)?></p>
                                </div> 
                           </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Informação da Fatura</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Nome do Item</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <?php
                                      $i = 1;
                                      foreach ($fatura->linhafaturas as $linha) {
                                    ?>
                                      <tr>
                                      <th scope="row"> <?=$i?> </th>
                                        <td>
                                            <div>
                                            <h5 class="text-truncate font-size-14 mb-1"><?= $linha->produto->nome?></h5>
                                            </div>
                                        </td>
                                        <td><?= number_format($linha->produto->preco, 2, ',', '.')?>€</td>
                                        <td><?= $linha->quantidade ?></td>
                                        <td class="text-end"><?= number_format($linha->valor, 2, ',', '.')?>€</td>
                                    </tr>
                                    <?php
                                      $i++;
                                      }
                                    ?>
                                              
                                  <!-- end tr -->
<!-- Shiping Details
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Shipping Charge :</th>
                                        <td class="border-0 text-end">$20.00</td>
                                    </tr> -->
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Iva</th>
                                            <td class="border-0 text-end"><?= number_format($fatura->ivaTotal, 2, ',', '.')?>€</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold"><?= number_format($fatura->valorTotal, 2, ',', '.') ?>€</h4></td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div>

<!-- Fatura End -->
