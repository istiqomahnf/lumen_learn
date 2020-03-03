<!DOCTYPE html>
<html>
<head>
    <title>Add Invoice</title>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">      
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>      
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
        </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link {{ (Request::segment(1) == 'index') ? 'active' : '' }}" href="/client/all" >Home <span class="sr-only">(current)</span></a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (Request::segment(1) == 'invoice') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Clients
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/client/all">- View Clients</a>
              <a class="dropdown-item" href="/client/add">- Add New Client</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (Request::segment(1) == 'invoice') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Invoice
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/invoice/unpaid">- Unpaid</a>
              <a class="dropdown-item" href="/invoice/paid">- Paid</a>
              <a class="dropdown-item" href="/invoice/draft">- Draft</a>
              <a class="dropdown-item" href="/invoice/cancelled">- Cancelled</a>
            </div>
          </li>
          <a href="javascript::void" id="log_out" class="nav-item nav-link">Logout</a>
        </div>
      </div>
    </nav>
    <div class="container" style="padding-top: 30px;">
        <div class="alert alert-danger print-error-msg col-sm-8" style="display:none">
            <ul></ul>
        </div>
        <div class="card">
        <h5 class="card-header">
            <span id="invoice_id">#InvoiceID</span>
        </h5>
            <div class="card-body">
            <form id="form_add" enctype="multipart/form-data" role="form">
                <div class="row" style="padding-top: 5px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Client Name</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <span id="clientname"></span>
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Payment Method</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <select name="paymentmethod" id="paymentmethod" class="form-control col-sm-8">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Paypal">Paypal</option>
                        </select>
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
                </div>
                <div class="row" style="padding-right: 25px; padding-top: 5px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Due Date</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <span id="invduedate"></span>
                        <input type="hidden" name="duedate" id="duedate" value="">
                    </div>
                </div>
                <div class="row" style="padding-right: 25px; padding-top: 5px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Total Due</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <span id="totaldue"></span>
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
                        <label>Notes</label>
                    </div>
                    <div class="col-sm-10">
                        <textarea name="notes" id="notes" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
            <hr>
            <div class="row">
                <table width="100%" class="table table-bordered">
                    <thead>
                        <tr bgcolor="#2d548a" style="color: #ffffff;">
                            <th width="3%"></th>
                            <th width="70%">Description</th>
                            <th>Amount</th>
                            <th>Taxed</th>
                        </tr>
                    </thead>
                    <input type="hidden" id="userid" name= "userid" value="<?php echo $userid ?>">
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="select" id="select" class="form-control"></td>
                            <td><textarea name="description" id="description" rows="2" class="form-control form-control-sm"></textarea></td>
                            <td><input type="text" name="amount" id="amount" class="form-control form-control-sm"></td>
                            <td><input type="checkbox" name="taxed" id="taxed" class="form-control" value="taxed"></td>
                        </tr>
                        <tr bgcolor="#f2f2f2">
                            <td colspan="2" align="right"><b>Sub Total</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr bgcolor="#f2f2f2">
                            <td colspan="2" align="right"><b>10.00%tax</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr bgcolor="#f2f2f2">
                            <td colspan="2" align="right"><b>Credit</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr bgcolor="#2d548a" style="color: #ffffff;">
                            <td colspan="2" align="right"><b>Total Due :</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <center><button class="btn btn-info btn-sm col-sm-2" type="button" onclick="save_invoice()">Create</button></center>
            <br><br>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            var clientid = "<?php echo $userid ?>";
            clientdata(clientid);
        });

        function clientdata(id){
            $.ajax({
                url: "/invoice/details/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    console.log(data);
                    $("#clientname").html(data.client[0].firstname + " " + data.client[0].lastname);
                    if(data.client[0].currency == "IDR"){
                        var credit = "IDR "+ data.client[0].credit;
                        var total = "IDR 0"; 
                    }else{
                        var credit = "$ "+ data.client[0].credit + " USD";
                        var total = "$ 0.00 USD";
                    }
                    $("#invdate").html(data.date); $("#date").val(data.date);
                    $("#invduedate").html(data.duedate); $("#duedate").val(data.duedate);
                    $("#creditbalance").html(credit);
                    $("#totaldue").html(total);
                }
            });
        }

        function save_invoice(){
            var userid = $("#userid").val();
            $.ajax({
                url: "/invoice/item",
                type: "POST",
                dataType: "JSON",
                data: $("#form_add").serialize(),
                success: function(data){
                    if(data.status == "success"){
                        alert("Invoice Created Successfully");
                        window.open('/client/invoices/'+userid , '_self');
                    }else{
                        alert("Error while create Invoice");
                    }
                }
            });
        }
    </script>
</body>
</html>