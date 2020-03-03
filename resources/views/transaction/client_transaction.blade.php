<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Transaction</title>
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

    <div class="container col-sm-10">
    <!-- <div class="col-lg-12" style="border-style:solid; border-width:thin; border-color: grey;"> -->
    <br><br>
        <div class="card">
            <h5 class="card-header">Transaction List</h5>
            <div class="card-body">
                <table width="100%" class="table table-bordered table-striped">
                    <thead>
                        <tr bgcolor="#c3d8fa">
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Description</th>
                            <th>Amount In</th>
                            <th>Fees</th>
                            <th>Amount Out</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id ="invoice_content">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var id = "{{$clientid}}";
            transaction_client(id);
        });

        function transaction_client(id){
            $.ajax({
                url: "/transactions/client/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    console.log(data);
                    for(var i = 0; i < data.length; i++){
                        var currency = data[0].client.currency;
                        var $tr = $('<tr>').append(
                            $('<td align="center">'+data[i].date+'</td>'),
                            $('<td align="center">'+data[i].paymentmethod+'</td>'),
                            $('<td align="center">'+data[i].description+'</td>'),
                            $('<td align="right">'+currency_setting(currency,data[i].amountin)+'</td>'),
                            $('<td align="right">'+currency_setting(currency,data[i].fee)+'</td>'),
                            $('<td align="right">'+currency_setting(currency,data[i].amountout)+'</td>'),
                            $('<td align="center"><a href="/transaction/edit/'+data[i].id+'"><button type="button" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></button></a> | <button type="button" class="btn btn-xs btn-danger" onclick="delete_transaction('+data[i].id+','+data[0].client.clientid+')"><i class="fas fa-trash"></i></button></td>')
                        ).appendTo('#invoice_content');
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
        function delete_transaction(id, clientid){
            var inv_id = $("#id_invoice").val();
            if(confirm("Are u sure to delete this transaction ?")){
                $.ajax({
                    url: "/transactions/"+id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data){
                        if (data.status=="success") {
                            alert(data.message);
                            window.open('/transaction/client/'+clientid, '_self');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>