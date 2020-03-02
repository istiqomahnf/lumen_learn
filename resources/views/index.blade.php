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
    <title>Log in!</title>
  </head>
  <body>
    <div class="container">
      <div class="col-sm-10" style="padding-top: 150px">
        @if($message != '')
        <span style="color: red">{{ $message }}</span>
        @endif
        <br>
        <form action="/login" method="POST">
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Email</label>
            </div>
            <div class="col-sm-4">
              <input type="text" name="email" id="email" class="form-control" required="required">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-sm-2">
              <label>Password</label>
            </div>
            <div class="col-sm-4">
              <input type="password" name="password" id="password" class="form-control" required="required">
            </div>
          </div>
          <div class="col-sm-6">
            <button class="btn btn-primary btn-sm float-right" onclick="login()">Log in</button>&nbsp;&nbsp;
            <a href="/signup"  style="padding-left: 250px;">Sign Up!</a>&nbsp;&nbsp;
          </div>
        </form>
      </div>
    </div>
    <script type="text/javascript">
    </script>
  </body>
</html>