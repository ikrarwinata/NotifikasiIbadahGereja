<div class="card">
    <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Hp <?php echo form_error('hp') ?></label>
                <input type="tel" class="form-control" name="hp" id="hp" placeholder="Hp" value="<?php echo $hp; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Jenis Ibadah <?php echo form_error('jenis_ibadah') ?></label>
                <select name="jenis_ibadah" id="jenis_ibadah" class="form-control select2bs4" style="width: 100%;">
                    <?php foreach ($data_jenis_ibadah as $key => $value) : ?>
                        <option value="<?php echo ($value->id) ?>" <?php echo (input_select($value->id, $jenis_ibadah)) ?>><?php echo ($value->jenis) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div style="margin: auto;">
                    <a href="<?php echo site_url('admin/Notifikasi') ?>" class="btn btn-default btn-lg">Batalkan</a> &nbsp;
                    <button type="submit" class="btn btn-primary btn-lg"><?php echo $button ?></button>
                </div>
            </div>
        </form>
    </div>
</div>