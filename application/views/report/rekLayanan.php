<style>
    .tengah { text-align: center; }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= APPNAME; ?> - <?= $judul ?>
        <span style=" float: right;">
            <button type="button" class="btn btn-primary btn-xs" onclick="printDiv('detail')"> Cetak halaman ini </button>
        </span>
    </div>
    <!-- /.panel-heading -->
    <div class="row" id="detail">
        <!-- /.panel-heading -->
        <div class="panel-body" style="width:720px">
            <div class="dataTable_wrapper" style="padding-left: 10px;">
                <table class="table table-bordered table-condensed" style="font-size:90%;"> 
                    <thead>
                        <tr>
                            <th width="5%" rowspan="2"></th>
                            <th rowspan="2"><div class="tengah">Jenis Layanan</div></th>
                            <th rowspan="2"><div class="tengah">Jumlah<br>pemohon</div></th>
                            <th colspan="10"><div class="tengah">PROSES (P)</div></th>
                            <th rowspan="2"><div class="tengah">Selesai</div></th>
                            <th rowspan="2"><div class="tengah">BTL</div></th>
                        </tr>
                        <tr align="center">
                            <th>Reg</th>
                            <th>P1</th>
                            <th>P2</th>
                            <th>P3</th>
                            <th>P4</th>
                            <th>P5</th>
                            <th>P6</th>
                            <th>P7</th>
                            <th>P8</th>
                            <th>P9</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($dtlist) && count($dtlist) > 0) {
                            $i = 0;
                            foreach ($dtlist->result() as $rowtr) {
                                $i++;
                                $jns = $rowtr->jenis;
                                //$esti = '+' . tempel('jnslayanan', 'waktu', "id = '$jns'") . ' days';
                                ?>
                                <tr>
                                    <td align="center"><?= $i ?></td>
                                    <td><?= tempel('jnslayanan', 'nmlayanan', "id = '$jns'"); ?></td>
                                    <td><div class="tengah"><?= $rowtr->jml; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr0; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr1; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr2; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr3; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr4; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr5; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr6; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr7; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr8; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->pr9; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->sls; ?></div></td>
                                    <td><div class="tengah"><?= $rowtr->btl; ?></div></td>
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


