<?php
$urlset = base_url() . $this->router->class . '/' . $this->router->method . '/';
$user = $this->session->userdata('logged_user');
$rolfil = ltrim($user['usrrole'], "op");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= $judul ?>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs" 
                        onclick="location.href = '<?= $urlset ?>tambah'"
                        data-toggle="dropdown">Registrasi Baru</button>
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
                            <th><?php
                                echo $user['usrnama'];
                                echo "<br>";
                                $role = $user['usrrole'];
                                if ($role == 0) {
                                    echo "Frontline";
                                } else {
                                    $jnsptgs = $this->crud_model->getData('*', 'jnslayanan', "id = $role");
                                    $xx = $jnsptgs->row();
                                    $jns = $xx->nmlayanan;
                                    echo "(" . $jns . ")";
                                }
                                ?></th>
                            <th>Tgl. Berkas</th>
                            <th>Pemohon</th>
                            <th>Jenis</th>
                            <th>Perkiraan<br>Tgl Selesai</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($dtlist) && count($dtlist) > 0) {
                            foreach ($dtlist as $rowtr) {
                                $jns = $rowtr['jenis'];
                                $esti = '+' . tempel('jnslayanan', 'waktu', "id = '$jns'") . ' days';
                                $idm = $rowtr['id'];
                                $prosesnum = hit_baris('tbproses', "id", "idlayanan = '$idm'") + 1;
                                $isroleFT = $rolfil <> $prosesnum ? 'disabled' : '';
                                $isdel = $role == "admin" ? '' : 'disabled';
                                $isrole = $role == "admin" ? '' : $isroleFT;
                                ?>
                                <tr>
                                    <td width="23%" align="center">
                                        <button type="button" class="btn btn-primary <?= $isrole ?>" 
                                                onclick="SetIdLayanan(<?= $idm ?>,<?= $prosesnum ?>)"
                                                data-toggle="modal" data-target="#myProses">Proses&nbsp;
                                            <span class="badge"><?= $prosesnum ?></span>
                                        </button>

                                        <button type="button" class="btn btn-warning <?= $isdel ?>" 
                                                onclick="location.href = '<?= $urlset ?>hapus/<?= $rowtr['id'] ?>'"
                                                data-toggle="dropdown">Delete</button>

                                    </td>
                                    <td widht="15%"><?= tgl($rowtr['tglberkas']); ?></td>
                                    <td><a href="javascript:void(0)"
                                           onclick="location.href = '<?= $urlset ?>edit/<?= $rowtr['id'] ?>'">
                                            <?= $rowtr['pemohon']; ?></a>
                                    </td>
                                    <td><?= tempel('jnslayanan', 'nmlayanan', "id = '$jns'"); ?></td>
                                    <td><?= date('d-m-Y', strtotime($rowtr['tglberkas'] . $esti)); ?></td>
                                    <td><?= $rowtr['keterangan']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col-md-12 text-center"><?= $this->pagination->create_links(); ?></div>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <!-- /.panel -->
    <p>
        &nbsp;
    </p>
</div>

<!-- Modal -->
<div id="myProses" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Proses Verifikasi Layanan</h4>
            </div>
            <div class="modal-body">
                <form name="form" method="Post" id="form" action="<?= $urlset ?>proses">
                    <!-- start form -->
                    <input name="idmlayan" id="idmlayan" type="hidden">
                    <input name="prosesno" id="prosesno" type="hidden">
                    <div class="form-group">
                        <label for="keter">Keterangan </label>
                        <input type="keter" class="form-control" id="keter" name="keter"
                               placeholder="Keterangan proses">
                    </div>

                    <div class="form-group">
                        <label for="tangg">Tanggal </label>
                        <input type="text" class="form-control" name="tangg" id="tangg" 
                               placeholder="DD/MM/YYYY">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <input type="checkbox" name="selesai">
                            Contreng jika layanan dinyatakan selesai <span style="color:red">(Proses Paling Akhir)</span>
                        </label>
                    </div>
                    <!-- end form -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" 
                                onclick="this.form.submit()"
                                data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <script type="text/javascript">
                //ambil data idlayanan dan nomor proses
                function SetIdLayanan(id, pros) {
                    document.getElementById('idmlayan').value = id;
                    document.getElementById('prosesno').value = pros;
                }
            </script>


        </div>

    </div>
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