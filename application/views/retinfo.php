
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
                    <?= $prosesnum; ?>/<?= tahap ?>
                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                         aria-valuenow="<?= $prog ?>" aria-valuemin="0" aria-valuemax="<?= $max ?>" 
                         style="width:<?= $prog ?>%">
                        <?= $prog ?>% Complete
                    </div>
                </div>
            </td>
        </tr>
        <?php
    }
}
?>