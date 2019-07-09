<?php 
//Destination url
$url = str_replace('lisaisik', 'isikud',$url);

//ID of the group
$id = $_POST['id'];
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/lisaisik.js"></script></head>

<h1 class="h1 text-center my-4">Lisa isik</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			
			<form method="post" action=<?php echo $url;?>>
					<input type="number" name="id" value="<?php echo $id; ?>" hidden>
					<input value="Tagasi" type="submit" class="btn btn-danger my-3">
			</form>
						
			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="eesnimi">Eesnimi: </label>
					<input class="form-control" id="eesnimi" type="text" placeholder="Eesnimi" required>
				</div>
				<div class="form-group">
					<label for="perenimi">Perenimi: </label>
					<input class="form-control" id="perenimi" type="text" placeholder="Perenimi" required>
				</div>
				<div class="form-group">
					<label for="kuupaev">Kuupäev: </label>
					<input class="form-control" id="kuupaev" type="date" required>
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label for="emails">Meili saaja: </label>
					<input class="form-control" id="saaja_email" type="email" placeholder="Saaja Email">
				</div>
				<div class="form-group">
					<label for="kommentaar">Kommentaar: </label>
					<input class="form-control" id="kommentaar" type="text" placeholder="Kommentaar">
				</div>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" value="<?php echo $id; ?>" placeholder="ID"  required>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne" checked>
				</div>
				<input type="number" name="id" value="<?php echo $id; ?>" hidden>
				<input value="Lisa" id="add" type="submit" class="btn btn-info pull-right mb-3 d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>