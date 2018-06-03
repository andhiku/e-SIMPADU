<script type="text/javascript">
    var auto_refresh = setInterval(
            function () {
                $('#dataload').fadeOut("slow").load('<?= base_url() ?>publik/refinfo').fadeIn("slow");
            }, 9000); // refresh every 10000 milliseconds

    var auto_refresh = setInterval(
            function () {
                $('#modal').fadeOut("slow").load('<?= base_url() ?>publik/refsms').fadeIn("slow");
            }, 9000); // refresh every 10000 milliseconds
</script>
<div class="panel-body">
    <h4 align="center"><?= $judul ?></h4>
    <h3 align="center"><?= OWNER ?></h3>
    <div align="center"><?= ALAMAT ?></div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="15%">Tgl. Berkas</th>
                        <th>Pemohon</th>
                        <th>Jenis</th>
                        <th width="15%">Perkiraan<br>Tgl Selesai</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody id="dataload" class="table table-condensed"><!-- for loading data -->
                    <?php
                    if (isset($dtlist) && count($dtlist) > 0) {
                        foreach ($dtlist as $rowtr) {
                            $jns = $rowtr['jenis'];
                            $esti = '+' . tempel('jnslayanan', 'waktu', "id = '$jns'") . ' days';
                            $idm = $rowtr['id'];
                            $prosesnum = hit_baris('tbproses', "id", "idlayanan = '$idm'");
                            ?>
                            <tr>
                                <td align="center"><?= tgl($rowtr['tglberkas']); ?></td>
                                <td><?= $rowtr['pemohon']; ?></td>
                                <td><?= tempel('jnslayanan', 'nmlayanan', "id = '$jns'"); ?></td>
                                <td><?= date('d-m-Y', strtotime($rowtr['tglberkas'] . $esti)); ?></td>
                                <td>
                                    <?php
                                    $max = tahap;
                                    $prog = (100 * $prosesnum) / $max;
                                    ?>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                             aria-valuenow="<?= $prog ?>" aria-valuemin="0" aria-valuemax="<?= $max ?>" 
                                             style="width:<?= $prog ?>%">
                                            <?= $prog ?>% Complete (<?= $prosesnum; ?>/<?= tahap ?>)
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <div id="modal" class="alert alert-info">
                    <?php
                    if ($datalist->num_rows > 0) {
                        $xx = $datalist->row();
                        $id = $xx->id;
                        $pemohon = $xx->pemohon;
                        $jns = $xx->jenis;
                        $noreg = $xx->noregister;
                        $ket = $xx->keterangan;
                        $telp = $xx->telp;
                        $tampil1 = 'Kepada Yth. Saudara/i ' . $pemohon
                                . '. Nomor registrasi anda adalah ' . $noreg
                                . '. Status saat ini adalah ' . $ket
                                . '. Pesan ini dikirim ke nomor ' . $telp;

                        //sms ke petugas
                        $dataptgs = $this->crud_model->getData('*', 'user_tb', "user_role = $jns");
                        $datajnsptgs = $this->crud_model->getData('*', 'jnslayanan', "id = $jns");
                        $xxx = $dataptgs->row();
                        $nama = $xxx->user_nama;
                        $jenis = $xxx->user_role;
                        $tlp = $xxx->telp;
                        $xxxx = $datajnsptgs->row();
                        $jnslayanan = $xxxx->nmlayanan;
                        $tampilptgs1 = 'Kepada Yth. Saudara/i ' . $nama
                                . '. Terdapat layanan dengan jenis ' . $jnslayanan
                                . ' dengan status ' . $ket
                                . ' yang menunggu diproses. Pesan akan dikirim ke nomor ' . $tlp;
                        ?>
                        <strong>Pemohon!</strong> <i class="alert"><?= $tampil1 ?></i><br>
                        <strong>Petugas!</strong> <i class="alert"><?= $tampilptgs1 ?></i>
                        <?php
                        $this->crud_model->setLastSms($id);
                    } elseif ($datalistlewat->num_rows > 0) {
                        $xx = $datalistlewat->row();
                        $id = $xx->id;
                        $pemohon = $xx->pemohon;
                        $jns = $xx->jenis;
                        $noreg = $xx->noregister;
                        $ket = $xx->keterangan;
                        $telp = $xx->telp;
                        $tampil2 = 'Kepada Yth. Saudara/i ' . $pemohon
                                . '. Nomor registrasi anda adalah ' . $noreg
                                . '. Status saat ini adalah ' . $ket;

                        //sms ke petugas
                        $dataptgs = $this->crud_model->getData('*', 'user_tb', "user_role = $jns");
                        $datajnsptgs = $this->crud_model->getData('*', 'jnslayanan', "id = $jns");
                        $xxx = $dataptgs->row();
                        $nama = $xxx->user_nama;
                        $jenis = $xxx->user_role;
                        $tlp = $xxx->telp;
                        $xxxx = $datajnsptgs->row();
                        $jnslayanan = $xxxx->nmlayanan;
                        $tampilptgs1 = 'Kepada Yth. Saudara/i ' . $nama
                                . '. Terdapat layanan dengan jenis ' . $jnslayanan
                                . ' dengan status ' . $ket
                                . ' yang menunggu diproses. Pesan akan dikirim ke nomor ' . $tlp;
                        ?>
                        <strong>Info!</strong> <i class="alert"><?= $tampil2 ?></i><br>
                        <strong>Info!</strong> <i class="alert"><?= $tampilptgs2 ?></i>
                        <?php
                        $this->crud_model->setLastSms($id);
                    } else {
                        echo 'Tidak ada data terbaru';
                    }
                    ?>

                </div>
            </table>

        </div>
        <!-- /.panel-body -->
    </div>
</div>
