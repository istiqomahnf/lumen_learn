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
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td width="70%"><i class="fas fa-caret-right"></i> Paid </td>
                            <td align="right">{{$paid}}</td>
                        </tr>
                        <tr>
                            <td width="70%"><i class="fas fa-caret-right"></i> Unpaid </td>
                            <td align="right">{{$unpaid}}</td>
                        </tr>
                        <tr>
                            <td width="70%"><i class="fas fa-caret-right"></i> Cancelled </td>
                            <td align="right">{{$cancelled}}</td>
                        </tr>
                    </table>
                </div>
              </div>
        </div>
        <div class="col-md-9 pull-md-right bodi" style="padding-left: 30px; padding-top: 20px">
            <div class="panel panel-sidebar">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        My invoice
                    </h5>
                </div>
                <div class="panel-body">
                   <div class="row" style="margin-top: 30px;">
                        <table id="dataTable" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice ID</th>
                                    <th>Invoice Date</th>
                                    <th>Due Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="invoice_content">
                                
                            </tbody>
                        </table>
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
            client_invoice(clientid);
            console.log('{{Session::get("client_token")}}');
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

        function client_invoice(id){
            $.ajax({
                url: "/invoice/v2/"+id,
                type: "GET",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("client_token")}}');
                },
                success: function(data){
                    console.log(data);
                    var no = 1;
                    for(var i=0; i<data.invoice.length; i++){
                        var $tr = $('<tr>').append(
                            $('<td>'+no+'</td>'),
                            $('<td><a href="/client/invoice/v2/'+data.invoice[i].invoiceid+'">#'+data.invoice[i].invoiceid+'</a></td>'),
                            $('<td>'+data.invoice[i].date+'</td>'),
                            $('<td>'+data.invoice[i].duedate+'</td>'),
                            $('<td>'+currency_setting(data.invoice[i].client.currency, data.invoice[i].total)+'</td>'),
                            $('<td>'+data.invoice[i].status+'</td>')
                        ).appendTo('#invoice_content');
                        no++;
                    }
                }
            })
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
    </script>
</body>
</html>