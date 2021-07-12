<div class="card card-primary card-outline">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <a href="Welcome/cetak_jadwal/<?php echo ($id_jenis) ?>" target="_blank" class="btn btn-md btn-danger btn-outline-warning">Cetak Jadwal</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('Welcome/jadwal/' . $id_jenis); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                            ?>
                                <a href="<?php echo site_url('Welcome/jadwal/' . $id_jenis); ?>" class="btn btn-default">Reset</a>
                            <?php
                            }
                            ?>
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;table-layout: auto;">
                <thead>
                    <tr>
                        <th class="text-center" style="max-width: 45px;width: 40px">#</th>
                        <th>Kode</th>
                        <th>Rayon</th>
                        <th>Tanggal</th>
                        <th>Tempat Ibadah</th>
                        <th>Pemimpin Ibadah</th>
                    </tr>
                </thead>
                <tbody><?php
                        foreach ($jadwal_data as $jadwal) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo ++$start ?></td>
                            <td><?php echo $jadwal->kode ?></td>
                            <td><?php echo $jadwal->rayon ?></td>
                            <td><?php echo (get_str_day(date("d-m-Y", $jadwal->tgl)) . ", " . date("d M Y, H:i", $jadwal->tgl)) ?></td>
                            <td><?php echo $jadwal->tempat ?></td>
                            <td><?php echo $jadwal->pemimpin ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                Total Jadwal : <?php echo $total_rows ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>