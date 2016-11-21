<section class="content">
          <!-- START ALERTS AND CALLOUTS -->
          <div class="row">
            <div class="col-md-6">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <i class="fa fa-check-square"></i>
                  <h3 class="box-title">Menu Aktif</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form class="form-horizontal" action="<?php echo $action;?>" method="post">
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Tiket</label>
                      <div class="col-sm-10">
                      <?php 
                      $style='class="form-control"'; 
                      echo form_dropdown('j_tiket', $tkt_aktif, $style); 
                      ?>
                    </div>
                    </div>
                    <input type="hidden" name="sw" value="1" /> 
                    <div class="box-footer">
                  <button type="submit" class="btn btn-danger pull-right"><?php echo $aktif ?></button> 
                  </div>
                  </form>                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header with-border">
                  <i class="fa fa-times-circle"></i>
                  <h3 class="box-title">Menu non-Aktif</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" action="<?php echo $action;?>" method="post">
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Tiket</label>
                      <div class="col-sm-10">
                      <?php 
                      $style='class="form-control"'; 
                      echo form_dropdown('j_tiket', $tkt_non, $style); 
                      ?>
                    </div>
                    </div>
                    <input type="hidden" name="sw" value="0" /> 
                    <div class="box-footer">
                  <button type="submit" class="btn btn-success pull-right"><?php echo $non ?></button> 
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
          <!-- END ALERTS AND CALLOUTS -->
          
        </section>