<?php
if ($datalist->num_rows > 0) {
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
    <strong>Tampil1</strong> <i class="alert"><?= $tampil1 ?></i>
    <?php
    $this->crud_model->setLastSms($id);
} elseif ($datalistlewat->num_rows > 0) {
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
    $this->crud_model->setLastSms($id);
} else {
    echo 'Tidak ada data terbaru';
}
?>