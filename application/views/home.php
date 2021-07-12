<div class="row mb-lg-5">
	<div class="col-xl-12 col-lg-12">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="assets/sliders/<?php echo ($this->db->where('nama', 'slider1')->get('tentang')->row()->nilai) ?>" alt="First slide" style="width: 100%; max-width: 100% !important; max-height: 100% !important;">
					<div class="carousel-caption d-none d-md-block">
						<h3 class="text-orange">Visi</h3>
						<p class="text-orange"><strong><?php echo ($this->db->where('nama', 'visi')->get('tentang')->row()->nilai) ?></strong></p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="assets/sliders/<?php echo ($this->db->where('nama', 'slider2')->get('tentang')->row()->nilai) ?>" alt="Second slide" style="width: 100%; max-width: 100% !important; max-height: 100% !important;">
					<div class="carousel-caption d-none d-md-block">
						<h3 class="text-orange">Misi</h3>
						<p class="text-orange"><strong><?php echo ($this->db->where('nama', 'misi')->get('tentang')->row()->nilai) ?></strong></p>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>