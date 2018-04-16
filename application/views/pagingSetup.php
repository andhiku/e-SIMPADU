<!-- PRINTER SET -->
<div class="panel-heading">
    <?= $judul ?>
    <div class="pull-right">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-xs" 
                    onclick="location.href = '<?= $urlset ?>tambah'"
                    data-toggle="dropdown">Registrasi Baru</button>
            <button type="button" class="btn btn-primary btn-xs" 
                    onclick="printDiv('detail')"> Cetak halaman ini </button>
            
        </div>
    </div>
</div>
<div class="panel-body" id="detail"></div>

<!-- PAGING SET -->
<div class="row">
    <div class="col-md-12 text-center"><?= $this->pagination->create_links(); ?></div>
</div>


<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

