<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Client</title>

  <!-- Custom fonts for this template-->
  <link href="/asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/asset/css/sb-admin-2.min.css" rel="stylesheet">
  <style type="text/css">
      .table{
          font-size: 13px;
          line-height: 12px; 
      }
      .btn-group-xs > .btn, .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .8;
        border-radius: .2rem;
      }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Billing <!-- <sup>2</sup>--></div>
      </a>
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/client/all">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Interface
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-users"></i>
          <span>Clients</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="/client/all">View Clients</a>
            <a class="collapse-item" href="/client/add">Add New Client</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-table"></i>
          <span>Invoice</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">By Status : </h6>
            <a class="collapse-item" href="/invoice/unpaid">- Unpaid</a>
            <a class="collapse-item" href="/invoice/paid">- Paid</a>
            <a class="collapse-item" href="/invoice/draft">- Draft</a>
            <a class="collapse-item" href="/invoice/cancelled">- Cancelled</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-cog fa-lg"></span>
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="alert alert-primary" role="alert">
                Add New Client
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <div class="card col-sm-12">
            <form action="" role="form" id= "form-add">
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">First Name</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="text" name="firstname" class="form-control form-control-sm" id="firstname" >
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Address</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control form-control-sm" id="address" >
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Last Name</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="text" name="lastname" class="form-control form-control-sm" id="lastname" >
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">City</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="text" name="city" class="form-control form-control-sm" id="city" >
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Company Name</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="text" name="company" class="form-control form-control-sm" id="company" placeholder="(Optional)">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Postcode</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-6">
                            <input type="text" name="postcode" class="form-control form-control-sm" id="postcode" >
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Email Adress</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control form-control-sm" id="email" >
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Country</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-6">
                            <select name="country" class="form-control form-control-sm" id="country" >
                                <option value="Indonesia">Indonesia</option>
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Password</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control form-control-sm" id="password" >
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Payment Method</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-6">
                            <select name="paymentmethod" class="form-control form-control-sm" id="paymentmethod" >
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Paypal">Paypal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Phone Number</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-10">
                            <input type="number" name="phonenumber" class="form-control form-control-sm" id="phonenumber" >
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Currency</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-4">
                            <select name="currency" class="form-control form-control-sm" id="currency" >
                                <option value="USD">USD</option>
                                <option value="IDR">IDR</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                        <label for="col-form-label-sm">Status</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-6">
                            <select name="status" class="form-control form-control-sm" id="status" >
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Credit Balance</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <div class="col-sm-6">
                            <input type="text" class='form-control' name="credit" id="credit" value="0.00">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Admin Notes</label>
                    </div>
                    <div class="col-sm-10" style="background-color:#f2f2f2">
                        <textarea name="notes" id="notes" rows="4" class="form-control" placeholder="(Optional)"></textarea>
                    </div>
                </div>
                <div class="row" style="padding-top: 20px; padding-left: 325px; padding-right: 175px; padding-bottom: 20px;">
                <button type="button" class="btn btn-block btn-primary" onclick="save_client()">Save</button>
                </div>
            </form>
            </div>
            <br><br>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" id="log_out" style="color: white;">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/asset/vendor/jquery/jquery.min.js"></script>
  <script src="/asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/asset/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/asset/js/sb-admin-2.min.js"></script>
  <script src="/asset/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/asset/js/demo/chart-area-demo.js"></script>
  <script src="/asset/js/demo/chart-pie-demo.js"></script>                  
  <script>
        function save_client(){
            if(validate()){
                $.ajax({
                    url: "/client/v1",
                    type: "POST",
                    dataType: "JSON",
                    data: $("#form-add").serialize(),
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        if(data.status =="success"){
                            alert(data.message);
                            window.open('/client/all', '_self');
                        }else if(data.status =="err"){
                            alert(data.message);
                        }else{
                            printError(data.error);
                        }
                    }
                });
            }
        }

        function validate(){
            if($("#firstname").val()=="" || $("#email").val()=="" || $("#password").val()=="" || $("#phonenumber").val()=="" || $("#address").val()=="" || $("#city").val()=="" || $("#postcode").val()=="" ){
                alert("Data Incomplete");
                return false;
            }
            return true;
        }

        function printError(data){
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( data, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    </script>                 
</body>

</html>