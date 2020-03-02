<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
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
          <a class="nav-item nav-link {{ (Request::segment(1) == 'index') ? 'active' : '' }}" href="/index" >Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link {{ (Request::segment(1) == 'trash') ? 'active' : '' }}" href="/trash">Trash</a>
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
    <div class="container col-sm-11" style="padding-top: 30px;">
        <div class="row">
            <form id="form_search" style="padding-left: 20px;">
                <div class="form-group row">
                    <label for="example-date-input" class="col-12 col-form-label font-weight-bold">Search by Date : </label>
                        <div class="col-4">
                            <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="date_start" name="date_start"> 
                        </div>
                        <div class="col-1">to</div>
                        <div class="col-4">
                            <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="date_end" name="date_end">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-secondary btn-md" id="btn_search"><i class="fas fa-search"></i></button>
                        </div>
                </div>
            </form>
        </div>
        <span id="count"></span>
        <button type="button" class="btn btn-primary float-right btn-sm" id="btn_add"><i class="fas fa-plus"></i> Add</button>&nbsp;&nbsp;&nbsp;
        <table class="table table-bordered table-striped" width="100%">
            <thead>
                <tr bgcolor="#6db3a8" align="center">
                    <th>No</th>
                    <th width="10%">Picture</th>
                    <th width="15%">Title</th>
                    <th width="25%">Description</th>
                    <th>Category</th>
                    <th>Writer</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th width="12%">Action</th>
                </tr>
            </thead>
            <tbody id="content">

            </tbody>
        </table>
    </div>
    <div class="modal fade" role="dialog" id="modaledit">
      <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
          <div class="modal-header" style="background-color:#6db3a8;">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_edit" enctype="multipart/form-data" method="POST" role="form">
                <input type="hidden" name="id" value="" id="id">
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label>Title</label>
                    </div>   
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="" id="title">
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label>Description</label>
                    </div>   
                    <div class="col-sm-9">
                        <textarea type="text" name="desc" rows="5" class="form-control" value="" id="desc"></textarea>
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label>Category</label>
                    </div>   
                    <div class="col-sm-9">
                        <select class="form-control" name="category" id="category">
                            <option value="">-Select Category-</option>
                            @foreach($category as $val)
                            <option value="{{$val->id}}">{{$val->category_name}}</option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label>Header Picture</label>
                    </div>   
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="file">
                        <span id ="header-file"></span>
                    </div> 
                </div>
            </form>
          </div>
          <div class="modal-footer" style="background-color:#6db3a8;">
            <button type="button" class="btn btn-primary" id="btn_save">Save changes</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            table_data();      
        });

        function table_data(){
            $.ajax({
                url: '/api/article',
                method: 'GET',
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    console.log(data);
                    var no = 1; var span = ''; var send = ''; 
                    for(var i = 0; i <data.result.length; i ++){
                        var file = '';
                        var text = data.result[i].article_description;
                        text = text.replace(/\r?\n/g, '<br />');
                        if (data.result[i].article_status == 0) {
                            span = "<span class = 'badge badge-danger'>not yet posted</span>";
                            send = ' | <button class="btn btn-info btn-xs" title="Upload Article" onclick="send('+data.result[i].article_id+')"><i class="fas fa-upload"></i></button>';
                        }else{
                            send = '';
                            span = "<span class = 'badge badge-success'>Posted</span>";
                        }
                        var img = new Image(10,10);
                        if(data.result[i].file != null){
                            img.src = '/upload_file/'+data.result[i].file;
                            // file = "<a href= '"+img.src+"' target='_blank'>View File</a>";
                            file = "<img src='"+img.src+"' width='150px'>"
                        }else{
                            file = "<center>-</center>";
                        }
                       var tr = $('<tr>').append(
                       $('<td align="center">'+no+'.</td>'), 
                       $('<td align="center">'+file+'</td>'),
                       $('<td>'+data.result[i].article_title+'</td>'),
                       $('<td>'+text +'</td>'),
                       $('<td align="center">'+data.result[i].category.category_name +'</td>'),
                       $('<td align="center">'+data.result[i].user.name +'</td>'),
                       $('<td align="center">'+data.result[i].created_at +'</td>'),
                       $('<td align="center">'+span +'</td>'),
                       $('<td> &nbsp;<button class="btn btn-warning btn-xs" title="Edit Article" onclick="edit('+data.result[i].article_id+')"><i class="fas fa-edit"></i></button> | <button class="btn btn-danger btn-xs" title="Delete Article" onclick="delete_('+data.result[i].article_id+')"><i class="fas fa-trash"></i></button>'+send+'</td>'),
                       ).appendTo('#content');
                       no++;
                    }
                    $("#count").html("Retrieving "+data.count+" data");
                }
            });
        }
        $("#btn_add").on('click', function(){
            window.open('/formadd','_self');
        });

        function edit(id){
            $("#modaledit").modal('show');
            $.ajax({
                url: '/api/article/'+id,
                type: "GET",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    $("#id").val(data.data.article_id);
                    $("#title").val(data.data.article_title);
                    $("#desc").val(data.data.article_description);
                    $("#category").val(data.data.category_id).change();
                    
                    if(data.data.file != null){
                        var img = new Image(10,10);
                        img.src = '/upload_file/'+data.data.file;
                        $("#header-file").html("File Saat ini : <a href= '"+img.src+"' target='_blank'>"+data.data.file+"</a>")
                    }else{
                        $("#header-file").empty();
                    }
                }
            });
        }

        $("#btn_save").on('click', function(){
            $.ajax({
                url: '/api/article1',
                type: "POST",
                data: new FormData($("#form_edit")[0]),
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    if (data) {
                        $("#modaledit").modal('hide');
                        alert('Update Succesful');
                        $("#content").empty();
                        table_data();
                    }else{
                        alert("Failed to Update");
                    }
                }
            });
        });

        function delete_(id){
            if (confirm('Are u sure to remove this data ?')) {
                $.ajax({
                    url: "/api/article/"+id,
                    method: "DELETE",
                    dataType: "JSON",
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        if (data) {
                            alert("Data successfully Deleted on trash");
                            $("#content").empty();
                            table_data();
                        }else{
                            alert("Failed to Remove Data");
                        }
                    }
                });
            }
        }

        function send(id){
            if (confirm('Send the Article ?')) {
                $.ajax({
                    url: "/api/article/"+id,
                    method: "POST",
                    dataType: "JSON",
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        if (data) {
                            alert("Data successfully Send");
                            $("#content").empty();
                            table_data();
                        }else{
                            alert("Failed to Send Data");
                        }
                    }
                });
            }
        }
        $("#log_out").on('click', function(){
            $.ajax({
                url: "/logout",
                method: "POST",
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    if (data.status =="Success") {
                        alert(data.message);
                        window.open('/', '_self');
                    }else{
                        alert("Failed to Logging Out");
                    }
                }
            });
        });

        $("#btn_search").on('click', function(){
            var date_start = $("#date_start").val();
            var date_end = $("#date_end").val();
            if(date_start > date_end) {
                alert("Start date greater than end date!");
                return false;
            }
            if(date_start != '' || date_end != ''){
                $.ajax({
                    url: "/api/search",
                    method: "POST",
                    dataType: "JSON",
                    data: {start: date_start, end: date_end},
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        console.log(data);
                        $("#content").empty();
                        var no = 1; var span = ''; var send = ''; 
                        for(var i = 0; i <data.result.length; i ++){
                            var file = '';
                            var text = data.result[i].article_description;
                            text = text.replace(/\r?\n/g, '<br />');
                            if (data.result[i].article_status == 0) {
                                span = "<span class = 'badge badge-danger'>not yet posted</span>";
                                send = ' | <button class="btn btn-info btn-xs" title="Upload Article" onclick="send('+data.result[i].article_id+')"><i class="fas fa-upload"></i></button>';
                            }else{
                                send = '';
                                span = "<span class = 'badge badge-success'>Posted</span>";
                            }
                            var img = new Image(10,10);
                            img.src = '/upload_file/'+data.result[i].file;
                            if(data.result[i].file != null){
                                file = "<img src='"+img.src+"' width='150px'>";
                                // file = "<a href= '"+img.src+"' target='_blank'>View File</a>";
                            }else{
                                file = "<center>-</center>";
                            }
                        var tr = $('<tr>').append(
                        $('<td align="center">'+no+'.</td>'), 
                        $('<td>'+file+'</td>'),
                        $('<td>'+data.result[i].article_title+'</td>'),
                        $('<td>'+text +'</td>'),
                        $('<td align="center">'+data.result[i].category.category_name +'</td>'),
                        $('<td align="center">'+data.result[i].user.name +'</td>'),
                        $('<td align="center">'+data.result[i].created_at +'</td>'),
                        $('<td align="center">'+span +'</td>'),
                        $('<td> &nbsp;<button class="btn btn-warning btn-xs" title="Edit Article" onclick="edit('+data.result[i].article_id+')"><i class="fas fa-edit"></i></button> | <button class="btn btn-danger btn-xs" title="Delete Article" onclick="delete_('+data.result[i].article_id+')"><i class="fas fa-trash"></i></button>'+send+'</td>'),
                        ).appendTo('#content');
                        no++;
                        }
                        $("#count").html("Retrieving "+data.count+" data");
                    }
                });
            }
            
        });
    </script>
</body>
</html>