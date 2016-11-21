<section class="content">
<div class="box">
<div class="box-body table-responsive padding">
<div class="box-header with-border">
<table class="table table-bordered table-striped table-hover" id="mytable">
<!-- <table class="table table-bordered table-striped table-hover" id="example"> -->
  <thead>
    <tr>
      <th>No Tiket</th>
      <th>Lapul</th>
      <th>Status</th>
      <th>Login Agent</th>
      <th>Feedback</th>
      <th>Action</th>
    </tr>
  </thead>  
</table>

<div class="box-footer">
<button id="btnExport" class="btn btn-primary pull-left">Export to excel</button></div>
</div>
</div>
</section>

<?php $nm=date("YmdHis");?>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#mytable').dataTable( {
    "order": [[2, "desc"]],
    "processing": true,
    "serverSide": true,
    "ajax": "<?php echo site_url('agentc4/ajax_data_cb'); ?>",
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