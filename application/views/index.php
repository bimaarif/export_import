<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title><?= $title; ?></title>
  </head>
  <body>
     
     <div class="container">
         <div class="row mt-2">
            <div class="col"> 
                 <div class="card">
                     <div class="card-body">
                        <?= form_open_multipart('exportimport/uploaddata'); ?>
                            <div class="form-row">
                                <div class="col-4">
                                  <input type="file" class="form-control-file" id="uploadexcel" name="importexcel" accept=".xlsx,.xls">
                                </div>
                                <div class="col">
                                  <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                                <div class="col">
                                  <?= $this->session->flashdata('pesan'); ?>  
                                </div>
                            </div>
                        <?= form_close(); ?>
                     </div>
                 </div>

                 <div class="card mt-2">
                     <div class="card-body">
                            <form class="mb-4" method="GET" action="">
                              <div class="row">
                                <div class="col-3">
                                  <input type="date" class="form-control" name="tanggalawal">
                                </div>
                                <div class="col-3">
                                  <input type="date" class="form-control" name="tanggalakhir">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                              </div>
                            </form> 
                            <?php 
                           
                              $tanggalawal  = $this->input->get('tanggalawal'); 
                              $tanggalakhir = $this->input->get('tanggalakhir');

                            ?>
                    <?php if(!$tanggalawal && !$tanggalakhir): ?>        
                          <a href="<?= base_url('Exportimport/mpdf'); ?>" class="btn btn-danger">Export PDF</a>
                          <a href="<?= base_url('Exportimport/excel'); ?>" class="btn btn-success">Export Excel</a>
                          <a href="<?= base_url('Exportimport/highchart'); ?>" class="btn btn-info">Export Grafik</a>
                          <h4 class="text-center mt-2">Laporan barang masuk tanggal <?= date('d F Y'); ?></h4>
                    <?php else : ?>
                          <a href="<?= base_url('Exportimport/mpdf?tanggalawal='.$tanggalawal.'&tanggalakhir='.$tanggalakhir); ?>" class="btn btn-danger">Export PDF</a>
                          <a href="<?= base_url('Exportimport/excel?tanggalawal='.$tanggalawal.'&tanggalakhir='.$tanggalakhir); ?>" class="btn btn-success">Export Excel</a>
                          <a href="<?= base_url('Exportimport/highchart?tanggalawal='.$tanggalawal.'&tanggalakhir='.$tanggalakhir); ?>" class="btn btn-info">Export Grafik</a>
                          <h4 class="text-center mt-2">Laporan barang masuk tanggal <?= $tanggalawal .'s/d'.$tanggalakhir ?></h4>      
                    <?php endif; ?>   
                     </div>
                 </div>

                 <div class="card mt-2">
                     <div class="card-body">
                         <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">kode barang</th>
                                  <th scope="col">nama barang</th>
                                  <th scope="col">jumlah</th>
                                  <th scope="col">Tanggal Masuk Barang</th>
                                   <th scope="col">aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i = 1; foreach($semuabarang as $barang) : ?>  
                                <tr>
                                  <th scope="row"><?= $i++; ?></th>
                                  <td><?= $barang['kode_barang']; ?></td>
                                  <td><?= $barang['nama_barang']; ?></td>
                                  <td><?= $barang['jumlah']; ?></td>
                                  <td><?= date('d F Y',$barang['data_created']); ?></td>
                                  <td>
                                      <a href="<?= base_url('exportimport/qrcode/'.$barang['kode_barang']); ?>" class="btn btn-warning" target="_blank">Qr Code</a>
                                       <a href="<?= base_url('exportimport/barcode/'.$barang['kode_barang']); ?>" class="btn btn-info" target="_blank">BarCode</a>
                                  </td>
                                </tr>
                              <?php endforeach; ?>   
                              </tbody>
                        </table>
                     </div>
                 </div>
             </div> 
         </div>
     </div>
    
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>