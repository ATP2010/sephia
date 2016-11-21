<section class="content">
<div class="box">
<div class="box-body table-responsive padding">
<div class="box-header with-border">
<table class="table table-bordered table-striped table-hover" id="mytable">
<!-- <table class="table table-bordered table-striped table-hover" id="example"> -->
  <thead>
    <tr>
      <!-- <th>No</th> -->
      <th>Tanggal</th>
      <th>Logid</th>
      <th>Jenis Tiket</th>
      <th>No Telp</th>
      <th>No Internet</th>
      <th>Nama Pelapor</th>
      <th>No CP</th>
      <th>Email</th>
      <th>Atas nama</th>
      <th>Alamat</th>
      <th>Detail</th>
      <!-- <th>Eksekutor</th> -->
      <th>Aksi</th>
    </tr>
  </thead>  
</table>

<div class="box-footer">
<button id="btnExport" class="btn btn pull-left">Export to excel</button></div>
</div>
</div>
</section>

<?php $nm=date("YmdHis");?>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#mytable').dataTable( {
    "order": [[0, "desc"]],
    "processing": true,
    "serverSide": true,
    "ajax": "<?php echo site_url('profiling/ajax_data_in'); ?>",
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