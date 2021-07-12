<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Template by <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <span class="text-primary"><?php echo ($this->db->where('nama', 'nama_aplikasi')->get('tentang')->row()->nilai) ?></span> All rights reserved.
</footer>