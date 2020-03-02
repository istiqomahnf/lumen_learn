<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Area</title>
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
            .sidebar{
                background-color: #d9d9d9;
            }
        </style>
</head>
<body id="page-top">
    <div class="container" style="padding-top: 80px">
    <div class="row">
        <div class="col-md-3 pull-md-left sidebar" style="padding-top: 20px">
            <div class="panel panel-sidebar">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;Your Info
                    </h5>
                </div>
                <div class="panel-body">
                   <span id="companyname"></span><br>
                   <span id="clientname"></span><br>
                   <span id="address"></span><br>
                   <span id="city"></span><br>
                   <span id="country"></span>
                </div>
            </div>
        </div>
        <div class="col-md-9 pull-md-right bodi" style="padding-left: 30px; padding-top: 20px">
            <div class="panel panel-sidebar">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        Welcome back, <span id="firstname"></span>
                    </h5>
                </div>
                <div class="panel-body">
                   <div class="row" style="margin-top: 30px;">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="/client/v2/{{Request::segment(3)}}">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Invoice</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="invoice_count">{{$n_invoice}}</span></div>
                                        </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function(){
            var clientid = "{{Request::segment(3)}}";
            client_data(clientid);
        });

        function client_data(id){
            $.ajax({
                url: "/client/v1/"+id,
                type: "GET",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("client_token")}}');
                },
                success: function(data){
                    $("#companyname").html(data.companyname);
                    $("#clientname").html(data.firstname+ " " +data.lastname);
                    $("#firstname").html(data.firstname);
                    $("#address").html(data.address);
                    $("#city").html(data.city + ", "+data.postcode);
                    $("#country").html(data.country);
                }
            })
        }
    </script>
</body>
</html>