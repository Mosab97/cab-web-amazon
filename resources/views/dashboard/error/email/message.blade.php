<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ setting('project_name') }}</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class='container'>
      <div class="row">
        <div class="col-sm-12 text-center">
          <h4>{{ $data->type }}</h4>
          <p>{{ $data->message }}</p>
        </div>
      </div>
    </div>


    </body>
    </html>
