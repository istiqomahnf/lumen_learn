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
            .btn-group-xs > .btn, .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .8;
              border-radius: .2rem;
            }
        </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="/index" style="color: white;">Home <span class="sr-only">(current)</span></a>
          <a href="javascript::void" id="log_out" class="nav-item nav-link float-right" style="color: white;">Logout</a>
        </div>
      </div>
    </nav>
    <!-- <div class="container col-sm-9" style="padding-top: 30px;">
        <table class="table table-bordered table-striped" width="100%">
            <thead>
                <tr bgcolor="#57a196">
                    <th>No</th>
                    <th width="20%">Title</th>
                    <th width="25%">Description</th>
                    <th>Category</th>
                    <th>Writer</th>
                </tr>
            </thead>
            <tbody id="content">

            </tbody>
        </table>
    </div> -->
    <div class="container col-sm-9" style="padding-top: 50px;">
        <div class="accordion" id="accordionExample">
        <?php $no = 1; ?>
        @foreach($article as $data)
            <div class="card">
                <div class="card-header" id="heading{{$no}}" style="bgcolor: yellow">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$no}}" aria-expanded="true" aria-controls="collapse{{$no}}">
                        {{$data->article_title}}
                        </button>
                    </h5>
                </div>
                <div id="collapse{{$no}}" class="collapse" aria-labelledby="heading{{$no}}" data-parent="#accordionExample">
                    <div class="card-body">
                    @if($data->file != null)
                        <center><img src="/upload_file/{{$data->file}}" width = "350px"></center>
                    @endif
                        <p><?php echo nl2br($data->article_description); ?></p>
                        <br>
                        Writer : {{$data->user->name}}
                        <br>
                        Published on : {{ $data->date_created}}
                    </div>
                </div>
            </div>
            <?php $no++; ?>
        @endforeach
        </div>
    </div>
    
    <script type="text/javascript">
        // $(document).ready(function(){
        //     table_data();    
        // });

        function table_data(){
            $.ajax({
                url: '/article',
                method: 'GET',
                dataType: "JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    console.log(data);
                    var no = 1; var span = ''; var send = '';
                    for(var i = 0; i <data.result.length; i ++){
                        var text = data.result[i].article_description;
                        text = text.replace(/\r?\n/g, '<br />');
                        if (data.result[i].article_status == 0) {
                            span = "<span class = 'badge badge-danger'>not yet posted</span>";
                            send = ' | <button class="btn btn-success btn-xs" onclick="send('+data.result[i].article_id+')">Send</button>';
                        }else{
                            send = '';
                            span = "<span class = 'badge badge-success'>Posted</span>";
                        }
                       var tr = $('<tr>').append(
                       $('<td>'+no+'.</td>'), 
                       $('<td>'+data.result[i].article_title+'</td>'),
                       $('<td>'+text +'</td>'),
                       $('<td>'+data.result[i].category.category_name +'</td>'),
                       $('<td>'+data.result[i].user.name +'</td>'),
                       ).appendTo('#content');
                       no++;
                    }
                }
            });
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