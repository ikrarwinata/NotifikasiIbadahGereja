<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
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
                    <a href="admin/Dashboard" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ibadah</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <?php foreach ($this->Jenis_ibadah_model->get_all() as $key => $value) : ?>
                            <li><a href="admin/Jadwal/index/<?php echo ($value->id) ?>" class="dropdown-item"><?php echo ($value->jenis) ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="admin/Tata_ibadah" class="nav-link">Tata Ibadah</a>
                </li>
                <li class="nav-item">
                    <a href="admin/Dashboard/report" class="nav-link">Laporan</a>
                </li>
                <li class="nav-item">
                    <a href="admin/Notifikasi" class="nav-link">Notifikasi</a>
                </li>
                <li class="nav-item">
                    <a href="admin/Dashboard/tentang" class="nav-link">Tentang</a>
                </li>
                <?php if ($this->session->userdata("level") == "superadmin") : ?>
                    <li class="nav-item">
                        <a href="admin/Users" class="nav-link">Akun Pengguna</a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="assets/dist/img/user.png" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"><?php echo (substr(ucfirst($this->session->userdata("nama")), 0, 25)) ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="assets/dist/img/user.png" class="img-circle elevation-2" alt="User Image">

                            <p>
                                <?php echo (ucfirst($this->session->userdata("nama"))) ?>
                                <small><?php echo (ucfirst($this->session->userdata("level"))) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="admin/Dashboard/profile" class="btn btn-default btn-flat">Profile</a>
                            <a href="logout" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>

    </div>
</nav>