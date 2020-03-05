<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Create Transaction</title>

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
            <div class="alert alert-danger print-error-msg col-sm-8" style="display:none">
                <ul></ul>
            </div>
            <div class="card">
            <h5 class="card-header">
                <span id="invoice_id">Add New Transaction</span>
            </h5>
                <div class="card-body">
                <form id="form_add" enctype="multipart/form-data" role="form">
                <input type="hidden" name="clientid" id="clientid" value="{{$clientid}}">
                    <div class="row" style="padding-top: 5px; padding-right: 25px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Date</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="date" class="form-control form-control-sm col-lg-6" name="date" id="date">
                        </div>
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Amount In</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="text" class="form-control-sm form-control col-sm-6" name="amountin" id="amountin">
                        </div>
                    </div>
                    <div class="row" style="padding-right: 25px; padding-top: 5px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Description</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="test" name="description" id="description" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Fee</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="text" class="form-control-sm form-control col-sm-6" name="fee" id="fee">
                        </div>
                    </div>
                    <div class="row" style="padding-right: 25px; padding-top: 5px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Transaction ID</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="text" name="transactionid" id="transactionid" class="form-control-sm form-control">
                        </div>
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Amount Out</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="text" class="form-control-sm form-control col-sm-6" name="amountout" id="amountout">
                        </div>
                    </div>
                    <div class="row" style="padding-right: 25px; padding-top: 5px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Invoice ID</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="text" class="form-control-sm form-control col-sm-6" name="invoiceid" id="invoiceid">
                        </div>
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Add to credit client</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <input type="checkbox" class="form-control-sm form-control col-sm-1" name="credit" id="credit" value="credit">
                        </div>
                    </div>
                    <div class="row" style="padding-right: 25px; padding-top: 5px;">
                        <div class="col-sm-2">
                            <label>Payment</label>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            <select name="paymentmethod" id="paymentmethod" class="form-control col-sm-8 form-control-sm">
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Paypal">Paypal</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f2f2">
                            
                        </div>
                    </div>
                    <br>
                <center><button class="btn btn-info btn-sm col-sm-2" type="button" onclick="save_transaction()">Save</button></center>
                </div>
            </div>
                <br><br>
            </form>
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
        function save_transaction(){
            var clientid = $("#clientid").val();
            $.ajax({
                url: "/transactions",
                type: "POST",
                dataType: "JSON",
                data: $("#form_add").serialize(),
                success: function(data){
                    if(data.status =="success"){
                        alert(data.message);
                        window.open('/clientdetail/'+clientid, '_self');
                    }else{
                        alert(data.message);
                    }
                }
            });
        }
    </script>                 
</body>

</html>