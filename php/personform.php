<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<form action="/index.html" method="post">
  Eesnimi: <input name="firstname" type="text"><br><br>
  Perenimi: <input name="lastname" type="text"><br><br>
  Email: <input name="email" type="text"><br><br>
  Grupi ID: <input name="group_id" type="number"><br><br>
  Aktiivne: <input name="active" value="Active" checked="" type="checkbox"><br><br>
  <button type="button" class="btn btn-primary delete">Kustuta</button>
  <input value="Submit" type="submit">
</form>