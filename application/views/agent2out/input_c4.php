<section class="content">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Input Tiket C4</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
                  if (empty($dt->no_tiket)) {
                   echo '<script type="text/javascript">alert("hello!");</script>';
                  }


                ?>
                <form class="form-horizontal" action="<?php echo base_url('agent2out/act_inputc4'); ?>" method="post">
                  <div class="box-body">

                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">No Tiket</label>
                      <div class="col-sm-3">
                        <input type="teks" class="form-control" placeholder="<?php echo $dt->no_tiket; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Lapul</label>
                      <div class="col-sm-3">
                        <input type="teks" class="form-control" placeholder="<?php echo $dt->lapul; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Witel</label>
                      <div class="col-sm-3">
                        <input type="teks" class="form-control" placeholder="<?php echo $dt->witel; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Kandatel</label>
                      <div class="col-sm-3">
                        <input type="teks" class="form-control" placeholder="<?php echo $dt->kandatel; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Emosi Pelanggan</label>
                      <div class="col-sm-3">
                        <input type="teks" class="form-control" placeholder="<?php echo $dt->emosi_plg; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Tiket Open</label>
                      <div class="col-sm-3">
                        <input type="teks" class="form-control" placeholder="<?php echo $dt->trouble_opentime; ?>" disabled>
                      </div>
                    </div>                    
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Status Call</label>
                      <div class="col-sm-3">
                        <select name='sta' id='sta' class="form-control">
                          <option value='3'>Contacted</option>
                          <option value='4'>Not Contacted</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Feedback</label>
                      <div class="col-sm-3">
                        <textarea class="form-control" rows="5" id="ket" name="ket" ></textarea>
                      </div>
                    </div>

                  <input type="hidden" name="no_tiket" value="<?php echo $dt->no_tiket; ?>" /> 
                  <input type="hidden" name="logid" value="<?php echo $this->session->userdata('user1');?>" />        
                  
                  
                  
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>                   
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- general form elements disabled -->
</section>
