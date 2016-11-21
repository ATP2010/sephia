<section class="content">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Aplikasi User</h3>
                    </div><!-- /.box-header -->
                    <form class="form-horizontal">
                    <div class="box-body">

                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Nama karyawan</label>
                    <input  type="text" value="<?php echo $nama; ?>" class="col-sm-3" disabled>
                    </div>

                    <div class="form-group">
                    <label for="ket" class="col-sm-3">List Aplikasi :</label>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Avaya</label>
                    <input  type="text" value="<?php echo $avaya; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">I-Siska</label>
                    <input  type="text" value="<?php echo $siska; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">CX</label>
                    <input  type="text" value="<?php echo $cx; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">NOSSA</label>
                    <input  type="text" value="<?php echo $nossa; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">i-Booster</label>
                    <input  type="text" value="<?php echo $ibooster; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">T3-online</label>
                    <input  type="text" value="<?php echo $t3ol; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Startklik</label>
                    <input  type="text" value="<?php echo $startklik; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Webcare</label>
                    <input  type="text" value="<?php echo $webcare; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Payment</label>
                    <input  type="text" value="<?php echo $payment; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">KMS</label>
                    <input  type="text" value="<?php echo $kms; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">SOAP</label>
                    <input  type="text" value="<?php echo $soap; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">CSTools</label>
                    <input  type="text" value="<?php echo $cstools; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">IDEAS</label>
                    <input  type="text" value="<?php echo $ideas; ?>" class="col-sm-3" disabled>
                    </div>
                    <div class="form-group">                   
                    <label for="karyawan" class="col-sm-2">Ket</label>
                    <input  type="text" value="<?php echo $ket; ?>" class="col-sm-3" disabled>
                    </div>
                  </div>
                  <div class="box-footer">
                    <a href="<?=base_url('administrasi/list_data');?>" class = "btn btn-primary row-sm-2"><i class="fa fa-pencil"></i> Kembali</a>
                    <a href="<?=base_url('administrasi/update/'.$no);?>" class = "btn btn-success row-sm-2"><i class="fa fa-pencil"></i> Update</a>
                  </div>
                  </form>

                </div>
</section>