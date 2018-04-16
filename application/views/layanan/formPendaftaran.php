<?php
$urlset = base_url() . $this->router->class . '/' . $this->router->method . '/';

$rows = isset($dtedit) ? $dtedit->row() : array();
$form_aksi = isset($dtedit) ? 'updatedata/' . $rows->id : 'simpan';
$tombol = isset($dtedit) ? 'Update data' : 'Simpan data';

$nama = isset($dtedit) ? $rows->pemohon : '';
$tglreg = isset($dtedit) ? date('d/m/Y', strtotime($rows->tglberkas)) : '';
$jnslyan = isset($dtedit) ? $rows->jenis : '';
$telp = isset($dtedit) ? $rows->telp : '';

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
        <h4>Form Permohonanan Layanan </h4>
        <form action="<?= $urlset . $form_aksi; ?>" class="form-horizontal" 
              enctype="multipart/form-data" method="post"> 
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Nama
                    </label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="nama" id="nama" 
                               value="<?= $nama ?>" placeholder="Nama pemohon">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Tanggal
                    </label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="tglusul" id="tglusul" 
                               value="<?= $tglreg ?>" placeholder="DD/MM/YYYY">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Jenis Layanan 
                    </label>
                    <div class="col-xs-4">
                        <?php
                        $opti = '';
                        if( is_array( $dwjnslayan ) && count( $dwjnslayan ) > 0 ) {
                        //if (isset($dwjnslayan)) {
                            foreach ($dwjnslayan as $key) {
                                $rowid = $key['id'];
                                $rowdata = $key['nmlayanan'];
                                $opti[''] = '-- Pilihan --';
                                $opti[$rowid] = $rowdata;
                            }
                            echo form_dropdown('jnslayan', $opti, $jnslyan,'class="form-control" id="jnslayan"');
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        No Handphone 
                    </label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="telp" id="telp" 
                               value="<?= $telp ?>" placeholder="08XXX">
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


