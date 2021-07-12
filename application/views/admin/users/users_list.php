<div class="card card-primary card-outline">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('admin/Users/create'), 'Tambah Akun', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/Users/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                            ?>
                                <a href="<?php echo site_url('admin/Users'); ?>" class="btn btn-default">Reset</a>
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
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody><?php
                        foreach ($users_data as $users) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo ++$start ?></td>
                            <td><?php echo $users->username ?></td>
                            <td><?php echo $users->nama ?></td>
                            <td><?php echo $users->level ?></td>
                            <td style="text-align:center" width="200px">
                                <a href="<?php echo ('admin/Users/update/' . urlencode($users->username)) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                &nbsp;
                                <a href="<?php echo ('admin/Users/delete/' . urlencode($users->username)) ?>" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm('Anda yakin ingin menghapus akun ini ?')"><i class="fa fa-trash"></i></a>
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