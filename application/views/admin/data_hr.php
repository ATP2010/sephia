<style type="text/css">
#example_filter
{
    display:none;
}
</style>

 <?php $ts = time(); ?>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script type="text/javascript">
      var JS_BASE_URL = '<?php echo site_url(); ?>';
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/public/js/zjs.utils.js?ts=<?php echo $ts ?>"></script>
<?php $ts = time(); ?>
<?php
$jsArray = array('assets/public/js/jQuery.dtplugin.js');
$cssArray = array();


            if (isset($jsArray) && is_array($jsArray)) {
                foreach ($jsArray as $value) {
                    echo '<script type="text/javascript" src="' . base_url() . $value . '?ts=' . $ts . '"></script>' . PHP_EOL;
                }
            }
            if (isset($cssArray)) {
                foreach ($cssArray as $value) {
                    echo '<link href="' . base_url() . $value . '?ts=' . $ts . '" type="text/css" rel="stylesheet" />' . PHP_EOL;
                }
            }
      
    ?>


<section class="content">
<div class="box">
<div class="box-body table-responsive padding">
<div class="box-header with-border">
<table class="table table-bordered table-striped table-hover" id="example">
  <thead>
                      <tr>
                        <td></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                      </tr>
                      <tr>
                        <th>Order#</th>
                        <th>Order Dt</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Customer</th>
                        
                      </tr>
                    </thead>
                    <tbody></tbody>
</table>
</div>
<div class="box-footer">
<button id="btnExport" class="btn btn-default pull-left">Export to excel</button></div>
</div>
</div>
</section>

<script type="text/javascript">
  $("#example_filter").css("display","none"); //hilangkan search utama
</script>

<script type="text/javascript">
 $(function() {
//wait till the page is fully loaded before loading table
//dataTableSearch() is optional.  It is a jQuery plugin that looks for    input fields in the thead to bind to the table searching
$("#example").dataTable({
  processing: true,
 serverSide: true,
  ajax: {
 "url": JS_BASE_URL + "/admin/dataTable_hr",
"type": "POST"
},
columns: [
{ data: "o.name" },
{ data: "o.username" },
{ data: "c.user3" },
{ data: "c.user4" },
],
  "columnDefs": [ { 
        "render": function ( data, type, row) {
          return '<a class="uk-botton uk-botton-primary" href="#/'+data+'">Edit</a>';
        },
        "targets": 0,
    }]

}).dataTableSearch(500);
});

</script>



