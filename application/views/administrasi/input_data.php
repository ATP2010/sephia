<section class="content">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Masukan data dengan benar</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo $action;?>" method="post">
                  <div class="box-body">

                <div class="text-success">
                <?php $info = $this->session->flashdata('sukses'); echo $info; ?>
                </div>

                <div class="form-group">                   
                <label for="karyawan" class="col-sm-2">Pilih karyawan</label>
                <select name="nama" id="nama" class="col-sm-3">
                    <?php
                    echo "<option> - Pilih Karyawan - </option>";
                    foreach ($kary -> result_array() as $s) {
                    echo "<option value='".$s['user2']."'>".$s['user1']."   |   ".$s['user2']."</option>";
                    }
                    ?>
                </select>
               
                <?php echo form_error('nama') ?>
                </div>

                <div class="form-group">                   
                <label for="jabatan" class="col-sm-2">Jabatan</label>
                <select name="jab" id="jab" class="col-sm-3">
                    <?php
                    echo "<option> - Pilih Jabatan - </option>";
                    foreach ($jab -> result_array() as $s) {
                    echo "<option value='".$s['nm_jab']."'>".$s['nm_jab']."</option>";
                    }
                    ?>
                </select>
                <?php echo form_error('jab') ?>
                </div>

                <div class="form-group">
                    <label for="batch" class="col-sm-2">Batch</label>
                    <input type="teks" id="batch" name="batch" class="col-sm-3" placeholder="angka saja">
                </div>

                <div class="form-group">
                <label for="tgl_in" class="col-sm-2">Tanggal Join</label>
                <div class="input-group date" data-provide="datepicker">
                <span class="fa fa-calendar"></span>
                    <input type="text" name="tgl_in" class="col-sm-2" placeholder="pilih tanggal">
                    <div class="input-group-addon"></div>
                </div>
                </div>
<br/>                
                <div class="form-group">
                    <label for="ket" class="col-sm-3">USER APLIKASI :</label>
                </div>
                <div class="form-group">
                    <label for="avaya" class="col-sm-2">Avaya</label>
                    <input type="teks" name="avaya" class="col-sm-3" placeholder="user avaya">
                </div>
                <div class="form-group">
                    <label for="siska" class="col-sm-2">I-Siska</label>
                    <input type="teks" name="siska" class="col-sm-3" placeholder="user isiska">
                </div>
                <div class="form-group">
                    <label for="cx" class="col-sm-2">CX</label>
                    <input type="teks" name="cx" class="col-sm-3" placeholder="user cx">
                </div>
                <div class="form-group">
                    <label for="nossa" class="col-sm-2">Nossa</label>
                    <input type="teks" name="nossa" class="col-sm-3" placeholder="user nossa">
                </div>
                <div class="form-group">
                    <label for="ibooster" class="col-sm-2">iBooster</label>
                    <input type="teks" name="ibooster" class="col-sm-3" placeholder="user ibooster">
                </div>
                <div class="form-group">
                    <label for="t3ol" class="col-sm-2">T3-online</label>
                    <input type="teks" name="t3ol" class="col-sm-3" placeholder="user t3ol">
                </div>
                <div class="form-group">
                    <label for="startklik" class="col-sm-2">StartKlik</label>
                    <input type="teks" name="startklik" class="col-sm-3" placeholder="user startklik">
                </div>
                <div class="form-group">
                    <label for="webcare" class="col-sm-2">Webcare</label>
                    <input type="teks" name="webcare" class="col-sm-3" placeholder="user webcare">
                </div>
                <div class="form-group">
                    <label for="payment" class="col-sm-2">e-Payment</label>
                    <input type="teks" name="payment" class="col-sm-3" placeholder="user payment">
                </div>
                <div class="form-group">
                    <label for="kms" class="col-sm-2">KMS</label>
                    <input type="teks" name="kms" class="col-sm-3" placeholder="user kms">
                </div>
                <div class="form-group">
                    <label for="soap" class="col-sm-2">SOAP</label>
                    <input type="teks" name="soap" class="col-sm-3" placeholder="user soap">
                </div>
                <div class="form-group">
                    <label for="cstools" class="col-sm-2">CStools</label>
                    <input type="teks" name="cstools" class="col-sm-3" placeholder="user cstools">
                </div>
                <div class="form-group">
                    <label for="ideas" class="col-sm-2">Ideas</label>
                    <input type="teks" name="ideas" class="col-sm-3" placeholder="user ideas">
                </div>


                <div class="form-group">
                    <label for="ket" class="col-sm-2">Keterangan</label>
                    <input type="teks" id="ket" name="ket" class="col-sm-3" placeholder="jika ada">
                </div>
                  <input type="hidden" name="tgl_out" value="<?php echo date('Y-m-d')?>" />
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button> 
                  <button type="reset" class="btn btn-warning">Reset</button> 
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- general form elements disabled -->
</section>

<script type="text/javascript">
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  
</script>