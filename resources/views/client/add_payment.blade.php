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
                line-height: 11px;
            }
            .btn-group-xs > .btn, .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .8;
              border-radius: .2rem;
            }
            .sidebar{
                background-color: #f7f7f7;
            }
        </style>
</head>
<body id="page-top">
    <div class="container" style="padding-top: 80px">
    <div class="row">
        <div class="col-md-9 col-sm-12 pull-md-left sidebar" style="padding-top: 20px">
            <div class="panel panel-sidebar">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <i class="fa fa-dollar-sign"></i>&nbsp;&nbsp;Add Payment
                    </h5>
                </div>
                <div class="panel-body">
                <hr>
                   <div class="row">
                        <div class="col-sm-3"><br><br><br><br>
                            <b>Invoice to</b><br>
                            <span id="companyname"></span><br>
                            <span id="clientname"></span><br>
                            <span id="address"></span><br>
                            <span id="city"></span><br>
                            <span id="country"></span><br><br>
                            <b>Invoice Date</b><br>
                            <span id="inv_date"></span>
                        </div>
                        <div class="col-sm-9">
                            <center>
                                <h4><span id="status"></span></h4>
                                <span id="duedate"></span><br><span id="datepaid"></span>
                            </center><br>
                            <b class="float-right">Pay to</b><br>
                            <span class="float-right">12201 Tukwila International Blvd</span><br>
                            <span class="float-right">Suite 150</span><br>
                            <span class="float-right">Seattle, WA 98168</span><br>
                            <span class="float-right">USA</span><br><br>
                            <form role="form" id="form-pay">
                            <b class="float-right">Payment Method</b><br>
                            <select name="payment_paymentmethod" id="payment_paymentmethod" class="float-right col-lg-3 col-md-4 col-sm-6 form-control form-control-sm">
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Paypal">Paypal</option>
                            </select>
                            <br><br>
                            <input type="hidden" name="credit_client" id="credit_client" value="">
                            <input type="hidden" name="id_invoice" id="id_invoice" value="">
                            <input type="hidden" name="c_balance_client" id="c_balance_client" value="">
                            <input type="hidden" name="clientid" id="clientid" value="">
                            <div class="card shadow mb-4" id="panelcredit">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-dark">Apply Credit</h5>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="applycredit" value="true" />
                                    Your credit balance is <strong><span id="credit"></span></strong>. 
                                    This can be applied to the invoice using the form below.. Enter the amount to apply:
                                    <div class="row">
                                        <div class="col-xs-8 col-xs-offset-1 col-sm-6 col-sm-offset-2">
                                            <div class="input-group">
                                                <input type="text" name="add_credit" id="add_credit" value="" class="form-control" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="btn-applycredit" onclick="add_payment_inv()">
                                                    Apply Credit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-secondary">Invoice Item</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr align="center">
                                                <th width="70%">Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="item_content">
                                        
                                        </tbody>
                                        <tr bgcolor="#f2f2f2">
                                            <td align="right"><b>Sub Total</b></td>
                                            <td align="right" id="subtotal"></td>
                                        </tr>
                                        <tr bgcolor="#f2f2f2">
                                            <td align="right"><b>10.00%tax</b></td>
                                            <td align="right" id="taxrate"></td>
                                        </tr>
                                        <tr bgcolor="#f2f2f2">
                                            <td align="right"><b>Credit</b></td>
                                            <td align="right" id="credit_inv"></td>
                                        </tr>
                                        <tr bgcolor="#2d548a" style="color: #ffffff;">
                                            <td align="right"><b>Total Due :</b></td>
                                            <td align="right" id="totaldue_inv"></td>
                                        </tr>
                                    </table>
                                    <span class="float-right"><b>Balance : </b><span id="creditbalance"></span></span>
                                    <br>
                                </div>
                            </div>
                            <br><br>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function(){
            var invoiceid = "{{Request::segment(4)}}";
            client_invoice(invoiceid);
        });

        function client_invoice(id){
            $.ajax({
                url: "/invoice/detail/"+id,
                type: "POST",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("client_token")}}');
                },
                success: function(data){
                    console.log(data);
                    var status = data.invoice.status;
                    var currency = data.invoice.client.currency;
                    $("#id_invoice").val(data.invoice.invoiceid);
                    $("#clientid").val(data.invoice.client.clientid);
                    $("#companyname").html(data.invoice.client.companyname);
                    $("#clientname").html(data.invoice.client.firstname+ " " +data.invoice.client.lastname);
                    $("#address").html(data.invoice.client.address);
                    $("#city").html(data.invoice.client.city + ", "+data.invoice.client.postcode);
                    $("#country").html(data.invoice.client.country);
                    $("#status").html(status.toUpperCase());
                    $("#duedate").html("Due Date : "+data.invoice.duedate);
                    $("#inv_date").html(data.invoice.duedate);
                    $("#payment_paymentmethod").val(data.invoice.paymentmethod).change();
                    $("#credit").html(currency_setting(currency, data.invoice.client.credit));
                    $("#credit_client").val(data.invoice.client.credit);
                    if(status == "Paid"){
                        $("#panelcredit").hide();
                        $("#datepaid").html("Paid at : "+data.invoice.datepaid);
                        $("#btn-applycredit").prop('disabled', true);
                    }else{
                        $("#datepaid").hide(); $("#panelcredit").show();
                        $("#btn-applycredit").prop('disabled', false);
                    }
                    var subtotal = 0; var tax = 0;
                    for(var i = 0; i < data.invoice.items.length; i++){
                        if(data.invoice.items[i].itemtaxed == 1){
                            var amount = data.invoice.items[i].itemamount;
                            tax = tax + (amount * 0.1);
                        }

                        var $tr = $('<tr>').append(
                            $('<td>'+data.invoice.items[i].itemdescription+'</td>'),
                            $('<td align="right">'+currency_setting(currency, data.invoice.items[i].itemamount)+'</td>')
                        ).appendTo('#item_content');
                        subtotal = subtotal + data.invoice.items[i].itemamount;
                    }

                    var balance = 0; 
                    for(var i = 0; i < data.invoice.payment.length; i++){
                        balance = balance + data.invoice.payment[i].amount;
                    }
                   
                    // balance = balance - data.invoice.total;
                    if(data.invoice.credit != null){
                        balance = balance - data.invoice.credit.amount;
                    }else{
                        balance = balance - data.invoice.total;
                    }
                    $("#subtotal").html(currency_setting(currency,subtotal));
                    $("#add_credit, #c_balance_client").val(Math.abs(balance));
                    $("#creditbalance").html(currency_setting(currency,balance));
                    $("#taxrate").html(currency_setting(currency, tax));
                    $("#totaldue_inv").html(currency_setting(currency, data.invoice.total));
                    if(data.invoice.credit == null){
                        $("#credit_inv").html(currency_setting(currency,0));
                    }else{
                        $("#credit_inv").html(currency_setting(currency,data.invoice.credit.amount));
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

        function add_payment_inv(){
            var id = $("#id_invoice").val();
            if(cek_credit()){
                $.ajax({
                    url: "/invoice/credit",
                    type: "POST",
                    dataType: "JSON",
                    data: $("#form-pay").serialize(),
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("client_token")}}');
                    },
                    success: function(data){
                        if (data.status == "success") {
                            alert(data.message);
                            window.open('/client/invoice/v2/'+id, '_self');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        }
        function cek_credit(){
            var amount = $("#add_credit").val();
            var total_payment = $("#c_balance_client").val();
            if(parseFloat(amount) > parseFloat(total_payment)){ 
                alert("You can't apply more than balance total"); 
                return false;
            }
            return true;
        }
    </script>
</body>
</html>