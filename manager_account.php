<?php include ('header.php'); ?>
  <title>QUẢN LÝ ACCOUNT</title>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 

    <?php include ('sidebar.php'); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>QUẢN LÝ TÀI KHOẢN</h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card card-warning">
                  <div class="card-header">
                     <h3 class="card-title">  NHẬP TÀI KHOẢN</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <form>
                        <div class="row">
                           <!-- <div class="col-sm-8">
                              <div class="form-group">
                                 <label>NHẬP DỮ LIỆU TÀI KHOẢN</label>
                                 <textarea id="list_acc_new" class="form-control" rows="6" placeholder="username|pass|2fa"></textarea>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group"><label> Nhập tên nhóm account mới</label>
                                 <input name="nam_group_acc" class="form-control" type="text" placeholder="tên nhóm account">
                              </div>
                           </div>
                           <div class="col-sm-8"></div>
                           <div class="col-sm-4">
                              <button type="button" class="new_acc_btn btn btn-block bg-gradient-primary btn-lg" style="FONT-SIZE: 16px;margin-bottom: 20px;">NHẬP TÀI KHOẢN MỚI</button>
                           </div> -->
                           
                        
                <div class="card-body">
                     <form>
                     <div class="row">
                     <div class="col-sm-8">
                     <!-- textarea -->
                     <div class="form-group">
                     <label>UPDATE TÀI KHOẢN VÀO NHÓM CÓ SẴN</label>
                     <textarea id="update_acc" class="form-control" rows="6" placeholder="username|pass|2fa"></textarea>
                     </div>
                     </div>
                     <div class="col-sm-4">
                      <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="logined" value="1" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">Đã login </label>
                    </div>
                  </div>
                 
                     <!-- select -->
                     <div class="form-group">
                     <label>Nhóm tài khoản</label>
                     <select id="group_id" class="form-control">
                     <?php $group =(load_group_acc(1));     
                        while ($g = mysqli_fetch_object($group)) {
                         echo   "<option value=".$g->group_id.">".$g->name_group."</option>";
                        }
                        ?>
                     </select>
                     </div>
                        <label>Tên máy</label>
                        <input type="text" placeholder="Nhập tên máy" id="name_machine" class="form-control"></input>
                     </div>
                     <div class="col-sm-8"></div>
                     <div class="col-sm-4">
                     <button type="button" class="btn_update_acc btn btn-block bg-gradient-primary btn-lg" style="FONT-SIZE: 16px;margin-bottom: 20px;">CẬP NHẬT TÀI KHOẢN</button></div>
                     <div class="col-12">
                     </div>
                     <!-- /.col -->
                     </div>
                     </form>
                     </div>
                     <!-- /.card-body -->
                     </div>
                  </div>
               </div>
            </div>
            <!--/. container-fluid -->
          </div>
        </div>
      <!-- Default box -->
 <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH TÀI KHOẢN </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Email/SDT</th>
                    <th>Pass</th>
                    <th>Đã login</th>
                    <th>Tình trạng</th>
                    <th>Nhóm tài khoản</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  <?php 
                    $acc = load_all_account(1);
                       while ($content = mysqli_fetch_object($acc)) {
                        echo "<tr>";
                        echo "<td>".$content->username."</td>";
                        echo "<td>".$content->pass."</td>";
                        echo "<td>";
                        echo ($content->logined == 1)? "Đã đăng nhập" : "chưa đăng nhập";
                        echo "</td>";
                        if ($content->checkpoint ==1)
                        {
                           echo "<td class='checkpoint'>Checkpoint</td>";
                        }
                       else
                       {
                        echo "<td>OK</td>";
                       }
                        echo "<td>".$content->name_group."</td>";
                        echo "<td><button id='".$content->id."' type='button' class='btn btn-success toastrDefaultSuccess btn_remove_acc btn-block btn-danger btn-sm'>Xoá TK</button></td>";
                        echo "</tr>";
                      }
            
             
           
              ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>Email/SDT</th>
                    <th>Pass</th>
                    <th>Đã login</th>
                    <th>Tình trạng</th>
                    <th>Nhóm tài khoản</th>
                    <th>Thao tác</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include ('footer.php'); ?>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
    "searching": false,
      "buttons": ["copy", "csv","print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });
</script>