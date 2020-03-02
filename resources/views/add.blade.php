<!DOCTYPE html>
<html>
<head>
    <title>Add Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="/index" style="color: white;">Home <span class="sr-only">(current)</span></a>
        </div>
      </div>
    </nav>
    <div class="container" style="padding-top: 30px;">
        <div class="alert alert-danger print-error-msg col-sm-8" style="display:none">
            <ul></ul>
        </div>

        <!-- <form id="form_add" enctype="multipart/form-data" method="POST" action="/articleadd"> -->
        <form id="form_add" enctype="multipart/form-data" method="POST" action="" role="form">
            <div class="row form-group">
                    <div class="col-sm-2">
                        <label>Title</label>
                    </div>   
                    <div class="col-sm-6">
                        <input type="text" name="title" class="form-control" value="" id="title">
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        <label>Description</label>
                    </div>   
                    <div class="col-sm-6">
                        <textarea type="text" name="desc" rows="5" class="form-control" value="" id="desc"></textarea>
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        <label>Category</label>
                    </div>   
                    <div class="col-sm-6">
                        <select class="form-control" id="category" name="category">
                            <option value="">-Select Category-</option>
                            @foreach($category as $value)
                            <option value="{{$value->id}}">{{$value->category_name}}</option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        <label>Header Picture</label>
                    </div>   
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="file">
                    </div> 
                </div>

            <div class="col-sm-8">
                <button type="button" class="btn btn-primary float-right" id="btn_add">Save</button>
                <!-- <button type="submit" class="btn btn-primary float-right">Save</button> -->
            </div>
            
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <script type="text/javascript">
        $("#btn_add").on('click', function(){
            $.ajax({
                url: "/api/article ",
                type: "POST",
                data: new FormData($("#form_add")[0]),
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer {{Session::get("api_token")}}');
                },
                success: function(data){
                    if (data.status == "success") {
                        alert("Success");
                        window.open('/index', '_self');
                    }else if(data.status == "err"){
                        alert("Error");
                    }else{
                        printerror(data.error);
                    }
                }
            });
        });

        function printerror(data){
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( data, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    </script>
</body>
</html>