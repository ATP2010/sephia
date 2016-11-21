<section class="content">
<div class="box">
<div class="box-body table-responsive padding">
<div class="box-header with-border">
<table class="table table-bordered table-striped table-hover" id="mytable">
  <thead>
    <tr>
      <!-- <th>No</th> -->
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Batch</th>
      <th>Tanggal Join</th>
      <th>Tanggal Resign</th>
      <th>Lama Kerja</th>
      <th>Avaya</th>
      <th>I-Siska</th>
      <th>CX</th>
      <th>NOSSA</th>
      <th>i-Booster</th>
      <th>T3-Online</th>
      <th>Startklik</th>
      <th>Webcare</th>
      <th>e-Payment</th>
      <th>KMS</th>
      <th>SOAP</th>
      <th>CS-Tools</th>
      <th>Ideas</th>
      <th>Ket</th>
      <th>Aksi</th>
    </tr>
  </thead>  
</table>
</div>
</div>
<div class="box-footer">
<button id="btnExport" class="btn btn-info pull-left">Export to excel</button></div>

</section>

<?php $nm=date("YmdHis");?>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#mytable').dataTable( {
    "order": [[0, "desc"]],
    "processing": true,
    "serverSide": true,
    "LengthChange": true,
    "Sort": true,
    "ajax": "<?php echo site_url('administrasi/ajax_data_app'); ?>",
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