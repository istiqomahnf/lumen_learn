<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Detail Invoice</title>

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
            .card{
                font-size: 14px;
                line-height: 16px; 
            }
            .btn-group-xs > .btn, .btn-xs {
              padding: .20rem .3rem;
              font-size: .775rem;
              line-height: .6;
              border-radius: .2rem;
            }
            th{
                text-align: center;
            }
            label{
                display: block;
                text-align: right;
            }
            #status_inv{
                font-size: 18px;
                font-weight: bold;
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
            <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Summary</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Credit</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Add Payment</a>
                <a class="nav-item nav-link" id="nav-refund-tab" data-toggle="tab" href="#nav-refund" role="tab" aria-controls="nav-refund" aria-selected="false">Refund</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="alert alert-danger print-error-msg col-sm-8" style="display:none">
                    <ul></ul>
                </div>
                <div class="card">
                    <h5 class="card-header">
                        <span id="invoice_id"></span>
                        <button class="btn btn-primary btn-sm float-right" type="button" id="btn_publish">Publish</button>
                    </h5>
                
                <form role="form" class="form-horizontal" id="form_edit" method="post">
                    <div class="card-body">
                        <div class="row" style="padding-top: 5px; padding-right: 25px;">
                            <div class="col-sm-2">
                                <label for="col-form-label-sm">Client Name</label>
                            </div>
                            <div class="col-sm-4" style="background-color:#f2f2f2">
                                <span id="clientname"></span>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-top: 5px;">
                            <div class="col-sm-2">
                                <label for="col-form-label-sm">Invoice Date</label>
                            </div>
                            <div class="col-sm-4" style="background-color:#f2f2f2">
                                <span id="invdate"></span>
                                <input type="hidden" name="date" id="date" value="">
                            </div>
                            <div class="col-sm-6">
                                <center><span id="status_inv"></span></center>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-top: 5px;">
                            <div class="col-sm-2">
                                <label for="col-form-label-sm">Due Date</label>
                            </div>
                            <div class="col-sm-4" style="background-color:#f2f2f2">
                                <span id="invduedate"></span>
                                <input type="hidden" name="duedate" id="duedate" value="">
                            </div>
                            <div class="col-sm-6">
                                <center><i id="published_at"></i></center>
                                <center><i id="paid_at"></i></center>
                            </div>    
                        </div>
                        <div class="row" style="padding-right: 25px; padding-top: 5px;">
                            <div class="col-sm-2">
                                <label for="col-form-label-sm">Total Due</label>
                            </div>
                            <div class="col-sm-4" style="background-color:#f2f2f2">
                                <span id="totaldue"></span>
                            </div>
                            <div class="col-sm-6">
                            <center>
                                <button class="btn btn-sm btn-outline-success" type="button" id="btn_paid" onclick="mark_process('Paid')">Mark Paid</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" id="btn_unpaid" onclick="mark_process('Unpaid')">Mark Unpaid</button>
                                <button class="btn btn-sm btn-outline-danger" type="button" id="btn_cancel" onclick="mark_process('Cancelled')">Mark Cancelled</button>
                            </center>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-top: 5px;">
                            <div class="col-sm-2">
                                <label for="col-form-label-sm">Balance</label>
                            </div>
                            <div class="col-sm-4" style="background-color:#f2f2f2">
                                <span id="creditbalance"></span>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-top: 5px;">
                            <div class="col-sm-2">
                                <label for="col-form-label-sm">Payment Method</label>
                            </div>
                            <div class="col-sm-4" style="background-color:#f2f2f2">
                                <select name="paymentmethod" id="paymentmethod" class="form-control form-control-sm col-sm-8">
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-top: 5px;">
                            <div class="col-sm-2">
                                <label>Notes</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="notes" id="notes" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 50px; padding-right: 50px;">
                        <table width="100%" class="table table-bordered">
                            <thead>
                                <tr bgcolor="#2d548a" style="color: #ffffff;">
                                    <th width="3%"></th>
                                    <th width="70%">Description</th>
                                    <th>Amount</th>
                                    <th>Taxed</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <input type="hidden" id="userid" name= "userid" value="">
                            <input type="hidden" id="invoiceid" name="invoiceid" value="">
                            <!-- <input type="hidden" id="credit_b" name="credit_b" value=""> -->
                            <tbody id= "item_content">
                            
                            </tbody>
                                <tr bgcolor="#f2f2f2">
                                    <td colspan="2" align="right"><b>
                                        <span class="float-left">
                                            <select name="cekbox" id="cekbox">
                                                <option value="">With selected &nbsp;:</option>
                                                <option value="split">Split Invoice</option>
                                                <option value="multidelete">Delete</option>
                                            </select>
                                        </span>
                                        Sub Total</b>
                                    </td>
                                    <td align="right" id="subtotal"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr bgcolor="#f2f2f2">
                                    <td colspan="2" align="right"><b>10.00%tax</b></td>
                                    <td align="right" id="taxrate"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr bgcolor="#f2f2f2">
                                    <td colspan="2" align="right"><b>Credit</b></td>
                                    <td align="right" id="credit"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr bgcolor="#2d548a" style="color: #ffffff;">
                                    <td colspan="2" align="right"><b>Total Due :</b></td>
                                    <td align="right" id="totaldue_inv"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </table>
                    </div>
                    <hr>
                    <center><button class="btn btn-info btn-sm col-sm-2" type="button" id="save_changes">Save Changes</button></center>
                    <br><br>
                </form>
                </div>
                <br><br>
                <div class="card">
                    <div class="card-header">
                        <h5>Transaction</h5>
                    </div>
                    <div class="card-body text-info">
                        <table id="table_transaction" class="table table-bordered" width="100%">
                            <thead>
                                <tr bgcolor="#2d548a" style="color: #ffffff;">
                                    <th>Date</th>
                                    <th>Payment Method</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody id="trans_content">

                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form role="form" id="form_credit">
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-sm-6">
                            <input type="hidden" name="c_balance_client" id="c_balance_client" value="">
                            <input type="hidden" name="clientid" id="clientid" value="">
                            <input type="hidden" id="id_invoice" name="id_invoice" value="">
                            <center>Add credit to Invoice</center>
                            <center><span id="add_credit_inv"></span></center>
                            <center>
                            <div class="col-sm-4">
                                <input type="text" name="add_credit" id="add_credit" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-secondary btn-sm" id="btn_add_credit">Go</button>
                            </div>
                            </center>
                        </div>
                        <div class="col-sm-6">
                            <center>Remove credit to Invoice</center>
                            <center><span id="remove_credit_inv"></span> Available</center>
                            <center>
                            <div class="col-sm-4">
                                <input type="text" name="remove_credit" id="remove_credit" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-secondary btn-sm" id="btn_remove_credit">Go</button>
                            </div>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <form role="form" id="form_payment">
            <input type="hidden" name="payment_clientid" id="payment_clientid" value="">
            <input type="hidden" name="payment_balance" id="payment_balance" value="">
                <div class="row" style="padding-top: 25px; padding-right: 25px;">
                    <div class="col-sm-3">
                        <label for="col-form-label-sm">Date</label>
                    </div>
                    <div class="col-sm-3" style="background-color:#f2f2f2">
                        <input class="form-control form-control-sm" type="date" id="payment_date" name="payment_date">
                    </div>
                    <div class="col-sm-3">
                        <label for="col-form-label-sm">Payment Method</label>
                    </div>
                    <div class="col-sm-3" style="background-color:#f2f2f2">
                        <select name="payment_paymentmethod" id="payment_paymentmethod" class="form-control form-control-sm col-sm-8">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Paypal">Paypal</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="padding-top: 3px; padding-right: 25px;">
                    <div class="col-sm-3">
                        <label for="col-form-label-sm">Amount</label>
                    </div>
                    <div class="col-sm-3" style="background-color:#f2f2f2">
                        <input class="form-control form-control-sm" type="text" id="payment_amount" name="payment_amount" value="">
                    </div>
                    <div class="col-sm-3">
                        <label for="col-form-label"></label>
                    </div>
                    <div class="col-sm-3" style="background-color:#f2f2f2">
                    
                    </div>
                </div>
                <br>
                </form>
                <center><button type="button" id="btn_payment" class="btn btn-primary btn-sm float-center">Add Payment</button></center>
            </div>
            <div class="tab-pane fade" id="nav-refund" role="tabpanel" aria-labelledby="nav-refund-tab">
            <br>
                <div class="card">
                    <div class="card-body">
                        <form id="form_refund">
                            <div class="row" style="padding-top: 3px; padding-right: 25px;">
                                <div class="col-sm-2"><label>Transactions</label></div>
                                <div class="col-sm-4" style="background-color:#f2f2f2">
                                    <select name="refund_transaction" id="refund_transaction" class="form-control-sm form-control col-sm-8">
                                        <span id="trans_option"></span>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 3px; padding-right: 25px;">
                                <div class="col-sm-2"><label>Amount</label></div>
                                <div class="col-sm-4" style="background-color:#f2f2f2">
                                    <input type="text" name="refund_amount" id="refund_amount" class="form-control form-control-sm col-lg-6">
                                </div>
                            </div>
                            <div class="row" style="padding-top: 3px; padding-right: 25px;">
                                <div class="col-sm-2"><label>Refund Type</label></div>
                                <div class="col-sm-4" style="background-color:#f2f2f2">
                                Add to Client's Credit Balance
                                </div>
                            </div>
                            <div class="row" style="padding-top: 3px; padding-right: 25px;">
                                <div class="col-sm-2"><label>Send Confirmation Email</label></div>
                                <div class="col-sm-4" style="background-color:#f2f2f2">
                                    <input type="checkbox" class="form-control-sm form-control col-sm-1" name="tickemail" id="tickemail" value="tick">     
                                </div>
                            </div>
                            <div class="row" style="padding-top: 3px; padding-right: 25px; padding-top: 20px;">
                            <div class="col-sm-2"></div>
                                <div class="col-sm-4">
                                    <center><button type="button" class="btn btn-sm btn-primary" id="btn_refund" onclick="add_refund()">Refund</button></center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
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
        $(document).ready(function(){
            var id = "<?php echo $inv_id?>";
            inv_detail(id);
            $("#userid").val(id);
        });

        function inv_detail(id){
            var token = "<?php echo Session::get('api_token') ?>";
            $.ajax({
                url: "/invoice/detail/"+id,
                type: "POST",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer '+ token);
                },
                success: function(data){
                    console.log(data); 
                    if(data.invoice.sendinvoice == 1){
                        $("#btn_publish").hide();
                    }
                    var currency = data.invoice.client.currency;
                    $("#invoice_id").html("Invoice #"+data.invoice.invoiceid); $("#invoiceid, #id_invoice").val(data.invoice.invoiceid);
                    $("#clientid, #payment_clientid").val(data.invoice.userid);
                    $("#clientname").html(data.invoice.client.firstname + " " + data.invoice.client.lastname);
                    $("#paymentmethod").val(data.invoice.paymentmethod).change();
                    $("#invdate").html(data.invoice.date); $("#date").val(data.invoice.date);
                    $("#invduedate").html(data.invoice.duedate); $("#duedate").val(data.invoice.duedate);
                        $("#totaldue").html(currency_setting(currency, data.invoice.total));
                        $("#add_credit_inv").html(currency_setting(currency, data.invoice.client.credit)+ " Available");
                    var status = data.invoice.status;
                    if(status == "Paid"){
                        $("#paid_at").html("Paid : "+ data.invoice.datepaid);
                        $("#save_changes, #btn_add_credit, #btn_remove_credit").prop('disabled', true);
                    }
                    var published = data.invoice.published_at;
                    $("#notes").val(data.invoice.notes);
                    $("#status_inv").html(status.toUpperCase());
                    if(data.invoice.published_at != null){
                        $("#published_at").html("Published at : " + published);
                    }
                    var subtotal = 0; var no = 1; var tax = 0;
                    for(var i = 0; i < data.invoice.items.length; i++){
                        if(data.invoice.items[i].itemtaxed == 1){
                            var amount = data.invoice.items[i].itemamount;
                            tax = tax + (amount * 0.1);
                            taxed = "selected";
                        }else{
                            taxed = "";
                        }
                        var item_id = data.invoice.items[i].itemid; 
                        var $tr = $('<tr>').append(
                            $('<td><input type="checkbox" name="item_o" id="select_'+no+'" class="form-control" value="'+data.invoice.items[i].itemid+'"></td>'),
                            $('<td><textarea name="item[description][]" id="description_'+no+'" rows="2" class="form-control form-control-sm">'+data.invoice.items[i].itemdescription+'</textarea></td>'),
                            $('<td><input type="text" name="item[amount][]" id="amount_'+no+'" value="'+data.invoice.items[i].itemamount+'" class="form-control form-control-sm"></td>'),
                            $('<td><select name="item[taxed][]" id="taxed_'+no+'" class="form-control form-control-sm"><option value="a" '+taxed+'>-</option><option value="taxed" '+taxed+'>✓</option></td>'),
                            $('<td><button class="btn btn-xs btn-danger" type="button" onclick="delete_item('+item_id+','+data.invoice.invoiceid+')"><i class="fas fa-trash"></i></button></td>')
                        ).appendTo('#item_content');
                        no++;
                        subtotal = subtotal + parseFloat(data.invoice.items[i].itemamount);
                    }
                    var selectopt = $("#refund_transaction");

                    for(var i = 0; i < data.invoice.transaction.length; i++){
                        var tr_id = ""; var ref = "";
                        if(data.invoice.transaction[i].transactionid != null){
                            tr_id = data.invoice.transaction[i].transactionid;
                        }
                        if(data.invoice.transaction[i].reference == 0){
                            selectopt.append($('<option>').text(data.invoice.transaction[i].created_at+' | '+data.invoice.transaction[i].transactionid +' | '+data.invoice.transaction[i].amountin).val(data.invoice.transaction[i].id));

                            ref = '<button class="btn btn-xs btn-danger rounded-circle" onclick="delete_transaction('+data.invoice.transaction[i].id+')"><b>-</b></button>';
                        }
                        var amount = data.invoice.transaction[i].amountin;
                        if(data.invoice.transaction[i].amountout != 0){
                            amount = "-" + data.invoice.transaction[i].amountout;
                        }
                        var $tr = $('<tr>').append(
                            $('<td align="center">'+data.invoice.transaction[i].created_at+'</td>'),
                            $('<td align="center">'+data.invoice.transaction[i].paymentmethod+'</td>'),
                            $('<td align="center">'+tr_id+'</td>'),
                            $('<td align="center">'+currency_setting(currency, amount)+'</td>'),
                            $('<td align="center">'+ref+'</td>'),
                        ).appendTo('#trans_content');
                    }
                   
                    var balance = 0; 
                    for(var i = 0; i < data.invoice.payment.length; i++){
                        balance = balance + data.invoice.payment[i].amount;
                    }
                   
                    balance = balance - data.invoice.total;
                    if(data.invoice.credit != null){
                        balance = balance + data.invoice.credit.amount;
                    }
                    // else{
                    //     balance = balance - data.invoice.total;
                    // }

                    for(var i = 0; i< data.invoice.transaction.length; i++){
                        if(data.invoice.transaction[i].reference == 0){
                            if(data.invoice.transaction[i].amountin != 0){
                                balance = balance + data.invoice.transaction[i].amountin;
                            }
                            if(data.invoice.transaction[i].amountout != 0){
                                balance = balance - data.invoice.transaction[i].amountout;
                            }
                        }
                    }
                    console.log(balance);
                    $("#c_balance_client").val(Math.abs(balance));
                    $("#creditbalance").html(currency_setting(currency, balance));
                    $("#payment_amount, #payment_balance").val(Math.abs(balance));
                    
                    $("#item_content").append('<tr>'+
                        '<td><input type="checkbox" name="item[select][]" id="select" class="form-control"></td>'+
                        '<td><textarea name="item[description][]" id="description" rows="2" class="form-control form-control-sm"></textarea></td>'+
                        '<td><input type="text" name="item[amount][]" id="amount" class="form-control form-control-sm"></td>'+
                        '<td><select name="item[taxed][]" class="form-control form-control-sm"><option value="a">-</option><option value="taxed">✓</option></td>'+
                    '</tr>');
                    $("#subtotal").html(currency_setting(currency,subtotal));
                    $("#taxrate").html(currency_setting(currency,tax));
                    if(data.invoice.credit != null){
                        $("#credit, #remove_credit_inv").html(currency_setting(currency,data.invoice.credit.amount)); 
                        // $("#credit_b").val(data.invoice.credit.amount);
                    }else{
                        $("#credit, #remove_credit_inv").html(currency_setting(currency,0)); 
                    }
                    $("#totaldue_inv").html(currency_setting(currency, data.invoice.total)); 
                    
                    if(data.invoice.payment.length == 0 && data.invoice.status == "Unpaid"){
                        $("#btn_paid").hide();
                        $("#btn_unpaid").prop('disabled', true);
                    }else if(data.invoice.status == "Draft" || data.invoice.status == "Paid"){
                        $("#btn_paid").hide();
                        $("#btn_unpaid").prop('disabled', false);
                    }else if(data.invoice.payment.length != 0 && data.invoice.status == "Unpaid"){
                        $("#btn_unpaid").hide();
                        $("#btn_paid").show();
                    }else if(balance > 0 && data.invoice.status == "Unpaid"){
                        $("#btn_paid").hide();
                        $("#btn_unpaid").prop('disabled', true);
                    }else{
                        $("#btn_paid").hide();
                        $("#btn_cancel").prop('disabled', true);
                    }
                }
            }); 
        }

        function currency_setting(curr, value){
            var result = '';
            if (curr == "IDR") {
                result =  "IDR "+value;
            } else {
                result =  "$"+value+ " USD";
            }
            return result;
        }

        $("#save_changes").on('click', function(){
            var id = "<?php echo $inv_id?>";
            var token = "<?php echo Session::get('api_token') ?>";
            $.ajax({
                url: "/invoice/invoice1/"+id,
                type: "POST",
                dataType: "JSON",
                data: $("#form_edit").serialize(),
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer '+ token);
                },
                success: function(data){
                    if(data.status =="success"){
                        alert(data.message);
                        window.open('/invoice/detail/'+ id, '_self');
                    } else {
                        alert(data.message);
                    }
                }
            });
        });

        function delete_item(id, inv_id){
            var token = "<?php echo Session::get('api_token') ?>";
            if(confirm("Are u sure to delete this item ?")){
                $.ajax({
                    url: "/invoice/item/"+id,
                    type: "DELETE",
                    dataType: "JSON",
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    },
                    success: function(data){
                        if(data.status =="success"){
                            alert("Item Successfully Deleted");
                            $("#item_content").empty();
                            inv_detail(inv_id);
                        }else{
                            alert("Item Failed to delete");
                        }
                    }
                });
            }
        }

        $("#btn_publish").on('click', function(){
            var invoice_id = $("#invoiceid").val();
            var token = "<?php echo Session::get('api_token') ?>";
            $.ajax({
                url: "/invoice/send/"+invoice_id,
                type: "POST",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(data){
                    if (data.status == "success") {
                        alert(data.message);
                        window.open('/invoice/detail/'+invoice_id, '_self');
                    } else {
                        alert(data.message);
                    }
                }
            });
        });

        $("#btn_add_credit").on('click', function(){
            var id = $("#id_invoice").val();
            var token = "<?php echo Session::get('api_token') ?>";
            if(cek_credit()){
                $.ajax({
                    url: "/invoice/credit",
                    type: "POST",
                    dataType: "JSON",
                    data: $("#form_credit").serialize(),
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    },
                    success: function(data){
                        if (data.status == "success") {
                            alert(data.message);
                            window.open('/invoice/detail/'+id, '_self');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        });

        function cek_credit(){
            var amount = $("#add_credit").val();
            var total_payment = $("#payment_amount").val();
            if(parseFloat(amount) > parseFloat(total_payment)){ 
                alert("You can't apply more than balance total"); 
                return false;
            }
            return true;
        }

        $("#btn_payment").on('click', function(){
            var id = $("#id_invoice").val();
            var token = "<?php echo Session::get('api_token') ?>";
            if(confirm("Are u sure to add payment in this invoice ? ")){
                $.ajax({
                    url: "/invoice/payment/"+id,
                    type: "POST",
                    dataType: "JSON",
                    data: $("#form_payment").serialize(),
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    },
                    success: function(data){
                        if (data.status=="success") {
                            alert(data.message);
                            window.open('/invoice/detail/'+id, '_self');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        });

        $("#btn_remove_credit").on('click', function() {
            var id = $("#id_invoice").val();
            var token = "<?php echo Session::get('api_token') ?>";
            $.ajax({
               url: "/invoice/credit/r",
               type: "POST",
               dataType: "JSON",
               data: $("#form_credit").serialize(),
               beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                },
               success: function(data){
                    if (data.status=="success") {
                        alert(data.message);
                        window.open('/invoice/detail/'+id, '_self');
                    } else {
                        alert(data.message);
                    }
                    // console.log(data);
               }
            });
        });

        function mark_process(value){
            var id = $("#id_invoice").val();
            var token = "<?php echo Session::get('api_token') ?>";
            $.ajax({
                url: "/invoice/mark",
                type: "POST",
                dataType: "JSON",
                data: {id_inv: id, action: value},
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(data){
                    if (data.status=="success") {
                        alert(data.message);
                        window.open('/invoice/detail/'+id, '_self');
                    } else {
                        alert(data.message);
                    }
                }
            });
        }

        function delete_transaction(id){
            var inv_id = $("#id_invoice").val();
            if(confirm("Are u sure to delete this transaction ?")){
                $.ajax({
                    url: "/transactions/"+id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data){
                        if (data.status=="success") {
                            alert(data.message);
                            window.open('/invoice/detail/'+inv_id, '_self');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        }
        function add_refund(){
            var id = $("#invoiceid").val();
            $.ajax({
                url: "/invoice/refund/"+id,
                type: "POST",
                dataType: "JSON",
                data: $("#form_refund").serialize(),
                success: function(data){
                    if (data.status=="success") {
                        alert(data.message);
                        window.open('/invoice/detail/'+inv_id, '_self');
                    } else {
                        alert(data.message);
                    }
                    // console.log(data);
                }
            });
        }
        $("#cekbox").on('change', function(){
            var value   = $("#cekbox").val();
            var inv_id  = $("#invoiceid").val();
            var items = [];
            $.each($("input[name='item_o']:checked"), function(){
                items.push($(this).val());
            });
            console.log(items);
            $.ajax({
                url: "/invoices/selected/"+inv_id,
                type: "POST",
                dataType: "JSON",
                data: {selected: items, action: value},
                success: function(data){
                    if (data.status=="success") {
                        alert(data.message);
                        window.open('/invoice/detail/'+inv_id, '_self');
                    } else if(data.status=="null"){
                        window.open('/invoice/detail/'+inv_id, '_self');
                    } else{
                        alert(data.message);
                    }
                    console.log(data);
                }
            });
        });
    </script>                 
</body>

</html>