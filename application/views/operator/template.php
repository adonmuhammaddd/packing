<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $title ?>
</title>
  <link rel='icon' href='<?= base_url('assets/Logo-Melcoinda.jpg') ?>' type='image/x-icon' sizes="16x16" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</head>
<body
<?php 
  if ($this->fungsi->user_login()->level == 10)
  {
    echo "class='sidebar-collapse'";
  }
?>
">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <span class="logo-mini"><b>MIDA</b></span>
      <span class="logo-lg"><b>Melcoinda </b>Packing</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
      <!-- Menu Footer-->
      <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/Logo-Melcoinda.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">
                <?php 
                  $level = $this->fungsi->user_login()->level;
                  if ($level == 1)
                  {
                    echo "Admin";
                  }
                  else if ($level == 2)
                  {
                    echo "Operator";
                  }
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/Logo-Melcoinda.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $this->fungsi->user_login()->name?>
                  <small><?php 
                  $level = $this->fungsi->user_login()->level;
                  if ($level == 1)
                  {
                    echo "Admin";
                  }
                  else if ($level == 2)
                  {
                    echo "Operator";
                  }
                ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('auth/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
    </div>
    </nav>
  </header>
  <?php 
  if ($this->fungsi->user_login()->level == 1 || $this->fungsi->user_login()->level == 2 || $this->fungsi->user_login()->level == 3 || $this->fungsi->user_login()->level == 4) 
  {
    require_once('sidebar.php');
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $contents ?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://kenangncode.com">Melcoinda</a>.</strong> All rights
    reserved.
  </footer>
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-prevent">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Hmm.. Hmm.. No noo</h4>
            </div>
            <div class="modal-footer">
                <form id="delete-data" action="" method="post">
                    <div class="text-center">
                        <button class="btn btn-flat btn-default" data-dismiss="modal">
                            Okay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script>
    var base_url = '<?= base_url(); ?>';
  $(document).ready(function()
  {
    $('#mytable').DataTable();
    // Disable Right CLick
    document.addEventListener('contextmenu', event => event.preventDefault());
    // End Disable Right CLick
  });

  // Disable Right Click || Ctrl+Shift+I || Ctrl+U || F12
  // window.oncontextmenu = function () 
  // {
  //   return false;
  // }
  // $(document).keydown(function (event) 
  // {
  //     if (event.keyCode == 123) {
  //         $('#modal-prevent').modal('show');
  //         return false;
  //     }
  //     else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.ctrlKey && event.keyCode=== 85) || (event.ctrlKey && event.keyCode === 83)) {
  //         $('#modal-prevent').modal('show');
  //         return false;
  //     }
  // });
  // End Disable Right Click || Ctrl+Shift+I || Ctrl+U || F12
</script>
</body>
</html>
