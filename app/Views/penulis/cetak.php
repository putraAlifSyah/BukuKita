<html>
<head>
	<title>CETAK DATA DARI DATABASE DENGAN CODIGNITER4</title>
</head>
<body>
	<center>
		<h2>DATA LAPORAN PENULIS</h2>
		<h4>M PUTRA ALIF SYSTEMPATH</h4>
	</center>
 
	<table border="1" style="width: 100%">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Tanggal Lahir</th>
			<th>Alamat</th>
			<th>Motto</th>
			<th>Tanggal Dimasukkan</th>
		</tr>
        <?php $no=1;  ?>
        <?php foreach($penulis as $b) : ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $b['nama']; ?></td>
			<td><?php echo $b['tanggal_lahir']; ?></td>
			<td><?php echo $b['alamat']; ?></td>
			<td><?php echo $b['motto']; ?></td>
			<td><?php echo $b['created_at']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>