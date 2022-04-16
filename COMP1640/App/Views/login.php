<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/App/Views/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/App/Views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/App/Views/dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="/App/Views/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/App/Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/App/Views/dist/js/adminlte.min.js"></script>
  <!-- Toastr -->
  <script src="/App/Views/plugins/toastr/toastr.min.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Panel</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Quality Assurance Manager System</p>
     
      <!-- Show errors if any -->
      <div class="error-box">
      <?php 
        if (isset($data['error']) ) {
          echo '<p style="color:red; text-align:center;">' . $data['error'] . '</p>'; 
        }
      ?>
      </div>

      <form action="<?php echo URLROOT; ?>/users/index" method="POST">
        <div class="input-group mb-3">
          <input name="username" type="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name ="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button id="submit" value="submit" type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php if(isset($_SESSION['user_id'])) : ?>
  <?php header('location:' . URLROOT . '/dashboard/index'); ?>
  <?php endif ; ?>

</body>
</html>
