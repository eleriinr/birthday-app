<?php 
//Destination url
$url = str_replace('lisaisik', 'isikud',$url);

global $wpdb;

$groups = $wpdb->prefix . 'groups';
	
$current_group = $wpdb->get_results( "SELECT id FROM $groups WHERE current='Yes'" );
$current_group = $current_group[0];
$group_id = $current_group->id;
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/lisaisik.js"></script></head>

<h1 class="h1 text-center my-4">Lisa isik</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			
			<form method="post" action=<?php echo $url;?>>
					<input type="number" name="id" value="<?php echo $group_id; ?>" hidden>
					<input value="Tagasi" type="submit" class="btn btn-danger my-3">
			</form>
						
			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="first_name">Eesnimi: </label>
					<input class="form-control" id="first_name" type="text" placeholder="Eesnimi" required>
				</div>
				<div class="form-group">
					<label for="last_name">Perenimi: </label>
					<input class="form-control" id="last_name" type="text" placeholder="Perenimi" required>
				</div>
				<div class="form-group">
					<label for="birthday">Kuupäev: </label>
					<input class="form-control" id="birthday" type="date" required>
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label for="recipients_email">Meili saaja: </label>
					<input class="form-control" id="recipients_email" type="text" placeholder="Saaja Email">
				</div>
				<div class="form-group">
					<label for="comment">Kommentaar: </label>
					<input class="form-control" id="comment" type="text" placeholder="Kommentaar">
				</div>
				<div class="form-group">
					<label for="group_id">Grupi ID: </label>
					<input class="form-control" id="group_id" type="number" value="<?php echo $group_id; ?>" placeholder="ID"  required>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="active">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="active" checked>
				</div>
				<input type="number" name="id" value="<?php echo $group_id; ?>" hidden>
				<input value="Lisa" id="add" type="submit" class="btn btn-info pull-right mb-3 d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>