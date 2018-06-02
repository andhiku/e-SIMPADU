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
    $xxx = $dataptgs->row();
    $nama = $xxx->user_username;
    $jenis = $xxx->user_role;
    $tlp = $xxx->telp;
    $tampilptgs = 'Kepada Yth. Saudara/i ' . $nama
            . '. Terdapat layanan dengan jenis ' . $jenis
            . ' dengan status ' . $ket
            . ' yang menunggu diproses. Pesan akan dikirim ke nomor ' . $tlp;
    ?>
    <strong>Pemohon!</strong> <i class="alert"><?= $tampil1 ?></i><br>
    <strong>Petugas!</strong> <i class="alert"><?= $tampilptgs ?></i>
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
                . '. Status saat ini adalah ' . $ket
                . '. Pesan ini dikirim ke nomor ' . $telp;
        ?>
    <strong>Info!</strong> <i class="alert"><?= $tampil2 ?></i>
    <?php
    $this->crud_model->setLastSms($id);
} else {
    echo 'Tidak ada data terbaru';
}



    //$this->crud_model->setLastSms($id);
//    $dataptgs = $this->crud_model->getDataTabel('user_tb', "'user_role' = $jns");
//    $xxx = $dataptgs->row();
//    $nama = $xxx->user_username;
//    $jenis = $xxx->user_role;
//    $tlp = $xxx->telp;
//    $tampilptgs = 'Kepada Yth. Saudara/i ' . $nama
//            . '. Terdapat layanan dengan jenis ' . $jenis
//            . ' yang menunggu diproses. Pesan akan dikirim ke nomor ' . $tlp;