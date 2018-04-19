<?php
$urlset = base_url() . $this->router->class . '/' . $this->router->method . '/';

$rows = isset($dtedit) ? $dtedit->row() : array();
$form_aksi = isset($dtedit) ? 'updatedata/' . $rows->id : 'simpan';
$tombol = isset($dtedit) ? 'Update data' : 'Simpan data';

$nama = isset($dtedit) ? $rows->nmlayanan : '';
$telepon = isset($dtedit) ? $rows->tlp : '';
$waktu = isset($dtedit) ? $rows->waktu : '';

//$tgl = isset($dtedit) ? date('d/m/Y', strtotime($rows->tanggal)) : '';
?>
<div class="panel panel-default">
    <div class="panel-heading"><b><?= $judul ?></b></div>
    <div class="panel-body">
        <?php
        if (isset($eror)) {
            echo '<div id="eror_div" class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            echo validation_errors();
            echo '</div>';
        }
        ?>
        <form action="<?= $urlset . $form_aksi; ?>" class="form-horizontal" 
              enctype="multipart/form-data" method="post"> 
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Nama Layanan
                    </label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="nama" id="nama" 
                               value="<?= $nama ?>" placeholder="Nama layanan">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Nomor Telepon
                    </label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="telepon" id="telepon" 
                               value="<?= $telepon ?>" placeholder="Nomor Telepon">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Waktu
                    </label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="waktu" id="waktu" 
                               value="<?= $waktu ?>" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="this.form.submit()">
                        <?= $tombol ?></button>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
    if (top.location != location) {
        top.location.href = document.location.href;
    }
    $(function () {
        window.prettyPrint && prettyPrint();
        $('#dp1').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-3d'
        });
        $('#dp2').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-3d'
        });
    });
</script>


