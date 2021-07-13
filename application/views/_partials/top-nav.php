<nav class="main-header navbar navbar-expand-md navbar-dark navbar-orange">
    <div class="container">
        <a href="assets/index3.html" class="navbar-brand">
            <!-- <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <h2><span class="brand-text font-weight-light"><strong><?php echo ($this->db->where('nama', 'nama_aplikasi')->get('tentang')->row()->nilai) ?></strong></span></h2>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3 ml-lg-5" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="Welcome/index" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Jadwal Ibadah</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <?php foreach ($this->Jenis_ibadah_model->get_all() as $key => $value) : ?>
                            <li><a href="Welcome/jadwal/<?php echo ($value->id) ?>" class="dropdown-item"><?php echo ($value->jenis) ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="Welcome/tata_ibadah" class="nav-link">Tata Ibadah</a>
                </li>
                <li class="nav-item">
                    <a href="Welcome/tentang" class="nav-link">Tentang</a>
                </li>
                <li class="nav-item">
                    <a href="Welcome/login" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>