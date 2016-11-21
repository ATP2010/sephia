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
                    <label for="karyawan" class="col-sm-2">Nama karyawan</label>
                    <input  type="text" value="<?php echo $nama; ?>" class="col-sm-3" disabled>
                    </div>

                    <div class="form-group">                   
                    <label for="jabatan" class="col-sm-2">Jabatan</label>
                    <select name="jab" id="jab" class="col-sm-2">
                    <?php
                    echo "<option>".$jab."</option>";
                    foreach ($jab_list -> result_array() as $s) {
                    echo "<option value='".$s['nm_jab']."'>".$s['nm_jab']."</option>";
                        }
                    ?>
                    </select>
                    <?php echo form_error('jab') ?>
                    </div>

                    <div class="form-group">                   
                    <label for="" class="col-sm-2">Batch</label>
                    <input  type="text" name="batch" value="<?php echo $batch; ?>" class="col-sm-1" >
                    </div>

                    <div class="form-group">
                    <label for="tgl_in" class="col-sm-2">Tanggal Join</label>
                    <div class="input-group date" data-provide="datepicker">
                    <span class="fa fa-calendar"></span>
                    <input type="text" name="tgl_in" class="col-sm-2" placeholder="pilih tanggal" value="<?php echo $tgl_in; ?>">
                    <div class="input-group-addon"></div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="tgl_out" class="col-sm-2">Tanggal Resign</label>
                    <div class="input-group date" data-provide="datepicker">
                    <span class="fa fa-calendar"></span>
                    <input type="text" name="tgl_out" class="col-sm-2" value="<?php echo $tgl_out; ?>" >
                    <div class="input-group-addon"></div>
                    </div>
                    </div>

                    <div class="form-group">                   
                    <label for="jabatan" class="col-sm-2">Status</label>
                    <select name="sta" id="sta" class="col-sm-1">
                    <option value="<?php echo $sta;?>"><?php echo $sta;?></option>
                    <option value="Aktif">Aktif</option>
                    <option value="Resign">Resign</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="ket" class="col-sm-3">List Aplikasi :</label>
                    </div>
                    <div class="form-group">
                    <label for="karyawan" class="col-sm-2">Avaya</label>
                    <input  type="text" name="avaya" value="<?php echo $avaya; ?>" class="col-sm-1" >
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">I-Siska</label>
                    <input  type="text" name="siska" value="<?php echo $siska; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">CX</label>
                    <input  type="text" name="cx" value="<?php echo $cx; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">NOSSA</label>
                    <input  type="text" name="nossa" value="<?php echo $nossa; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">i-Booster</label>
                    <input  type="text" name="ibooster" value="<?php echo $ibooster; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">T3-online</label>
                    <input  type="text" name="t3ol" value="<?php echo $t3ol; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Startklik</label>
                    <input  type="text" name="startklik" value="<?php echo $startklik; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Webcare</label>
                    <input  type="text" name="webcare" value="<?php echo $webcare; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Payment</label>
                    <input  type="text" name="payment" value="<?php echo $payment; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">KMS</label>
                    <input  type="text" name="kms" value="<?php echo $kms; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">SOAP</label>
                    <input  type="text" name="soap" value="<?php echo $soap; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">CSTools</label>
                    <input  type="text" name="cstools" value="<?php echo $cstools; ?>" class="col-sm-2">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">IDEAS</label>
                    <input  type="text" name="ideas" value="<?php echo $ideas; ?>" class="col-sm-1">
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Ket</label>
                    <input  type="text" name="ket" value="<?php echo $ket; ?>" class="col-sm-3">
                    </div>
                  </div>
                    
                  <!-- <input type="hidden" name="nama" value="<?php echo $nama; ?>" />  -->
                  <input type="hidden" name="no" value="<?php echo $no; ?>" /> 
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button> 
                  <button type="reset" class="btn btn-warning">Reset</button> 
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- general form elements disabled -->
</section>
<?php
    if ($tgl_out > $tgl_in) {
        ;
    }
?>

<script type="text/javascript">
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  
</script>