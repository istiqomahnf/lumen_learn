<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Client Summary</title>

  <!-- Custom fonts for this template-->
  <link href="/asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/asset/css/sb-admin-2.min.css" rel="stylesheet">
        <style type="text/css">
            .table{
                font-size: 12px;
                word-wrap: break-word;
            }
            .btn-group-xs > .btn, .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .8;
              border-radius: .2rem;
            }
            .card-title{
                font-weight: bold;
                color: #1b337a;
                text-align: center;
            }
            td{
                
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
                <span class="fas fa-user-circle fa-lg"></span>
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
            <div class="row">
                <div class="card col-lg-4 col-md-6 col-sm-12" style="margin-left:20px;">
                    <div class="card-body">
                        <h5 class="card-title">Client Information</h5><br>
                        <table width="100%" class="table table-striped">
                            @foreach($data as $value)
                            <tr>
                                <td>Firstname</td>
                                <td>{{$value['firstname']}}</td>
                            </tr>
                            <tr>
                                <td>Lastname</td>
                                <td>{{$value->lastname}}</td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td>{{$value->companyname}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$value->email}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$value->address}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$value->city}}</td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td>{{$value->city}}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{$value->country}}</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>{{$value->phonenumber}}</td>
                            </tr>
                        </table>
                        <a href="javascript:void(0)" onclick="client_login('{{$value->clientid}}')"><i class="fas fa-sign-in-alt"></i> Login as Client</a> 
                        @endforeach
                    </div>
                </div> &nbsp;
                <div class="card col-lg-3 col-md-6 col-sm-12" >
                    <div class="card-body">
                        <h5 class="card-title">Invoice/Billing</h5><br>
                        <table width="100%" class="table table-striped">
                            @foreach($data as $value)
                            <tr>
                                <td>Paid</td>
                                <td>{{$paid}}</td>
                            </tr>
                            <tr>
                                <td>Unpaid</td>
                                <td>{{$unpaid}}</td>
                            </tr>
                            <tr>
                                <td>Draft</td>
                                <td>{{$draft}}</td>
                            </tr>
                            <tr>
                                <td>Cancelled</td>
                                <td>{{$cancel}}</td>
                            </tr>
                            <tr>
                                <td>Refunded</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Income</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Credit Balance</td>
                                <td>{{$value->credit}}</td>
                            </tr>
                        </table>
                        <a href="/client/invoices/{{$value->clientid}}"><i class="fas fa-list"></i> List Invoice</a><br>
                        <a href="/invoice/add/{{$value->clientid}}"><i class="fas fa-edit"></i> Create Invoice</a><br>
                        <a href="/transaction/{{$value->clientid}}"><i class="fas fa-fire"></i> Add Transaction</a><br>
                        <a href="/transaction/client/{{$value->clientid}}"><i class="fas fa-list-alt"></i> List Transaction</a><br>
                        @endforeach
                    </div>
                </div>&nbsp;
                <div class="card col-lg-4 col-md-6 col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title">Other Information</h5><br>
                        <table width="100%" class="table table-striped">
                            @foreach($data as $value)
                            <tr>
                                <td>Status</td>
                                <td>{{$value['status']}}</td>
                            </tr>
                            <tr>
                                <td>Signup Date</td>
                                <td>{{$value->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td>{{$value->paymentmethod}}</td>
                            </tr>
                            <tr>
                                <td>Currency</td>
                                <td>{{$value->currency}}</td>
                            </tr>
                            <tr>
                                <td>Admin Notes</td>
                                <td>{{$value->notes}}</td>
                            </tr>
                            @endforeach
                        </table>
                        <a href="/client/data/{{$value->clientid}}"><i class="fas fa-pen"></i> Edit Client</a> 
                    </div>
                </div> &nbsp;
            </div><br>
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
        function client_login(id){
            $.ajax({
                url: "/client/login/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    if (data.status == "success") {
                        alert(data.message);
                        window.open('/clientarea/home/'+id, '_blank');
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    </script>                 
</body>

</html>