<!doctype html>
<html>

<head>
    <title>Tata Ibadah</title>
    <base href="<?php echo (base_url()) ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <style>
        .word-table {
            border: 1px solid black !important;
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            border: 1px solid black !important;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <div class="wraper">
        <div class="content-wraper">
            <div class="content">
                <div class="container">
                    <h2 class="mt-lg-5 mb-5">Tata Ibadah</h2>
                    <strong class="mb-lg-5">Tanggal Cetak :</strong> <?php echo (date("d M Y")) ?>
                    <hr class="clearFix">
                    <div class="table-responsive">
                        <table class="table word-table" style="width: 100%; border-collapse: collapse;table-layout: auto;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="max-width: 45px;width: 40px">#</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Dokumen</th>
                                </tr>
                            </thead>
                            <tbody><?php
                                    foreach ($tata_ibadah_data as $tata_ibadah) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo ++$start ?></td>
                                        <td><?php echo $tata_ibadah->kode ?></td>
                                        <td><?php echo (get_str_day(date("d-m-Y", $tata_ibadah->waktu)) . ", " . date("d M Y, H:i", $tata_ibadah->waktu)) ?></td>
                                        <td><a href="<?php echo (base_url($tata_ibadah->file_path)) ?>"><?php echo (base_url($tata_ibadah->file_path)) ?></a></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script>
        $(window).ready(function() {
            window.print();
            setInterval(() => {
                window.close();
            }, 3000);
        })
    </script>
</body>

</html>