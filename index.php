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
        <div class="form-group row">
            <div class="col-md-6">
                <label for="uCozsoName">Name of the Session Cookie</label>
                <input type="text" class="form-control" name="uCozsoName" placeholder="dexampleuCozso" required>

          <label for="uCozsoValue">Value of the Session ID Cookie</label>
          <input type="text" class="form-control" name="uCozsoValue" placeholder="sid%3D93605827113861203%2Cu%3Dlanguage%2Cd%3Dd%2Cll%3D1444106280%2Cserver%3Ds101%2Co%3D1" required>
                      </div>
            <div class="col-md-6"></div>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2455268-27', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>