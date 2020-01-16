<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>POS & STOCK MANAGEMENT : SATIYA SOFTWARE</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300&display=swap" rel="stylesheet">
    <!-- Custom Css -->
    <link href="dist/css/custom.css">
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- SweetAlert -->
    <script src="plugin/sweetalert/sweetalert.min.js"></script>
</head>

<body class="hold-transition lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="#"><b>POS-SHOPPING</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <div class="text-center">
                    <img src="img/login.png" class="img-fluid" width="50%">
                </div>
                <p class="login-box-msg">กรุณาเข้าสู่ระบบเพื่อใช้งาน</p>
                <form action="class/check_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-key"></i>
                                เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <div class="help-block text-center">
        <small>
            ระบบ POS และระบบบริหารจัดการคลังสินค้า <br> Develop By : Satiya799 <br> <i class="fa fa-mobile-alt"></i>
            095-4502270
            <i class="far fa-envelope"></i> satiya3577@gmail.com
        </small>
    </div>
    </div>
</body>
<?php
      if($_SESSION['authen']=='fail'){  
          echo "
          <script type='text/javascript'>
          $(document).ready(function() {
              swal('เข้าสู่ระบบล้มเหลว',
                  'ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง', 'error', {
                      closeOnClickOutside: false,
                      closeOnEsc: false,
                      buttons: false,
                      timer: 3000,
                  });
              });
          </script>";  
          unset($_SESSION['authen']);
      }
      ?>

</html>