 <nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-info">
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
         </li>
     </ul>
     <ul class="navbar-nav ml-auto">
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-user"></i>
                 <span>Welcome, <b><?=$empSession['emp_name']?></b></span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="#" id="logoff" class="btn btn-danger btn-block"><i class="fa fa-power-off"></i> ออกจากระบบ</a>
             </div>
         </li>
     </ul>
 </nav>

 <script>
$('#logoff').on("click", function(event) {
    event.preventDefault();
    swal({
            title: "ยืนยันการออกจากระบบ ?",
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((createCnf) => {
            if (createCnf) {
                $.ajax({
                    url: "class/log_off.php",
                    method: "POST",
                    data: $('#addLeave').serialize(),
                    success: function(data) {
                        swal('ออกจากระบบสำเร็จ',
                            'ขอบคุณที่ใช้บริการ',
                            'success', {
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                                buttons: false,
                                timer: 3000,
                            });
                        window.setTimeout(function() {
                            location.replace('?')
                        }, 1500);
                    }
                });
            }
        });
});
 </script>