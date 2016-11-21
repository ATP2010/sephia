<section class="content">
<div class="box">
<!-- <div class="box-header"><button id="btnExport" class="btn btn-info pull-left">Export to excel</button></div> -->
<div class="box-body table-responsive padding">
<div class="box-header with-border">
<table id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama tiket</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>  
  <tbody>
      <tr>
      <?php
      $no = 1; 
      foreach ($data ->result() as $row) {
      ?>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row->nm_tiket; ?></td>
        <td><?php echo $row->sw; ?></td>    
        <td>
            <?php echo anchor('admin/edit_menu_upd/'.$row->id, 'Update |');?> 
            <?php echo anchor('admin/edit_menu_del/'.$row->id, '| Delete', array('onclick'=>"return confirm('Hapus data ini?')"));?>
        </td>
      </tr>
      <?php }?>
  </tbody>
</table>
</div>
</div>
</section>
<div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            Dengan men-delete menu, maka data tiket yang diinput dengan menu tersebut akan hilang status menunya.
          </div>
        </div>

<?php $nm=date("YmdHis");?>
    <script type="text/javascript">
        

  $(function () {
    $("#example1").dataTable();    
  });
  </script>