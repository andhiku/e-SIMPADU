<?php
$urlset = base_url() . $this->router->class . '/' . $this->router->method . '/';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= $judul ?>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs" 
                        onclick="location.href = '<?= $urlset ?>tambah'"
                        data-toggle="dropdown">Tambah pengguna</button>
            </div>
        </div>
    </div>

    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" style="font-size:0.9em;">
                    <thead>
                        <tr>
                            <th>ID. Pengguna</th>
                            <th>Username</th>
                            <th>Nama Pengguna</th>
                            <th>Nomor Telepon</th>
                            <th>Role</th>
                            <th>Login Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($dtlist) && count($dtlist) > 0) {
                            foreach ($dtlist as $rowtr) {
                                $idx = $rowtr['user_id'];
                                ?>
                                <tr>
                                    <td><a href="javascript:void(0)"
                                           onclick="location.href = '<?= $urlset ?>edit/<?= $idx ?>'">
                                            <?= $rowtr['nip']; ?></a>
                                    </td>
                                    <td><?= $rowtr['user_username']; ?></td>
                                    <td><?= $rowtr['user_nama']; ?></td>
                                    <td><?= $rowtr['telp']; ?></td>
                                    <td><?= $rowtr['nmlayanan']; ?></td>
                                    <td><?= $rowtr['last_login']; ?></td>
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
</div>
<script type="text/javascript">
    function konfirmasi()
    {
        tanya = confirm("Anda Yakin Akan Menghapus Data USER?");
        if (tanya == true)
            return true;
        else
            return false;
    }
</script>

