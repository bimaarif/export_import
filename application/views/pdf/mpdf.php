<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>cetak laporan barang masuk</title>
</head>
<body>
    Tanggal cetak : <?= date('d F Y'); ?>

    <table width="100%" style="border-collapse: collapse; border:1px solid;" cellpadding="8">
    	<thead>
    		<tr>
    			<th>No</th>
    			<th>Kode barang</th>
    			<th>Nama Barang</th>
    			<th>Jumlah</th>
    			<th>Tanggal Barang Masuk</th>
    		</tr>
    	</thead>
    	<tbody>
    	<?php 
    	   $no = 1;
    	   foreach($semuabarang as $barang) : 
    	?>	
    		<tr>
    			<td><?= $no; ?></td>
    			<td><?= $barang['kode_barang']; ?></td>
    			<td><?= $barang['nama_barang']; ?></td>
    			<td><?= $barang['jumlah']; ?></td>
    			<td><?= date('d F Y', $barang['data_created']); ?></td>
    		</tr>
    	<?php 
    	   $no++;
           endforeach; 
        ?>	
    	</tbody>
    </table>
</body>
</html>