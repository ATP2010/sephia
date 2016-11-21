<section class="content">
<div class="box">
<div class="box-body table-responsive padding">
<div class="box-header with-border">
<table class="table table-bordered table-striped table-hover" id="mytable">
<!-- <table class="table table-bordered table-striped table-hover" id="example"> -->
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Witel</th>
      <th>Nama Pelapor</th>
      <th>Nama Pelanggan</th>
      <th>No FASTEL</th>
      <th>Alamat</th>
      <th>No Tiket</th>
      <th>Tanggal Open</th>
      <th>Status tiket</th>
      <th>Lapul</th>
      <th>Gaul</th>
      <th>CP</th>
      <th>Email</th>
      <th>Keluhan</th>
      <!-- <th>Aksi</th> -->
    </tr>
  </thead>  
</table>

<!-- <div class="box-footer">
<button id="btnExport" class="btn btn-info pull-left">Export to excel</button></div>
</div> -->
</div>
</section>

<?php $nm=date("YmdHis");?>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#mytable').dataTable( {
    "order": [[0, "desc"]],
    "processing": true,
    "serverSide": true,
    "ajax": "<?php echo site_url('agent/ajax_datahc_in'); ?>",
    } );
} );
</script>
    
<script type="text/javascript">
    $(document).ready(function () {
    $("#btnExport").click(function () {
    $("#mytable").btechco_excelexport({
    containerid: "mytable"
    , datatype: $datatype.Table
    , filename: 'export_<?php echo $nm;?>'
    });
    });
    });
</script>