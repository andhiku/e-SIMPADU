<script type="text/javascript">
    var auto_refresh = setInterval(
            function () {
                $('#dataload').fadeOut("slow").load('<?= base_url() ?>publik/refinfo').fadeIn("slow");
            }, 9000); // refresh every 10000 milliseconds

    var auto_refresh = setInterval(
            function () {
                $('#modal').fadeOut("slow").load('<?= base_url() ?>publik/refsms').fadeIn("slow");
            }, 2250); // refresh every 10000 milliseconds

//    $(window).on('load', function () {
//            $('#modal').modal('show');
//        });
//    setTimeout(function () {
//        $('#modal').modal('hide').fadeOut("slow").fadeIn("slow");
//    }, 1000);
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
                    if ($datalist) {
                        $xx = $datalist->row();
                        $id = $xx->id;
                        $pemohon = $xx->pemohon;
                        $noreg = $xx->noregister;
                        $ket = $xx->keterangan;
                        $telp = $xx->telp;
                        $tampil1 = $id . '. Kepada Yth. Saudara/i ' . $pemohon
                        . '. Nomor registrasi anda adalah ' . $noreg
                        . '. Status saat ini adalah ' . $ket;
                        ?>
                        <strong>Info!</strong> <i class="alert"><?= $tampil1 ?></i> <?php
                        $setsms = $this->crud_model->setLastSms($id);
                    } elseif ($datalistlewat) {
                        $xx = $datalistlewat->row();
                        $id = $xx->id;
                        $pemohon = $xx->pemohon;
                        $noreg = $xx->noregister;
                        $ket = $xx->keterangan;
                        $telp = $xx->telp;
                        $tampil2 = $id . '. Kepada Yth. Saudara/i ' . $pemohon
                        . '. Nomor registrasi anda adalah ' . $noreg
                        . '. Status saat ini adalah ' . $ket;
                        ?>
                        <strong>Info!</strong> <i class="alert"><?= $tampil2 ?></i> <?php
                        $setsms = $this->crud_model->setLastSms($id);
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


<!-- Modal -->
<!--<div class="modal fade in" id="modal">
    <div class="modal-dialog moda-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <div class="modal-title"><h5>Isi SMS</h5></div>
            </div>
            <div class="modal-body">
                <form id="mb">
                    <input type="hidden" name="id" value="">

                    <div class="form-group">
                        <label>
                            <? php
//                            $semua = $this->crud_model->getJadwalKosong('*');
                            $getjadwal = $this->crud_model->getJadwal();
                            if ($getjadwal) {
                                $xx = $datalist->row();
                                $id = $xx->id;
                                $pemohon = $xx->pemohon;
                                $noreg = $xx->noregister;
                                $ket = $xx->keterangan;
                                $telp = $xx->telp;
                                echo $id . '. Kepada Yth. ' . $pemohon
                                . '. Nomor registrasi anda adalah ' . $noreg
                                . '. Status saat ini adalah ' . $ket;
                            } else {
                                echo 'tidak ada data yang ditampilkan';
                            }
//                            $setsms = $this->crud_model->setLastSms($id);
                            ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>-->
