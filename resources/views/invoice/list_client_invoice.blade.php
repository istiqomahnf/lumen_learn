<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Invoice</title>
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
        <!-- </div> -->
        <hr>
        <table width="100%" class="table table-bordered table-striped">
            <thead>
                <tr>
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
            <tbody id ="invoice_content">
                @foreach($invoices as $val)
                <tr>
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
                        <!-- <a href="/invoice/delete/{{$val->invoiceid}}"> -->
                        <button type="button" class="btn btn-xs btn-danger" onclick="delete_inv('{{$val->invoiceid}}')"><i class="fas fa-trash"></i></button>
                        <!-- </a>  -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
    </script>
</body>
</html>