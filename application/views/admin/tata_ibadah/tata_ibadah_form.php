<div class="card">
    <div class="card-body">
        <?php echo (form_open_multipart($action)) ?>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                    <div class="form-group">
                        <label for="kode">Kode<?php echo form_error('jenis') ?></label>
                        <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu <?php echo form_error('waktu') ?></label>
                        <div class="input-group date" id="waktu" data-target-input="nearest">
                            <input type="text" name="waktu" id="waktu" class="form-control datetimepicker-input" data-target="#waktu" value="<?php echo ($waktu!=NULL? date('d/m/Y H:i', $waktu):NULL); ?>" />
                            <div class="input-group-append" data-target="#waktu" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file_path">File <?php echo form_error('file_path') ?></label>
                        <input type="file" accept="*" name="file" class="form-control">
                    </div>
                    <input type="hidden" name="oldkode" value="<?php echo $kode; ?>" />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 text-center align-center" style="padding-top: 80px;">
                    <button type="submit" class="btn btn-primary btn-lg" style="margin: auto;"><?php echo $button ?></button>
                    <br>
                    <br>
                    <a href="<?php echo site_url('admin/Tata_ibadah/index') ?>" class="btn btn-default btn-lg">Batalkan</a>
                </div>
            </div>


        </form>
    </div>
</div>