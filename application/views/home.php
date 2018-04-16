<div class="panel panel-default">
    <div class="panel-heading">
        <?= APPNAME; ?> - <?= $judul ?>
        <span style=" float: right;"><button type="button" class="btn btn-primary btn-xs" onclick="printDiv('detail')"> Cetak halaman ini </button></span>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- /.panel-heading -->
        <div class="panel-body" id="detail">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" style="font-size:0.9em;">
                    <thead>
                        <tr>
                            <th width="12%">Tgl. Berkas</th>
                            <th>Pemohon</th>
                            <th>Jenis</th>
                            <th>Perkiraan<br>Tgl Selesai</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
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
    <!-- /.panel -->
    <p>
        &nbsp;
    </p>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->


