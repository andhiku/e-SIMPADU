<script type="text/javascript">
    var auto_refresh = setInterval(
            function () {
                $('#dataload').fadeOut("slow").load('<?= base_url() ?>publik/refinfo').fadeIn("slow");
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
            </table>

        </div>
        <!-- /.panel-body -->
    </div>
</div>
