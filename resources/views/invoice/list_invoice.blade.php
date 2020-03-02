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
            }
            .btn-group-xs > .btn, .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .8;
              border-radius: .2rem;
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
              <a class="dropdown-item" href="/invoice/overdue">- Overdue</a>
            </div>
          </li>
          <a href="javascript::void" id="log_out" class="nav-item nav-link">Logout</a>
        </div>
      </div>
    </nav>
    <div class="container" style="padding-top: 40px;">
      <div class="row col-sm-12 col-lg-12" >
        <table class="table table-bordered table-striped">
          <thead>
            <tr align="center">
              <th>Invoice ID</th>
              <th>Client Name</th>
              <th>Invoice Date</th>
              <th>Due Date</th>
              <th>Total</th>
              <th>Payment Method</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoice as $value)
            <tr>
              <td align="center"><a href="/invoice/detail/{{$value->invoiceid}}">{{"#".$value->invoiceid}}</a></td>
              <td>{{$value->client->firstname." ".$value->client->lastname}}</td>
              <td align="center">{{$value->date}}</td>
              <td align="center">{{$value->duedate}}</td>
              <td align="center">{{$value->total}}</td>
              <td>{{$value->paymentmethod}}</td>
              <td align="center">{{$value->status}}</td>
              <td>---</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</body>
</html>