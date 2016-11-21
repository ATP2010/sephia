<section class="content">
<div class="box">
<div class="box-body table-responsive padding">
<table id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>No</th>
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
        <td><?php echo $row->tanggal; ?></td>
        <td><?php echo $row->logid; ?></td>    
        <td><?php echo $row->nm_tiket; ?></td>
        <td><?php echo $row->no_telp; ?></td>
        <td><?php echo $row->no_inet; ?></td>        
        <td><?php echo $row->nm_pelapor; ?></td>
        <td><?php echo $row->no_cp; ?></td>
        <td><?php echo $row->email; ?></td>
        <td><?php echo $row->atas_nama; ?></td>
        <td><?php echo $row->alamat; ?></td>
        <td><?php echo $row->detail; ?></td>
        <td><?php echo anchor('agent/update/'.$row->id, 'edit');?> <!--<?php echo anchor('agent/delete/'.$row->id, 'Delete', array('onclick'=>"return confirm('Hapus data ini?')"));?>--></td>
      </tr>
      <?php }?>
  </tbody>
</table>
</div>
</div>
</section>

<script type="text/javascript">
  $(function () {
    $("#example1").dataTable();    
  });
</script>