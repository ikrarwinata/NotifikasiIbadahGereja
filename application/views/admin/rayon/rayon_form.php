<div class="card">
    <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Rayon <?php echo form_error('rayon') ?></label>
                <input type="text" class="form-control" name="rayon" id="rayon" placeholder="Rayon" value="<?php echo $rayon; ?>" />
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> &nbsp;
            <a href="<?php echo site_url('admin/Rayon') ?>" class="btn btn-default">Batalkan</a>
        </form>
    </div>
</div>