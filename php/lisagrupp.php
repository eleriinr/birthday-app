<?php
//Destination url
$url = str_replace('lisagrupp', 'sunnipaevaplugin',$url);
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/lisagrupp.js"></script></head>

<h1 class="h1 text-center my-4" >Lisa grupp</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col"> 
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>

			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="name">Nimi: </label>
					<input class="form-control" id="name" type="text" placeholder="Nimi" required>
				</div>
				<div class="form-group">
					<label for="str_id">Struktuuri ID: </label>
					<input class="form-control" id="str_id" type="text" placeholder="ID" required>
				</div>
				<div class="form-group">
					<label for="email">Üldmeil: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="active">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="active" checked>
				</div>
				<input value="Lisa" id="add" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>