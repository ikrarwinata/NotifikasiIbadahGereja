<div class="card">
    <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="username">Username <?php echo (form_error('username') . "&nbsp;" . $this->session->userdata('err_username')) ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" required/>
            </div>
            <div class="form-group">
                <label for="varchar">Password <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Kosongkan jika tidak ingin merubah password" value="" />
            </div>
            <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
            </div>
            <div class="form-group">
                <label for="enum">Level <?php echo form_error('level') ?></label>
                <select name="level" id="level" class="form-control">
                    <option value="superadmin" <?php echo (input_select($level, "superadmin")) ?>>Super Administrator</option>
                    <option value="admin" <?php echo (input_select($level, "admin")) ?>>Administrator</option>
                </select>
            </div>
            <input type="hidden" name="oldusername" value="<?php echo $oldusername; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> &nbsp;
            <a href="<?php echo site_url('admin/Users') ?>" class="btn btn-default">Batalkan</a>
        </form>
    </div>
</div>