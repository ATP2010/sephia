<section class="content">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Input Hard Complaint</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo $action;?>" method="post">
                  <div class="box-body">

                  <?php
                  $info = $this->session->flashdata('hc_oke');
                  if (!empty($info)) {
                  echo $info;
                  }
                  ?>
                   
                    <div class="form-group">
                      <label for="tanggal" class="col-sm-2 control-label">Tanggal</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" placeholder="<?php echo date('Y-m-d H:i:s')?>" disabled>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="logid" class="col-sm-2 control-label">Logid</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" placeholder="<?php echo $this->session->userdata('user1');?>"  disabled>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Witel</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="witel" name="witel" placeholder="Witel" value="<?php echo $witel; ?>" />
                        <?php echo form_error('witel'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Nama Pelapor</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="nm_pelapor" name="nm_pelapor" placeholder="Nama Pelapor" value="<?php echo $nm_pelapor; ?>" />
                        <?php echo form_error('nm_pelapor'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Nama Pelanggan</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="nm_pelanggan" name="nm_pelanggan" placeholder="Nama Pelanggan" value="<?php echo $nm_pelanggan; ?>" />
                        <?php echo form_error('nm_pelanggan'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">No FASTEL</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="no_fastel" name="no_fastel" placeholder="No FASTEL" value="<?php echo $no_fastel; ?>" />
                        <?php echo form_error('no_fastel'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="alamat" name="alamat" placeholder="Alamat" ><?php echo $alamat; ?></textarea>
                        <?php echo form_error('alamat') ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">No Tiket</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="no_tiket" name="no_tiket" placeholder="No Tiket" value="<?php echo $no_tiket; ?>" />
                        <?php echo form_error('no_tiket'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Tanggal Open</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="tgl_open" name="tgl_open" placeholder="Tanggal Open" value="<?php echo $tgl_open; ?>" />
                        <?php echo form_error('tgl_open'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Status Tiket</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="sta_tiket" name="sta_tiket" placeholder="Status Tiket" value="<?php echo $sta_tiket; ?>" />
                        <?php echo form_error('sta_tiket'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Lapul</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="lapul" name="lapul" placeholder="Lapul" value="<?php echo $lapul; ?>" />
                        <?php echo form_error('lapul'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Gaul</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="gaul" name="gaul" placeholder="Gaul" value="<?php echo $gaul; ?>" />
                        <?php echo form_error('gaul'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">CP</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="cp" name="cp" placeholder="CP" value="<?php echo $cp; ?>" />
                        <?php echo form_error('cp'); ?>
                      </div>
                    </div>

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" />
                        <?php echo form_error('email'); ?>
                      </div>
                    </div>
                    
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Keluhan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="keluhan" name="keluhan" placeholder="Keluhan" ><?php echo $keluhan; ?></textarea>
                        <?php echo form_error('keluhan') ?>
                      </div>
                    </div>


                  <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d H:i:s')?>" /> 
                  <input type="hidden" name="logid" value="<?php echo $this->session->userdata('user1');?>" />        
                  <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                  <input type="hidden" name="by_sup" value="new" /> 
                  <input type="hidden" name="by_tl" value="new" /> 
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                  <a href="<?php echo site_url('agent2out/list_hc') ?>" class="btn btn-default">Cancel</button></a>
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- general form elements disabled -->
</section>
