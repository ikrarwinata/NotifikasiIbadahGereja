<div class="card">
    <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                    <div class="form-group">
                        <label for="jenis">Jenis Ibadah<?php echo form_error('jenis') ?></label>
                        <select name="jenis" id="jenis" class="form-control select2bs4" style="width: 100%;">
                            <?php foreach ($data_jenis_ibadah as $key => $value) : ?>
                                <option value="<?php echo ($value->id) ?>" <?php echo (input_select($value->id, $jenis)) ?>><?php echo ($value->jenis) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode Jadwal<?php echo form_error('jenis') ?></label>
                        <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="rayon">Rayon <?php echo form_error('rayon') ?></label>
                        <select name="rayon" id="rayon" class="form-control select2bs4">
                            <?php foreach ($data_rayon as $key => $value) : ?>
                                <option value="<?php echo ($value->id) ?>" <?php echo (input_select($value->id, $rayon)) ?>><?php echo ($value->rayon) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl">Waktu <?php echo form_error('tgl') ?></label>
                        <div class="input-group date" id="tgl" data-target-input="nearest">
                            <input type="text" name="tgl" id="tgl" class="form-control datetimepicker-input" data-target="#tgl" value="<?php echo ($tgl != NULL ? date('d/m/Y H:i', $tgl) : NULL); ?>" />
                            <div class="input-group-append" data-target="#tgl" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat Ibadah<?php echo form_error('tempat') ?></label>
                        <textarea class="form-control" rows="3" name="tempat" id="tempat" placeholder="Tempat Ibadah"><?php echo $tempat; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pemimpin">Pemimpin Ibadah<?php echo form_error('pemimpin') ?></label>
                        <textarea class="form-control" rows="3" name="pemimpin" id="pemimpin" placeholder="Pemimpin Ibadah"><?php echo $pemimpin; ?></textarea>
                    </div>
                    <input type="hidden" name="oldkode" value="<?php echo $kode; ?>" />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 text-center align-center" style="padding-top: 260px;">
                    <button type="submit" class="btn btn-primary btn-lg" style="margin: auto;"><?php echo $button ?></button>
                    <br>
                    <br>
                    <a href="<?php echo site_url('admin/Jadwal/index') ?>" class="btn btn-default btn-lg">Batalkan</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                    <div class="form-group">
                        <label for="pesan">Pesan Notifikasi<?php echo form_error('pemimpin') ?></label>
                        <textarea class="form-control" rows="5" name="pesan" id="pesan" placeholder="Tuliskan pesan yang akan dikirim"><?php echo $pesan; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <h5>Parameter yang tersedia :</h5>
                    <ul>
                        <li>%{jenis_ibadah} <strong>Jenis Ibadah</strong></li>
                        <li>%{rayon_ibadah} <strong>Rayon Ibadah</strong></li>
                        <li>%{tempat_ibadah} <strong>Tempat Ibadah</strong></li>
                        <li>%{pemimpin_ibadah} <strong>Pemimpin Ibadah</strong></li>
                        <li>%{hp_jemaat} <strong>Nomor HP Jemaat</strong></li>
                        <li>%{nama_jemaat} <strong>Nama Jemaat</strong></li>
                        <li>%{tanggal_jadwal} <strong>Waktu Jadwal Ibadah</strong></li>
                        <li>%{tanggal} <strong>Waktu Saat Terkirim</strong></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>