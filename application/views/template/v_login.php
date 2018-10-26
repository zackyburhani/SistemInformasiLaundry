<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kezia Laundry Service</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css')?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/iCheck/all.css')?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/select2/dist/css/select2.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/skins/_all-skins.min.css')?>">
   <!-- logo -->
  <link rel="SHORTCUT ICON" href="<?php echo base_url('assets/img/title.png')?>">
  <!-- SweetAlert -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/AdminLTE/dist/css/sweetalert.css')?>">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">

  <!-- ajax -->
  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery/dist/jquery.min.js')?>"></script>

  <!-- Datatables -->
  <script src="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
  <!-- SweetAlert -->
  <script src="<?php echo base_url('assets/sweetalert/docs/assets/sweetalert/sweetalert.min.js')?>"></script>

</head>
<body class="hold-transition login-page" style="background: #87bdd8;">
<div class="login-box" style="box-shadow: 6px 7px 5px -4px rgba(0,0,0,0.36); margin-top: 80px">
  <!-- /.login-logo -->
  <div class="login-box-body" style="background : #e3e5ed">
    <div class="login-logo">
      <img src="assets/img/logo.png" alt="User Image" height="100%" width="100%"><br>
      <hr>
    </div>
    <form action="<?php echo site_url('login/auth') ?>" method="POST">
    	

    <?php if ($this->session->flashdata('pesanGagal') == TRUE) { ?>
        <script>
            setTimeout(function() {
              	swal({
                  title: "Username Atau Password Salah",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
            }, 600);
        </script>
    <?php } ?>

    <!-- /.INPUTAN ID -->
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
    <!-- END INPUTAN ID -->

    <!-- INPUTAN PASSWORD -->
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    <!-- END INPUTAN PASSWORD -->
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/select2/dist/js/select2.full.min.js')?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/input-mask/jquery.inputmask.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/moment/min/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js')?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/iCheck/icheck.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/AdminLTE/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/demo.js')?>"></script>
</body>
</html>
