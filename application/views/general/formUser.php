<?php
$urlset = base_url() . $this->router->class . '/' . $this->router->method . '/';

$rows = isset($dtedit) ? $dtedit->row() : array();
$form_aksi = isset($dtedit) ? 'updatedata/' . $rows->user_id : 'simpan';
$tombol = isset($dtedit) ? 'Update data' : 'Simpan data';
$idset = isset($dtedit) ? $rows->nip : '';
$username = isset($dtedit) ? $rows->user_username : '';
$passw = isset($dtedit) ? '' : '';
$nama = isset($dtedit) ? $rows->user_nama : '';
$role = isset($dtedit) ? $rows->user_role : '';

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
                        ID
                    </label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="idset" id="idset" 
                               value="<?= $idset ?>" placeholder="No. Identitas">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Username
                    </label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="username" id="username" 
                               value="<?= $username ?>" placeholder="Pengguna ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Password
                    </label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" name="password" id="password" 
                               value="<?= $passw ?>" placeholder="password ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Nama 
                    </label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="nama" id="nama" 
                               value="<?= $nama ?>" placeholder="Nama lengkap">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">
                        Role Set
                    </label>
                    <div class="col-xs-3 dropdown">
                        <?php
                        $opsi = 'class="form-control" data-toggle="dropdown" onKeyPress="return handleEnter(this, event)"';
                        foreach (fRoleUser() as $id => $data) {
                            $rolearr[''] = '-- Pilihan Role --';
                            $rolearr[$id] = $data;
                        }
                        echo form_dropdown('userrole', $rolearr, $role, $opsi);
                        ?>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="this.form.submit()">
                    <?= $tombol ?></button>
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


