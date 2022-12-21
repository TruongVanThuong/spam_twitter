<?php include ('header.php'); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>AMM</b> v3.9</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Nếu chưa có tài khoản. Vui lòng liên hệ admin</p>

      <form id="login" method="post" >
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control" placeholder="Nhập username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pass" type="password" class="form-control" placeholder="Nhập password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" class="btn_login btn btn-primary btn-block">Sign In</button>
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

</body>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<script>
	    $('.btn_login').on('click',function(){
        event.preventDefault();
 
        var dt = $('form').serialize();
            $.ajax({
            type: "POST",
            url: 'func/user.php',
            data: dt,
            dataType: "text",
            success: function(data) {
                console.log("data : ",data);
                if (data == 'OK'){
                        toastr.success('Đăng nhập thành công.')
                         window.setTimeout(function() {
                     window.location="http://localhost/spam_twitter/";
                      }, 1000);

                }
                else{
                        toastr.error('Vui lòng kiểm tra lại thông tin.')

                }
            },
            error: function(e) {
      toastr.error('Lỗi máy chủ.')

            }
        });
    });

</script>



