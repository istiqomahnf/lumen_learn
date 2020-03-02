<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Sign Up!</title>
  </head>
  <body>
    <div class="container">
      <div class="col-sm-10" style="padding-top: 50px">
        <div class="col-sm-6"><center><h4>Form Sign Up</h4></center></div><br>
        <div class="alert alert-danger print-error-msg col-sm-8" style="display:none">
            <ul></ul>
        </div>
        <form id="form_signup">
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Fullname</label>
            </div>
            <div class="col-sm-4">
              <input type="text" name="name" id="name" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Email</label>
            </div>
            <div class="col-sm-4">
              <input type="text" name="email" id="email" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Role</label>
            </div>
            <div class="col-sm-4">
              <select class="form-control" name="role">
                <option value="">-Select Option-</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Password</label>
            </div>
            <div class="col-sm-4">
              <input type="password" name="password" id="password" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Confirm Password</label>
            </div>
            <div class="col-sm-4">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-primary btn-sm btn-block float-right" onclick="register()">Sign Up</button>&nbsp;&nbsp;
          </div>
        </form>
      </div>
    </div>
    <script type="text/javascript">
      function register(){
        $.ajax({
          url: "/signup",
          method: "POST",
          dataType: "JSON",
          data: $("#form_signup").serialize(),
          success: function(data){
            if (data.status) {
              alert(data.message);
              window.open('/','_self');
            }else{
              printerror(data.error);
            }
          }
        });
      }

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