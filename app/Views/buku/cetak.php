<html>
<head>
	<title>CETAK DATA DARI DATABASE DENGAN CODIGNITER4</title>
</head>
<body>
	<center>
		<h2>DATA LAPORAN BUKU</h2>
		<h4>M PUTRA ALIF SYSTEMPATH</h4>
	</center>
 
	<table border="1" style="width: 100%">
		<tr>
			<th>No</th>
			<th>Judul</th>
			<th>Penulis</th>
			<th>Penerbit</th>
			<th>Sinopsis</th>
			<th>Tanggal Dimasukkan</th>
		</tr>
        <?php $no=1;  ?>
        <?php foreach($buku as $b) : ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $b['judul']; ?></td>
			<td><?php echo $b['penulis']; ?></td>
			<td><?php echo $b['penerbit']; ?></td>
			<td><?php echo $b['sinopsis']; ?></td>
			<td><?php echo $b['created_at']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>