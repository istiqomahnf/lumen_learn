<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Client</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">      
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>      
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <style type="text/css">
            .table{
                font-size: 11px;
            }
            .btn-group-xs > .btn, .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .8;
              border-radius: .2rem;
            }
            .card{
                background-color: #f2f2f2;
            }
            .card-title{
                font-weight: bold;
                color: #1b337a;
                text-align: center;
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
    <div class="container col-sm-10" style=" padding-top: 30px;">
        <div class="row">
            <div class="card col-lg-3 col-sm-4" style="margin-left: 60px;">
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
                    <a href="javascript:void(0)" onclick="client_login('{{$value->clientid}}')"><i class="fas fa-bomb"></i> Login as Client</a> 
                    @endforeach
                </div>
            </div> &nbsp;
            <div class="card col-lg-3 col-sm-4" style="margin-left: 60px;">
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
                    <!-- <a href="/client/addfund"><i class="fas fa-fire"></i> Create Add Funds Invoice</a><br> -->
                    @endforeach
                </div>
            </div>&nbsp;
            <div class="card col-lg-3 col-sm-4" style="margin-left: 60px;">
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