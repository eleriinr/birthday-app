<?php
//Destination url
$url = str_replace('sunnipaevaplugin-lisagrupp', 'sunnipaevaplugin',$url);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<head><script src="../wp-content/plugins/birthday-app/scripts/lisagrupp.js"></script></head>

<h1 class="h1 text-center my-4" >Lisa grupp</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col"> 
			<?php echo '<form id="form" action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="name">Nimi: </label>
					<input class="form-control" id="name" type="text" placeholder="Nimi" required>
				</div>
				<div class="form-group">
					<label for="str_id">Struktuuri ID: </label>
					<input class="form-control" id="str_id" type="text" placeholder="ID" required>
				</div>
				<div class="form-group">
					<label for="group_email">Üldmeil: </label>
					<input class="form-control" name="group_email" id="group_email" type="email" placeholder="Email" required>
					<h6 id="invalid" class="h6" hidden>Email on vigane!</h6>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="active">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="active" checked>
				</div>
				<input value="Lisa" id="add" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>
		</div>
		<div class="col"></div>
	</div>
</div>