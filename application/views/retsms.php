<?php
if ($datalist) {
    $xx = $datalist->row();
    $id = $xx->id;
    $pemohon = $xx->pemohon;
    $noreg = $xx->noregister;
    $ket = $xx->keterangan;
    $telp = $xx->telp;
    $tampil = $id . '. Kepada Yth. Saudara/i ' . $pemohon
            . '. Nomor registrasi anda adalah ' . $noreg
            . '. Status saat ini adalah ' . $ket;
    ?>
    <strong>Info!</strong> <i class="alert"><?= $tampil ?></i> <?php
//                        $setsms = $this->crud_model->setLastSms($id);
} else {
    echo 'Tidak ada data terbaru';
}
?>