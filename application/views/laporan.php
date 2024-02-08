<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendukung Keputusan Metode MABAC</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
	.dempet{
  Margin-top: -20px
 }
</style>
<body>
<h1><center>PT WIDJAJA ANEKATAS CENTER</center></h1>
<h6 class="dempet"><center>Taman Tekno BSD sektor XI blok E-3 No.31 , Setu,15314</center></h6>
<h4><center>Hasil Akhir Perankingan</center></h4>
	</div>
	
<table border="1" width="100%">
	<thead>
		<tr align="center">
			<th>Alternatif</th>
			<th>Nilai</th>
			<th width="15%">Ranking</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			foreach ($hasil as $keys): ?>
		<tr align="center">
			<td align="left">
				<?php
				$nama_alternatif = $this->Perhitungan_model->get_hasil_alternatif($keys->id_alternatif);
				echo $nama_alternatif['nama'];
				?>
			
			</td>
			<td><?= $keys->nilai ?></td>
			<td><?= $no; ?></td>
		</tr>
		<?php
			$no++;
			endforeach ?>
	</tbody>
</table>
<script>
	window.print();
</script>
</body>
</html>