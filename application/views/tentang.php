<hr>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h5>Jumlah Jemaat</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="max-width: 45px;width: 40px">#</th>
                        <th class="text-center">Jenis Ibadah</th>
                        <th class="text-center">Jumlah Jemaat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 0;
                    foreach ($data_jemaat as $key => $value) : ?>
                        <tr>
                            <td class="text-center"><?php echo (++$counter) ?></td>
                            <td>Ibadah <?php echo (ucfirst($value->jenis)) ?></td>
                            <td class="text-center"><?php echo ($value->jumlah_jemaat) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <!--// Tentang Jabatan Dan Struktur Dalam Gereja -->
        
        

        <!--// Akhir Tentang Jabatan Dan Struktur Dalam Gereja -->
    </div>
</div>