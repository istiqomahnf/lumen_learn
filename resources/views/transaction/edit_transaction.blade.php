<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaction</title>
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
            .inline { float:left; }
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
            <span id="invoice_id">Edit Transaction</span>
        </h5>
            <div class="card-body">
            <form id="form_edit" enctype="multipart/form-data" role="form">
            <input type="hidden" name="clientid" id="clientid" value="">
            <input type="hidden" name="id" id="id" value="">
                <div class="row" style="padding-top: 5px; padding-right: 25px;">
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Date</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <input type="date" class="form-control form-control-sm col-lg-6" name="date" id="date">
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Transaction ID</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <input type="text" name="transactionid" id="transactionid" class="form-control-sm form-control">
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
                        <label for="col-form-label-sm">Invoice ID</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <input type="text" class="form-control-sm form-control col-sm-6" name="invoiceid" id="invoiceid">
                    </div>
                    <div class="col-sm-2">
                        <label for="col-form-label-sm">Amount Out</label>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f2f2">
                        <input type="text" class="form-control-sm form-control col-sm-6" name="amountout" id="amountout">
                    </div>
                </div>
                <br>
            <center><button class="btn btn-info btn-sm col-sm-2" type="button" onclick="update_transaction()">Save</button></center>
            </div>
        </div>
            <br><br>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            var tr_id = "{{Request::segment(3)}}";
            trans_data(tr_id);
        });

        function trans_data(id){
            $.ajax({
                url: "/transactions/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $("#id").val(data.id);
                    $("#clientid").val(data.clientid);
                    $("#date").val(data.date);
                    $("#paymentmethod").val(data.paymentmethod).change();
                    $("#description").val(data.description);
                    $("#invoiceid").val(data.invoiceid);
                    $("#transactionid").val(data.transactionid);
                    $("#amountin").val(data.amountin);
                    $("#amountout").val(data.amountout);
                    $("#fee").val(data.fee);
                }
            });
        }

        function update_transaction(){
            var id = $("#id").val();
            var clientid = $("#clientid").val();
            $.ajax({
                url: "/transactions/"+id,
                type: "PUT",
                dataType: "JSON",
                data: $("#form_edit").serialize(),
                success: function(data){
                    if(data.status == "success"){
                        alert(data.message);
                        window.open('/transaction/client/'+clientid, '_self');
                    }else{
                        alert(data.message);
                    }
                }
            });
        }
    </script>
</body>
</html>