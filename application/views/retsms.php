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
    $tampilptgs2 = 'Kepada Yth. Saudara/i ' . $nama
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