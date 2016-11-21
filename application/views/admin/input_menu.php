<!-- Horizontal Form -->
<section class="content">
              <div class="box box-info">
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo $action;?>" method="post">
                  <div class="box-body">
                   
                    <!-- <div class="form-group">
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
                    </div> -->

                    <div class="form-group">
                      
                      <label for="varchar" class="col-sm-2 control-label">Nama Tiket</label>
                      <div class="col-sm-10">
                        <input type="teks" class="form-control" id="nm_tiket" name="nm_tiket" placeholder="Nama tiket" value="<?php echo $nm_tiket; ?>" />
                        <?php echo form_error('nm_tiket'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="varchar" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                      <select class="form-control" id="sw" name="sw">
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                      </select>
                  </div>
                  </div>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                  <a href="<?php echo site_url('admin/edit_menu') ?>" class="btn btn-default">Cancel</button></a>                   
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- general form elements disabled -->
</section>
<div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            Menu yang dibuat dan aktif akan langsung tampil di halaman agent.
          </div>
        </div>