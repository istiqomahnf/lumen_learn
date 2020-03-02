<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <style type="text/css">
            .table{
                font-size: 12px;
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
          <a href="javascript::void" id="log_out" class="nav-item nav-link">Logout</a>
        </div>
      </div>
    </nav>
    <div class="container col-sm-9" style="padding-top: 30px;">
        <table class="table table-bordered table-striped" width="100%">
            <thead>
                <tr bgcolor="#d18984" align="center">
                    <th width="20%">Title</th>
                    <th width="25%">Description</th>
                    <th>Category</th>
                    <th>Writer</th>
                    <th>Deleted At</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody id="content">
                @if($article->count() != null)
                    @foreach($article as $val)
                    <tr>
                        <td>{{$val->article_title}}</td>
                        <td>{{$val->article_description}}</td>
                        <td align="center">{{$val->category->category_name}}</td>
                        <td align="center">{{$val->user->name}}</td>
                        <td align="center">{{ (new \App\Http\Helper\Myhelper)->timestamp_ID($val->deleted_at) }}</td>
                        <td align="center"><button class="btn btn-info btn-sm" type="button" id="btn_restore" onclick="restore('{{$val->article_id}}')">Restore</button> | 
                            <button class="btn btn-danger btn-sm" type="button" id="btn_delete" onclick="delete_('{{$val->article_id}}')">Delete Permanent</button>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="6"><center>No data found</center></td>
                </tr>
                @endif
            </tbody>
        </table>
        <br>
        {{$article->links()}}
    </div>
    <script type="text/javascript">
        function restore(id){
            if (confirm("Restore this data ?")) {
                $.ajax({
                    url: '/soft/article',
                    type: "POST",
                    dataType: "JSON",
                    data: {id: id},
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        if (data.status) {
                            alert(data.message);
                            location.reload();
                        }else{
                            alert(data.message);
                        }
                    }
                });
            }
        }

        function delete_(id){
            if (confirm('Are u sure to remove this data permanently ?')) {
                $.ajax({
                    url: "/soft/article/"+id,
                    method: "DELETE",
                    dataType: "JSON",
                    beforeSend: function(xhr){
                        xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                    },
                    success: function(data){
                        if (data.status) {
                            alert("Data successfully Deleted Permanently");
                            location.reload();
                        }else{
                            alert("Failed to Remove Data Permanently");
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
                        window.open('/', '_self');
                    }else{
                        alert("Failed to Logging Out");
                    }
                }
            });
        });
    </script>
</body>
</html>