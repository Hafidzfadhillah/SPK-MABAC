<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Matriks Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif,$key->id_kriteria);
							echo $data_pencocokan['nilai'];
						?>
						</td>
						<?php endforeach ?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
					<tr align="center">
						<th colspan="2">MAX</th>
						<?php
							foreach ($kriteria as $key){
								$min_max=$this->Perhitungan_model->get_max_min($key->id_kriteria);
						?>
							<td><?= $min_max['max']; ?></td>
						<?php
							}
						?>
					</tr>
					<tr align="center">
						<th colspan="2">MIN</th>
						<?php
							foreach ($kriteria as $key){
								$min_max=$this->Perhitungan_model->get_max_min($key->id_kriteria);
						?>
							<td><?= $min_max['min']; ?></td>
						<?php
							}
						?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-daark"><i class="fa fa-table"></i> Normalisasi Matriks Keputusan (N)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif,$key->id_kriteria);
							$min_max=$this->Perhitungan_model->get_max_min($key->id_kriteria);
							if($min_max['jenis']=='Benefit'){
								echo @(($data_pencocokan['nilai']-$min_max['min'])/($min_max['max']-$min_max['min']));
							}else{
								echo @(($data_pencocokan['nilai']-$min_max['max'])/($min_max['min']-$min_max['max']));
							}
						?>
						</td>
						<?php endforeach ?>
					</tr>
					<?php
						$no++;
						endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Bobot Kriteria (W)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriteria as $key): ?>
						<td>
						<?php 
						echo $key->bobot;
						?>
						</td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-daark"><i class="fa fa-table"></i> Matriks Bobot Keputusan (V)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$nilai_b = $this->Perhitungan_model->get_nilai_v($keys->id_alternatif,$key->id_kriteria);
							echo $nilai_b['nilai'];
						?>
						</td>
						<?php endforeach ?>
					</tr>
					<?php
						$no++;
						endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-daark"><i class="fa fa-table"></i> Nilai Batas Matriks (G)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Nilai Batas</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($kriteria as $key){
							$nilai_g = $this->Perhitungan_model->get_nilai_g($key->id_kriteria);
					?>
						<tr align="center">
							<td><?= $key->kode_kriteria?></td>	
							<td><?= $key->keterangan?></td>	
							<td><?= $nilai_g['nilai'];?></td>	
						</td>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-daark"><i class="fa fa-table"></i> Matriks jarak alternatif dari daerah perkiraan perbatasan (Q)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$this->Perhitungan_model->hapus_hasil();
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php
						$t_q = 0;
						foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$nilai_b = $this->Perhitungan_model->get_nilai_v($keys->id_alternatif,$key->id_kriteria);
							$nilai_g = $this->Perhitungan_model->get_nilai_g($key->id_kriteria);
							echo $n_q = $nilai_b['nilai']-$nilai_g['nilai'];
							$t_q += $n_q;
						?>
						</td>
						<?php endforeach;
						$hasil_akhir = [
							'id_alternatif' => $keys->id_alternatif,
							'nilai' => $t_q
						];
						$this->Perhitungan_model->insert_nilai_hasil($hasil_akhir);
						?>
						<td><?=$t_q; ?></td>
					</tr>
					<?php
						$no++;
						endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
$this->load->view('layouts/footer_admin');
?>