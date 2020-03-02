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
    <div class="card col-sm-12 border border-secondary">
        <form action="" role="form" id= "form-edit">
        <input type="hidden" name="id" id="id">
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">First Name</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="text" name="firstname" class="form-control form-control-sm" id="firstname" >
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Address</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="text" name="address" class="form-control form-control-sm" id="address" >
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Last Name</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="text" name="lastname" class="form-control form-control-sm" id="lastname" >
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="col-form-label-sm">City</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="text" name="city" class="form-control form-control-sm" id="city" >
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Company Name</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="text" name="companyname" class="form-control form-control-sm" id="companyname" placeholder="(Optional)">
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Postcode</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-6">
                        <input type="text" name="postcode" class="form-control form-control-sm" id="postcode" >
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Email Adress</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control form-control-sm" id="email" >
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Status</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-6">
                        <select name="status" class="form-control form-control-sm" id="status" >
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Password</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control form-control-sm" id="password" >
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Payment Method</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-6">
                        <select name="paymentmethod" class="form-control form-control-sm" id="paymentmethod" >
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Paypal">Paypal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Phone Number</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-10">
                        <input type="number" name="phonenumber" class="form-control form-control-sm" id="phonenumber" >
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Currency</label>
                </div>
                <div class="col-sm-4" style="background-color:#f2f2f2">
                    <div class="col-sm-4">
                        <select name="currency" class="form-control form-control-sm" id="currency" >
                            <option value="USD">USD</option>
                            <option value="IDR">IDR</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="row" style="padding-top: 10px; padding-right: 25px;">
                <div class="col-sm-2">
                    <label for="col-form-label-sm">Admin Notes</label>
                </div>
                <div class="col-sm-10" style="background-color:#f2f2f2">
                    <textarea name="notes" id="notes" rows="4" class="form-control" placeholder="(Optional)"></textarea>
                </div>
            </div>
            <div class="row" style="padding-top: 20px; padding-left: 325px; padding-right: 175px; padding-bottom: 20px;">
               <button type="button" class="btn btn-block btn-primary" onclick="update_client()">Save</button>
            </div>
        </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var id = "{{$clientid}}";
            data_client(id);

        });
        function data_client(id){
            $.ajax({
                url: "/client/v1/"+id,
                type: "GET",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    console.log(data);
                    $("#id").val(data.clientid);
                    $("#firstname").val(data.firstname);
                    $("#lastname").val(data.lastname);
                    $("#companyname").val(data.companyname);
                    $("#email").val(data.email);
                    $("#phonenumber").val(data.phonenumber);
                    $("#status").val(data.status).change();
                    $("#notes").val(data.notes);
                    $("#address").val(data.address);
                    $("#city").val(data.city);
                    $("#postcode").val(data.postcode);
                    $("#paymentmethod").val(data.paymentmethod).change();
                    $("#currency").val(data.currency).change();
                }
            });
        }

        function update_client(){
            var id = $("#id").val();
            $.ajax({
                url: "/client/v1/"+id,
                type: "POST",
                dataType: "JSON",
                data: $("#form-edit").serialize(),
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    if(data.status == "success"){
                        alert(data.message);
                        window.open('/client/all', '_self');
                    }else{
                        alert(data.message);
                    }
                }
            });
        }
    </script>
</body>
</html>