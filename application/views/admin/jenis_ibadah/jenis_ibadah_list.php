<div class="card card-primary card-outline">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('admin/Jenis_ibadah/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/Jenis_ibadah/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                            ?>
                                <a href="<?php echo site_url('admin/Jenis_ibadah'); ?>" class="btn btn-default">Reset</a>
                            <?php
                            }
                            ?>
                            <button class="btn btn-primary" type="submit">Search</button>
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
                        <th>Jenis</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody><?php
                        foreach ($jenis_ibadah_data as $jenis_ibadah) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo ++$start ?></td>
                            <td><?php echo $jenis_ibadah->jenis ?></td>
                            <td style="text-align:center" width="200px">
                                <a href="<?php echo ('admin/Jenis_ibadah/update/' . $jenis_ibadah->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                &nbsp;
                                <a href="<?php echo ('admin/Jenis_ibadah/delete/' . $jenis_ibadah->id) ?>" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash"></i></a>
                            </td>
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
                Total Record : <?php echo $total_rows ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>