<div class="card">
    <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Jenis Ibadah <?php echo form_error('jenis') ?></label>
                <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="<?php echo $jenis; ?>" />
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> &nbsp;
            <a href="<?php echo site_url('admin/Jenis_ibadah') ?>" class="btn btn-default">Batalkan</a>
        </form>
    </div>
</div>