<section class="content">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Pelanggan</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo $action;?>" method="post">
                  <div class="box-body">
                   
                    <div class="form-group">
                      <label for="tanggal" class="col-sm-2 control-label">Tanggal</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" placeholder="<?php echo date('Y-m-d H:i:s')?>" disabled>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tanggal" class="col-sm-2 control-label">Logid</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" placeholder="<?php echo $this->session->userdata('user1');?>"  disabled>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Jenis tiket</label>
                      <div class="col-sm-10">
                      <?php 
                      $style='class="form-control"'; 
                      echo form_dropdown('j_tiket', $jns_tiket, $style); 
                      ?>
                    </div>
                    </div>

                    <div class="form-group">
                      
                      <label for="varchar" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="no_telp" name="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
                        <?php echo form_error('no_telp'); ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Internet</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_inet" id="no_inet" placeholder="no_inet" value="<?php echo $no_inet; ?>" />
                        <?php echo form_error('no_inet') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Nama Pelapor</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nm_pelapor" id="nm_pelapor" placeholder="nm_pelapor" value="<?php echo $nm_pelapor; ?>" />
                        <?php echo form_error('nm_pelapor') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">No CP</label>
                      <div class="col-sm-10"><input type="text" class="form-control" name="no_cp" id="no_cp" placeholder="no_cp" value="<?php echo $no_cp; ?>" />
                        <?php echo form_error('no_cp') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
                        <?php echo form_error('email') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Atas nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="atas_nama" value="<?php echo $atas_nama; ?>" />
                        <?php echo form_error('atas_nama') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="alamat" name="alamat" placeholder="Alamat" ><?php echo $alamat; ?></textarea>
                        <?php echo form_error('alamat') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Detail gangguan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="detail" name="detail" placeholder="Detail gangguan" ><?php echo $detail; ?></textarea>
                        <?php echo form_error('detail') ?>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d H:i:s')?>" /> 
                  <input type="hidden" name="logid" value="<?php echo $this->session->userdata('user1');?>" />        
                  <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                  <a href="<?php echo site_url('agent/tiket_in') ?>" class="btn btn-default">Cancel</button></a>
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- general form elements disabled -->
</section>
