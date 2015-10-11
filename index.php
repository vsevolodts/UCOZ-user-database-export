<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ucoz DB export tool</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>Ucoz user database export tool</h1>
      <form action="delay.php" method="get">
       <div class="form-group">
          <label for="site">Site</label>
          <input type="text" class="form-control" name="site" placeholder="example.com" value="" required>
        </div>
        
        <div class="form-group">
          <label for="userGoupID">User Group ID</label>
          <input type="number" class="form-control" name="userGoupID" placeholder="1" value="1" required>
        </div>
        <div class="form-group">
         <label for="pages">Start Page</label>
          <input type="number" class="form-control" name="startpage" placeholder="" value="" required>
          
          <label for="pages">Pages</label>
          <input type="number" class="form-control" name="pages" placeholder="Number of pages" value="" required>
        </div>
        <div class="form-group">
          <label for="dlanguageuCozso">Session ID</label>
          <input type="text" class="form-control" name="dlanguageuCozso" placeholder="sid%3D93605827113861203%2Cu%3Dlanguage%2Cd%3Dd%2Cll%3D1444106280%2Cserver%3Ds101%2Co%3D1" required>
          <div class="help">Value of 'dlanguageuCozso' cookie.</div>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>