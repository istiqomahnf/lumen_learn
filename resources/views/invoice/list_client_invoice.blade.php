<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Client Invoices</title>

  <!-- Custom fonts for this template-->
  <link href="/asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/asset/css/sb-admin-2.min.css" rel="stylesheet">
        <style type="text/css">
            .table{
                font-size: 12px;
                line-height: 12px; 
            }
            .btn-group-xs > .btn, .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .8;
              border-radius: .2rem;
            }
            th{
                text-align: center;
            }
            label{
                display: block;
                text-align: right;
            }
            #page-top{
                background-color: #ffffff;
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
            <form id="form-search">
            <div class="card"> 
            <h5 class="card-header"><a href="/invoice/add/{{$userid}}"><button class="btn btn-primary btn-sm float-right" type="button"><b>Create Invoice</b></button></a></h5>
            <input type="hidden" name="userid" id="userid" value="{{Request::segment(3)}}">
                <div class="card-body">
                    <div class="row" style="padding-right: 25px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Invoice</label>
                        </div>
                        <div class="col-sm-3" style="background-color:#f2f2f2">
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="invoiceid" id="invoiceid">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Invoice Date</label>
                        </div>
                        <div class="col-sm-3" style="background-color:#f2f2f2">
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" type="date" id="date" name="date">
                            </div>
                        </div>

                        <div class='col-lg-2 col-sm-2'>
                            <button type="button" id="btn-search" onclick="search_invoice()" class="btn btn-secondary btn-sm btn-block"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px; padding-right: 25px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Payment Method</label>
                        </div>
                        <div class="col-sm-3" style="background-color:#f2f2f2">
                            <div class="col-sm-10">
                            <select name="payment" id="payment" class="form-control  form-control-sm">
                                    <option value="any">Any</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Due Date</label>
                        </div>
                        <div class="col-sm-3" style="background-color:#f2f2f2">
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" type="date" id="duedate" name="duedate">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px; padding-right: 25px;">
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Status</label>
                        </div>
                        <div class="col-sm-3" style="background-color:#f2f2f2">
                            <div class="col-sm-6">
                                <select name="status" id="status" class="form-control  form-control-sm">
                                    <option value="any">Any</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="col-form-label-sm">Date Paid</label>
                        </div>
                        <div class="col-sm-3" style="background-color:#f2f2f2">
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" type="date" id="datepaid" name="datepaid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <hr>
            <table width="100%" class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Invoice ID</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Date Paid</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <form id="form_invoice">
                <tbody id ="invoice_content">
                    @foreach($invoices as $val)
                    <tr>
                        <td><input type="checkbox" name="select[]" id="select" value="{{$val->invoiceid}}"></td>
                        <td><center><a href="/invoice/detail/{{$val->invoiceid}}">#{{$val->invoiceid}}</a></center></td>
                        <td align="center">{{$val->date}}</td>
                        <td align="center">{{$val->duedate}}</td>
                        <td align="center">{{$val->datepaid}}</td>
                        <td align="center">{{$val->total}}</td>
                        <td>{{$val->paymentmethod}}</td>
                        <td align="center">{{$val->status}}</td>
                        <td align="center">
                            <a href="/invoice/detail/{{$val->invoiceid}}">
                                <button type="button" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></button></a> | 
                            <button type="button" class="btn btn-xs btn-danger" onclick="delete_inv('{{$val->invoiceid}}')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            With Selected : 
            <button class="btn btn-sm btn-secondary" type="button" onclick="merge_invoice()">Merge</button>
            <button class="btn btn-sm btn-secondary" type="button" onclick="mass_payment()">Mass Pay</button>
            <button class="btn btn-sm btn-danger" type="button" onclick="delete_invoice()">Delete</button>
            <br>&nbsp;
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
        function delete_inv(id){
            var userid = "{{ (Request::segment(3)) }}";
            if(confirm("Are u sure to delete this Invoice ?")){
                $.ajax({
                    url: "/invoice/"+id,
                    type: "DELETE",
                    dataType: "JSON",
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        if (data.status == "success") {
                            alert(data.message);
                            window.open('/client/invoices/'+userid, '_self');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        }

        function search_invoice(){
            $("#invoice_content").empty();
            $.ajax({
                url: "/invoice/v1/search",
                type: "POST",
                dataType: "JSON",
                data: $("#form-search").serialize(),
                success: function(data){
                    for(var i = 0; i < data.invoice.length; i++){
                        var $tr = $('<tr>').append(
                            $('<td align="center"><input type="checkbox" name="select[]" id="select" value="'+data.invoice[i].invoiceid+'"></td>'),
                            $('<td align="center"><a href="/invoice/detail/'+data.invoice[i].invoiceid+'">#'+data.invoice[i].invoiceid+'</a></td>'),
                            $('<td align="center">'+data.invoice[i].date+'</td>'),
                            $('<td align="center">'+data.invoice[i].duedate+'</td>'),
                            $('<td align="center">'+data.invoice[i].datepaid+'</td>'),
                            $('<td align="center">'+data.invoice[i].total+'</td>'),
                            $('<td>'+data.invoice[i].paymentmethod+'</td>'),
                            $('<td align="center">'+data.invoice[i].status+'</td>'),
                            $('<td align="center"><a href="/invoice/detail/'+data.invoice[i].invoiceid+'"><button type="button" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></button></a> | <button type="button" class="btn btn-xs btn-danger" onclick="delete_inv('+data.invoice[i].invoiceid+')"><i class="fas fa-trash"></i></button></td>')
                        ).appendTo('#invoice_content');
                    }
                }
            });
        }

        function merge_invoice(){
            var x = $('input[name="select[]"]:checked');
            if(x.length < 2){
                alert("You must select at least 2 invoice");
                return false;
            }
            var id = "{{Request::segment(3)}}";
            $.ajax({
                url: "/invoices/merge",
                type: "POST",
                dataType: "JSON",
                data: $("#form_invoice").serialize(),
                success: function(data){
                    if(data.status == "success"){
                        alert(data.message);
                        window.open('/client/invoices/'+id, '_self');
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
        function mass_payment(){
            var id = "{{Request::segment(3)}}";
            $.ajax({
                url: "/invoices/mass/"+id,
                type: "POST",
                dataType: "JSON",
                data: $("#form_invoice").serialize(),
                success: function(data){
                    if(data.status == "success"){
                        alert(data.message);
                        window.open('/client/invoices/'+id, '_self');
                    } else {
                        alert(data.message);
                    }
                }
            });
        }

        function delete_invoice(){
            var id = "{{Request::segment(3)}}";
            $.ajax({
                url: "/invoices/delete",
                type: "POST",
                dataType: "JSON",
                data: $("#form_invoice").serialize(),
                success: function(data){
                    console.log(data);
                }
            });
        }
    </script>                 
</body>

</html>