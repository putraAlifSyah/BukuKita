<html>
<head>
	<title>CETAK DATA DARI DATABASE DENGAN CODIGNITER4</title>
</head>
<body>
	<center>
		<h2>DATA LAPORAN DONATUR</h2>
		<h4>M PUTRA ALIF SYSTEMPATH</h4>
	</center>
 
	<table border="1" style="width: 100%">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telpon</th>
			<th>Tanggal Dimasukkan</th>
		</tr>
        <?php $no=1;  ?>
        <?php foreach($donatur as $b) : ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $b['nama']; ?></td>
			<td><?php echo $b['alamat']; ?></td>
			<td><?php echo $b['telpon']; ?></td>
			<td><?php echo $b['created_at']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>