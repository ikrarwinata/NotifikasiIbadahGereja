<div class="row mb-lg-5">
	<div class="col-xl-12 col-lg-12">
		<h5>Pilih Laporan Untuk Dicetak :</h5>
		<ul class="mt-5">
			<li>
				<a href="admin/Jadwal/cetak_semua" target="_blank">Cetak Semua Jadwal</a>
				<ul>
					<?php foreach ($this->Jenis_ibadah_model->get_all() as $key => $value) : ?>
						<li><a href="admin/Jadwal/cetak/<?php echo ($value->id) ?>" target="_blank">Cetak Jadwal Ibadah <?php echo ($value->jenis) ?> </a></li>
					<?php endforeach; ?>
				</ul>
			</li>
			<li><a href="admin/Tata_ibadah/cetak" target="_blank">Cetak Tata Ibadah</a></li>
		</ul>
	</div>
</div>