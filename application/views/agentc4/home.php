<section class="content">
  
  <?php foreach ($tk_in->result() as $row) {}?>
  <?php foreach ($tk_out->result() as $key) {}?>
  <?php foreach ($tot->result() as $tot) {}?>
  <?php foreach ($q->result() as $qs) {}?>

<div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Tiket IN</span>
                  <span class="info-box-number"><?php echo $row->tot_in;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Tiket Assigned</span>
                  <span class="info-box-number"><?php echo $key->tot_out;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-log-in"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Contacted</span>
                  <span class="info-box-number"><?php echo $tot->tot_out;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-log-out"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">No Contacted</span>
                  <span class="info-box-number"><?php echo $qs->tot_out;?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>
        </section>